<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FinanceContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;
    public ?string $path;
    public bool $isReceipt;

    public function __construct(array $data, ?string $path = null, bool $isReceipt = false)
    {
        $this->data = $data;
        $this->path = $path;
        $this->isReceipt = $isReceipt;
    }

    public function build()
    {
        $subject = $this->isReceipt
            ? 'We received your request – Sanaa Finance'
            : 'New Finance Contact – ' . ($this->data['organization'] ?? '');

        $mail = $this->subject($subject)
            ->view('emails.finance-contact', [
                'data' => $this->data,
                'isReceipt' => $this->isReceipt,
            ]);

        if ($this->path && !$this->isReceipt) {
            $mail->attachFromStorageDisk('private', $this->path);
        }

        return $mail;
    }
}

