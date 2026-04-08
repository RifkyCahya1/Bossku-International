<?php

namespace App\Mail;

use App\Models\Partnership;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PartnerRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Partnership $partnership) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎉 Pendaftaran Community Partner BossKu Tours Diterima!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.partner-registration',
            with: [
                'partnership' => $this->partnership,
            ],
        );
    }
}