<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Tenancy\Affects\Routes\Events\ConfigureRoutes;

use Illuminate\Support\Facades\Route;

class TenantRoutes
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
    public function handle(ConfigureRoutes $event)
    {
        if ($tenant = $event->event->tenant) {
            $event
                ->flush()
                ->fromFile(
                    [
                        'middleware'    => [config('jetstream.auth_session')],
                        'domain'        => $tenant->domain
                    ],
                    base_path('/routes/tenant.php')
                );
        }
    }
}
