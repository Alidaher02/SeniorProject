<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class SensorReading extends Model
{
    protected $fillable = [
        'shipment_id',
        'temperature',
        'humidity',
         'latitude',
    'longitude',
    ];


    public function shipment(){

        return $this->belongsTo(Shipment::class);
    }
}
