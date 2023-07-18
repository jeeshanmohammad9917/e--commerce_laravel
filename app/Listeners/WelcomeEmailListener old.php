<?php

namespace App\Listeners;

use App\Events\WelcomeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\WelcomeEmail;

class WelcomeEmailListener implements ShouldQueue
{
    public $queue = 'listener' ;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WelcomeEvent $event): void
    {   
        $user = $event->user;
        $emaildata=[
            'subject' => 'welcome zeeshu' ,
            'body' => 'welcome to zeeshanwebpage. this is exmaple of sending email using laravel.'
        ];
        mail::to((string) $user->email)
        ->send(new WelcomEmail($emaildata));
    }
}
