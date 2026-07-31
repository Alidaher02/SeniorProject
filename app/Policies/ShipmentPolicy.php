<?php

namespace App\Policies;

use App\Models\Shipment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShipmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function updateOrDelete(User $user , Shipment $shipment): bool
    {
        // return $shipment->customer->is($user);
        return $shipment->customer_id === $user->id || $user->isAdmin();
    }


    
}
