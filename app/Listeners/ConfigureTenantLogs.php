<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Tenancy\Affects\Logs\Events\ConfigureLogs;

class ConfigureTenantLogs
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
    public function handle(ConfigureLogs $event)
    {
        if ($event->event->tenant and $event->event->tenant->slack_webhook_url) {
            $event->config = [
                'driver' => 'slack',
                'url' => $event->event->tenant->slack_webhook_url,
                'username' => 'Tenant Logs',
                'emoji' => ':boom:',
                'level' => 'critical',
            ];
        }
    }
}
