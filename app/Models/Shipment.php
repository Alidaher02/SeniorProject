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
    'customer_id',
    'driver_id',
    'product_name',
    'description',
    'origin',
    'destination',
    'min_temperature',
    'max_temperature',
    'min_humidity',
    'max_humidity',
    'departure_date',
    'expected_arrival',
    'tracking-number',
    'status',
];

    protected $casts = [
        'status' => ShipmentStatus::class
    ];

    public function customer(): BelongsTo
{
    return $this->belongsTo(User::class, 'customer_id');
}


public function driver(): BelongsTo
{
    return $this->belongsTo(User::class, 'driver_id');
}

public function sensorReadings(): HasMany
{
    return $this->hasMany(SensorReading::class);
}
public function alerts()
{
    return $this->hasMany(Alert::class);
}

public function gpsReadings()
{
    return $this->hasMany(GpsReading::class);
}

}
