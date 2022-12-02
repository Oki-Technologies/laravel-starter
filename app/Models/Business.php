<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\InputInterface;
use Tenancy\Database\Drivers\Mysql\Concerns\ManagesSystemConnection;
use Tenancy\Hooks\Hostname\Contracts\HasHostnames;
use Tenancy\Identification\Concerns\AllowsTenantIdentification;
use Tenancy\Identification\Contracts\Tenant;
use Tenancy\Identification\Drivers\Console\Contracts\IdentifiesByConsole;
use Tenancy\Identification\Drivers\Http\Contracts\IdentifiesByHttp;
use Tenancy\Identification\Drivers\Queue\Contracts\IdentifiesByQueue;
use Tenancy\Identification\Drivers\Queue\Events\Processing;

class Business extends Model implements
    Tenant,
    ManagesSystemConnection,
    HasHostnames,
    IdentifiesByHttp,
    IdentifiesByQueue,
    IdentifiesByConsole
{
    use HasFactory;
    use HasUuids;
    use AllowsTenantIdentification;
    use Sluggable;

    protected $dispatchesEvents = [
        'created' => \Tenancy\Tenant\Events\Created::class,
        'updated' => \Tenancy\Tenant\Events\Updated::class,
        'deleted' => \Tenancy\Tenant\Events\Deleted::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'slug', 'hostname', 'path'
    ];

    /**
     * Interact with the tenant's hostname scheme.
     *
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function scheme(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => ($attributes['ssl'] ?? 0) ? 'https://' : 'http://',
        );
    }

    /**
     * Interact with the tenant's domain name.
     *
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function domain(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->hostname,
        );
    }

    /**
     * Interact with the tenant's url.
     *
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $this->scheme . $attributes['hostname'],
        );
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'    => 'name',
                // 'separator' => '_',
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getManagingSystemConnection(): ?string
    {
        return 'system-mysql';
    }

    public function getHostnames(): array
    {
        return [
            $this->hostname
        ];
    }

    /**
     * Specify whether the tenant model is matching the request.
     *
     * @param Request $request
     * @return Tenant
     */
    public function tenantIdentificationByHttp(Request $request): ?Tenant
    {
        $tenant = $this->query()->where('hostname', $request->getHttpHost())->first();
        $request['tenant'] = $tenant;

        return $tenant;
    }

    public function tenantIdentificationByQueue(Processing $event): ?Tenant
    {
        if ($event->tenant) {
            return $event->tenant;
        }

        if ($event->tenant_key && $event->tenant_identifier === $this->getTenantIdentifier()) {
            return $this->newQuery()
                ->where($this->getTenantKeyName(), $event->tenant_key)
                ->first();
        }

        return null;
    }

    /**
     * Specify whether the tenant model is matching the request.
     *
     * @param Request $request
     * @return Tenant
     */
    public function tenantIdentificationByConsole(InputInterface $input): ?Tenant
    {
        if ($input->hasParameterOption('--tenant')) {
            return $this->query()
                ->where('slug', $input->getParameterOption('--tenant'))
                ->first();
        }

        return null;
    }
}
