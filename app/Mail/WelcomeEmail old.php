<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;
    //  public $emaildata = [];
     public $emaildata;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emaildata)
    {
        $this->emaildata =$emaildata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from('zeeshanmohammad934@gmail.com' ,'welcome buddy')
        ->replyTo('mohammadjeeshan9917@gmail.com' ,'jee')
        ->subject($this->emaildata['subject'])
        ->text('text_mail')
        ->view('text_mail')
        ->with('emaildata',$this->emaildata);
    }
}
