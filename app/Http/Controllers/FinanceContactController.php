<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Mail\FinanceContactMail;

class FinanceContactController extends Controller
{
    public function store(Request $request)
    {
        // Honeypot
        if ($request->filled('website')) {
            return redirect()->route('finance.contact-sales')->with('success', 'Thanks!');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email:rfc',
            'phone' => 'nullable|string|max:50',
            'organization' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'segment' => 'required|string|in:SACCO,Microfinance,MFI,Bank,Money Lender,SME,Gov/NGO,EdTech,Other',
            'monthly_volume' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:5000',
            'file_upload' => 'nullable|file|mimes:pdf|max:10240',
            'book_demo' => 'nullable|boolean',
            'consent' => 'accepted',
        ]);

        $path = null;
        if ($request->hasFile('file_upload')) {
            $path = $request->file('file_upload')->store('finance/rfp', 'private');
        }

        // Dispatch email to sales
        $salesEmail = env('FINANCE_SALES_EMAIL', 'banks@sanaa.co');
        Mail::to($salesEmail)->queue(new FinanceContactMail($validated, $path));

        // Send receipt
        Mail::to($validated['email'])->queue(new FinanceContactMail($validated, $path, true));

        // Slack webhook
        if ($hook = env('FINANCE_SALES_SLACK_WEBHOOK')) {
            try {
                Http::timeout(5)->asJson()->post($hook, [
                    'text' => '*Finance Contact Sales*',
                    'attachments' => [[
                        'fields' => [
                            ['title' => 'Name', 'value' => $validated['full_name'], 'short' => true],
                            ['title' => 'Email', 'value' => $validated['email'], 'short' => true],
                            ['title' => 'Org', 'value' => $validated['organization'], 'short' => true],
                            ['title' => 'Segment', 'value' => $validated['segment'], 'short' => true],
                            ['title' => 'Monthly Volume', 'value' => $validated['monthly_volume'] ?? 'n/a', 'short' => true],
                            ['title' => 'Country', 'value' => $validated['country'], 'short' => true],
                        ],
                    ]],
                ]);
            } catch (\Throwable $e) {
                // ignore silently
            }
        }

        // Optional CRM webhook
        if ($crm = env('FINANCE_CRM_WEBHOOK')) {
            try {
                Http::timeout(5)->asJson()->post($crm, array_merge($validated, [
                    'file_path' => $path,
                    'source' => 'sanaa.co/finance',
                ]));
            } catch (\Throwable $e) {
                // ignore silently
            }
        }

        return redirect()->route('finance.contact-sales.success');
    }
}
