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

        try {
            Mail::to('info@sanaa.co')->send(new SupportRequestMessage(
                $support->name,
                $support->email,
                $support->phone,
                $support->address,
                $support->product,
                $support->message,
            ));
        } catch (\Throwable $e) {
            logger()->error('Support email failed: '.$e->getMessage());
        }

        $text = sprintf(
            'Support request from %s%s: %s',
            $support->name,
            $support->product ? " about {$support->product}" : '',
            $support->message
        );

        try {
            $response = Http::get('https://custom.trustsmsuganda.com/text_api/', [
                'api_key' => env('TRUSTSMS_API_KEY', 'ZCH6QK'),
                'sender' => '',
                'contacts' => env('SUPPORT_PHONE', '256706272481'),
                'text' => $text,
            ]);
            $success = $response->successful();
        } catch (\Throwable $e) {
            logger()->error('Support SMS failed: '.$e->getMessage());
            $success = false;
        }

        $statusMessage = $success ? 'Support message sent' : 'Failed to send support message';

        if ($request->expectsJson()) {
            return response()->json(['status' => $statusMessage], $success ? 200 : 500);
        }

        return back()->with('status', $statusMessage);
    }
}
