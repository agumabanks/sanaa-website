<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\FinanceContactMail;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('submits contact sales and sends mail', function () {
    Mail::fake();

    $payload = [
        'full_name' => 'Ada Lovelace',
        'email' => 'ada@example.com',
        'phone' => '123',
        'organization' => 'Analytical Engine',
        'country' => 'UK',
        'segment' => 'Bank',
        'monthly_volume' => '100k',
        'message' => 'Hello',
        'consent' => '1',
    ];

    $this->post(route('finance.contact-sales.submit'), $payload)
        ->assertRedirect(route('finance.contact-sales.success'));

    Mail::assertQueued(FinanceContactMail::class, 2);
});
