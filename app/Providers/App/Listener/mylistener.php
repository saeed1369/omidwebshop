<?php

namespace App\Providers\App\Listener;

use App\Providers\App\Events\baran;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class mylistener
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
     * @param  baran  $event
     * @return void
     */
    public function handle(baran $event)
    {
        //
    }
}
