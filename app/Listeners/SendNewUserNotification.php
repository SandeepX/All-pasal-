<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewUserNotification;
use App\Models\User;

class SendNewUserNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    

    public function __construct()
    {
        //$this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admins = User::where('role','admin')->get();

        //dd($admins);
            

        Notification::send($admins, new NewUserNotification($event->user));
    }
}
