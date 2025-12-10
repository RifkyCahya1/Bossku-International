<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;

    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Status Pembayaran ' . $this->payment->invoice_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment_status',
            with: [
                'payment' => $this->payment
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
