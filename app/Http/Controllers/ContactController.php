<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        $items = Contact::all();
        return view('pages.contact', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'nullable',
        ]);
        Contact::create($data);

        try {
            Mail::to(config('mail.contact_recipient'))
                ->queue(
                    new ContactMessage(
                        $data['name'],
                        $data['email'],
                        $data['message'] ?? null
                    )
                );

            return back()->with('status', 'Message sent');
        } catch (\Throwable $e) {
            Log::error('Failed to queue contact message', ['exception' => $e]);

            return back()->withErrors([
                'message' => 'Message could not be sent. Please try again later.',
            ]);
        }
    }
}
