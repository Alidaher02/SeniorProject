<?php

namespace App\Enums;

enum ShipmentStatus: string
{
    case PENDING = "pending";
    case APPROVED = "approved";
    case IN_TRANSIT = 'in_transit';
    case DELIVERED = 'delivered';
    case REJECTED = 'rejected';
}

