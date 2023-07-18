<?php

namespace App\Listeners;

use App\Events\WelcomeEvent;
use App\Mail\WelcomeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class WelcomeEmailListener implements ShouldQueue
{

    public $queue = 'listener';
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\WelcomeEvent  $event
     * @return void
     */
    public function handle(WelcomeEvent $event)
    {
        $user = $event->user;
        $emailData = [
            'subject' => 'Welcome to LearnVern Watch Store',
            'body' => 'Welcome to LearnVern Watch Store.',
            'tagline' => 'LEARN ANY COURSE FOR FREE IN YOUR OWN LANGUAGE UPDATED.'
        ];
        Mail::to((string) $user->email)
            ->send(new WelcomeEmail($emailData));
    }
}
