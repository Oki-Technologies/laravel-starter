<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Tenancy\Affects\Routes\Events\ConfigureRoutes;

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
        if ($event->event->tenant) {
            $event
                // ->flush()
                ->fromFile(
                    ['middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified']],
                    base_path('/routes/tenant.php')
                );
        }
    }
}
