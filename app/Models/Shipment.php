<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use App\Enums\ShipmentStatus;

class Shipment extends Model
{
    protected $fillable = [
    'product_name',
    'description',
    'origin',
    'destination',
    'min_temperature',
    'max_temperature',
    'departure_date',
    'expected_arrival',
    'tracking-number',
    'status',
];

    protected $casts = [
        'status' => ShipmentStatus::class
    ];

    public function user(): BelongsTo
    {

         return $this->belongsTo(User::class);
    }
}
