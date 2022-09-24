<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\SendReadyForHarvestNotification;
use Illuminate\Support\Facades\Notification;

class SendReadyForHarvestListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admins = User::whereHas('roles', function ($query) {
            $query->where('id', 1);
        })->get();

        Notification::send($admins, new SendReadyForHarvestNotification($event->farmerReport));
    }
}
