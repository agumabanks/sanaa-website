<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NewsletterController extends Controller
{
    public function subscribe(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => 'required|email:rfc,dns',
            'source' => 'nullable|string|max:60',
        ]);

        $email = strtolower($data['email']);

        $subscriber = NewsletterSubscriber::firstOrCreate(
            ['email' => $email],
            [
                'source' => $data['source'] ?? 'blog',
                'meta' => [
                    'referer' => $request->headers->get('referer'),
                    'ip' => $request->ip(),
                ],
                'subscribed_at' => now(),
            ]
        );

        if (! $subscriber->wasRecentlyCreated) {
            $subscriber->forceFill([
                'subscribed_at' => $subscriber->subscribed_at ?? now(),
                'source' => $data['source'] ?? $subscriber->source,
            ])->save();

            return response()->json([
                'success' => true,
                'status' => 'existing',
                'message' => 'You are already on our list. Thanks for reading!',
            ]);
        }

        return response()->json([
            'success' => true,
            'status' => 'subscribed',
            'message' => 'Thanks for subscribing! Check your inbox for new stories soon.',
        ], 201);
    }
}
