<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Tenancy\Identification\Events\NothingIdentified;

class NoTenantIdentified
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
    public function handle(NothingIdentified $event)
    {
        $host = parse_url(env('APP_URL'), PHP_URL_HOST);
        list($subdomain) = explode($host, request()->getHttpHost(), 2);

        if ($subdomain and !$event->tenant)
            abort(404);
    }
}
