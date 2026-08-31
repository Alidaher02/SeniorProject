<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Shipment;

class ShipmentAnalysis extends Model
{
    protected $fillable = [
        'shipment_id',
        'summary',
        'risk_percentage',
        'risk_level',
        'critical_count',
        'warning_count',
        'critical',
        'warnings',
        'recommendations',
        'analyzed_at',
    ];

    protected $casts = [
        'critical' => 'array',
        'warnings' => 'array',
        'recommendations' => 'array',
        'analyzed_at' => 'datetime',
    ];

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }
}