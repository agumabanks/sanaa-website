<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SupportController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'message' => 'required|string',
        ]);

        $response = Http::get('https://custom.trustsmsuganda.com/text_api/', [
            'api_key' => 'ZCH6QK',
            'sender' => '',
            'contacts' => '256706272481',
            'text' => $data['message'],
        ]);

        if ($response->successful()) {
            return back()->with('status', 'Support message sent');
        }

        return back()->with('status', 'Failed to send support message');
    }
}
