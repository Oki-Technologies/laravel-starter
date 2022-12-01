<?php

namespace App\Listeners;

use Database\Seeders\UserSeeder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Tenancy\Hooks\Migration\Events\ConfigureSeeds;

class ConfigureTenantSeeds
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
    public function handle(ConfigureSeeds $event)
    {
        $event->seed(UserSeeder::class);
    }
}
