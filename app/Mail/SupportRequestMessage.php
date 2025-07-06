<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SupportRequestMessage extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public ?string $email;
    public ?string $phone;
    public ?string $address;
    public ?string $product;
    public string $content;

    public function __construct(
        string $name,
        ?string $email,
        ?string $phone,
        ?string $address,
        ?string $product,
        string $content,
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->product = $product;
        $this->content = $content;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Support Request',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.support_request',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'product' => $this->product,
                'content' => $this->content,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
