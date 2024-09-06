<?php

namespace App\Listeners;

use App\Events\NewUserEvent;
use App\Mail\NewUserRegistrationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;


class NewUserListener implements ShouldQueue
{
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
     * @param  object  $event
     * @return void
     */
    public function handle(NewUserEvent $event)
    {
        $data = $event->data;
        Mail::to($data['email'])->send(new NewUserRegistrationMail($data));
    }
}
