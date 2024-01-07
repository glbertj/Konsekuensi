<?php

namespace App\Listeners;

use App\Events\GlobalNotif;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GlobalNotifListener implements ShouldQueue
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
     * @param  \App\Events\GlobalNotif  $event
     * @return void
     */
    public function handle(GlobalNotif $event)
    {
        broadcast(new GlobalNotif($event->message));

    }
}