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

    public function shipment(){
       return $this->belongsTo(Shipment::class);
    }
}
