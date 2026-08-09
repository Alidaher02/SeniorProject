<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Alert extends Model
{
    protected $fillable = [
        'shipment_id',
        'type',
        'message',
        'severity',
        'is_read',
    ];

    public function getSensorNameAttribute()
{
    return match ($this->type) {
        'temperature' => 'Temperature Sensor',
        'humidity' => 'Humidity Sensor',
        'tilt' => 'Tilt Sensor',
        'light' => 'Light Sensor',
        default => 'Unknown Sensor',
    };
}

    public function shipment(){
       return $this->belongsTo(Shipment::class);
    }

    public function sensorReading()
    {
        return $this->belongsTo(SensorReading::class);
    }
}
