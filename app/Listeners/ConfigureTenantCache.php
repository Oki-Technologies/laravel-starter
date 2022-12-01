<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Tenancy\Affects\Cache\Events\ConfigureCache;

class ConfigureTenantCache
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
    public function handle(ConfigureCache $event)
    {
        $event->config = [
            'driver' => 'database',
            'table' => 'cache',
            'connection' => 'tenant'
        ];
    }
}
