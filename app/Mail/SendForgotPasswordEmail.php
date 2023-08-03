<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Blade;

class SendForgotPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $emailData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('zeeshanmohammad934@gmail.com', 'my store')
            ->replyTo('mohammadjeeshan9917@gmail.com', 'Reply To Email')
            ->subject('my store - Forgot Password Request')
            ->view('forgot_password_email')
            ->with([
                'token' => $this->emailData['token'],
                'email' => $this->emailData['email']
            ]);
    }
}
