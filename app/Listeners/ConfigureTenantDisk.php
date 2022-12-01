<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Tenancy\Affects\Filesystems\Events\ConfigureDisk;

class ConfigureTenantDisk
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
    public function handle(ConfigureDisk $event)
    {
        if (isset($event->event->tenant)) {
            $event->config = [
                'driver' => 'local',
                'root' => storage_path('app/' . $event->event->tenant->getTenantKey()),
            ];
        }
    }
}
