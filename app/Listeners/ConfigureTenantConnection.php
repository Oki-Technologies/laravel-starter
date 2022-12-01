<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Tenancy\Affects\Connections\Events\Drivers\Configuring;

class ConfigureTenantConnection
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
    public function handle(Configuring $event)
    {
        $event->useConnection('mysql', $event->defaults($event->tenant));
    }
}
