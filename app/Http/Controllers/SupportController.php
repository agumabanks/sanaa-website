<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupportRequestMessage;
use App\Models\SupportRequest;

class SupportController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'product' => 'nullable|string',
            'message' => 'required|string',
        ]);

        $support = SupportRequest::create($data);

        Mail::to('info@sanaa.co')->send(new SupportRequestMessage(
            $support->name,
            $support->email,
            $support->phone,
            $support->address,
            $support->product,
            $support->message,
        ));

        $text = sprintf(
            'Support request from %s%s: %s',
            $support->name,
            $support->product ? " about {$support->product}" : '',
            $support->message
        );

        $response = Http::get('https://custom.trustsmsuganda.com/text_api/', [
            'api_key' => 'ZCH6QK',
            'sender' => '',
            'contacts' => '256706272481',
            'text' => $text,
        ]);

        if ($response->successful()) {
            return back()->with('status', 'Support message sent');
        }

        return back()->with('status', 'Failed to send support message');
    }
}
