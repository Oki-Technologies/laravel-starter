<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Permission\Models\Role as SpatieRole;
use Tenancy\Affects\Connections\Support\Traits\OnTenant;

class Role extends SpatieRole
{
    use HasFactory;
    use HasUuids;
    use OnTenant;
}
