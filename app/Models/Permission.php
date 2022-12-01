<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Tenancy\Affects\Connections\Support\Traits\OnTenant;

class Permission extends SpatiePermission
{
    use HasFactory;
    use HasUuids;
    use OnTenant;
}
