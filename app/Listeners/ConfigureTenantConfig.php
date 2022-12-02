<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Tenancy\Affects\Configs\Events\ConfigureConfig;

class ConfigureTenantConfig
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
    public function handle(ConfigureConfig $event)
    {
        if ($tenant = $event->event->tenant) {
            $event->set('app.name', $tenant->name);
            $event->set('app.url', $tenant->url);
            $event->set('app.asset_url', env('APP_URL'));
            $event->set('session.domain', $tenant->domain);
            $event->set('fortify.domain', $tenant->domain);

            // dd(config('fortify.domain'));
        }
    }
}
