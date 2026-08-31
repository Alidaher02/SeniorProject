<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationPolicy
{
    /**
     * Create a new policy instance.
     */
    public function read(
        User $user,
        DatabaseNotification $notification
    ): bool {
        return $notification->notifiable_id === $user->id;
    }
}
