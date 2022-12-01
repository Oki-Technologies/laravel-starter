<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Plank\Mediable\Media as PlankMedia;
use Tenancy\Affects\Connections\Support\Traits\OnTenant;

class Media extends PlankMedia
{
    use HasFactory;
    use HasUuids;
    use OnTenant;
}
