<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\ShipmentAnalysis;
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
    'min_temperature' => 'float',
    'max_temperature' => 'float',
    'min_humidity' => 'float',
    'max_humidity' => 'float',
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
public function alerts(): HasMany
{
    return $this->hasMany(Alert::class);
}

public function gpsReadings(): HasMany
{
    return $this->hasMany(GpsReading::class);
}

public function analysis(): HasOne
{
    return $this->hasOne(ShipmentAnalysis::class);
}

}
