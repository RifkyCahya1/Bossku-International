<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $unsubscribeToken;

    public function __construct($email)
    {
        $this->email = $email;
        $this->unsubscribeToken = md5($email . config('app.key'));
    }

    public function build()
    {
        return $this->subject('🎉 Welcome to BOSSKU.TOURS!')
            ->view('Mail.subscription-confirmation') // Pastikan path ini benar
            ->with([
                'email' => $this->email,
                'unsubscribeToken' => $this->unsubscribeToken,
                'currentYear' => date('Y')
            ]);
    }
}
