<?php

namespace App\Listeners;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Tenancy\Affects\Models\Events\ConfigureModels;
use Tenancy\Facades\Tenancy;

class ConfigureTenantModels
{
    protected $models = [
        Role::class,
        Permission::class
    ];

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
    public function handle(ConfigureModels $event)
    {
        if ($event->event->tenant) {
            foreach ($this->models as $model) {
                $event->setConnection(
                    $model,
                    Tenancy::getTenantConnectionName()
                );
            }
        }
    }
}
