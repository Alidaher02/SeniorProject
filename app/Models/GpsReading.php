<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GpsReading extends Model
{
    protected $fillable = [
        'shipment_id',
        'latitude',
        'longitude',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }


}
