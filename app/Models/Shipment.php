<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Shipment extends Model
{
    public function user(): BelongsTo
    {

         return $this->BelongsTo(User::class);
    }
}
