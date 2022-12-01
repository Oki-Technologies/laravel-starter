<?php

namespace App\Listeners;

use App\Handlers\TenantHostnameHandler;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Tenancy\Hooks\Hostname\Events\ConfigureHostnames;

class ConfigureHostnameHandlers
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
    public function handle(ConfigureHostnames $event)
    {
        $event->registerHandler(new TenantHostnameHandler);
    }
}
