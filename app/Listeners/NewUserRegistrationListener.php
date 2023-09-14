<?php

namespace App\Listeners;

use App\Events\NewUserRegistrationEvent;
use App\Mail\NewUserRegistrationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewUserRegistrationListener
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
    public function handle(NewUserRegistrationEvent $event, array $data)
    {
        $d = 'sharonantony2408@gmail.com';
        Mail::to($d)->send(new NewUserRegistrationMail($data));
    }
}
