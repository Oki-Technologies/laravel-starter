<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Tenancy\Hooks\Database\Events\ConfigureDatabaseMutation;
use Tenancy\Tenant\Events\Deleted;

class ConfigureTenantDatabaseMutations
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
    public function handle(ConfigureDatabaseMutation $event)
    {
        if ($event->event instanceof Deleted) {
            $event->disable();
        }
    }
}
