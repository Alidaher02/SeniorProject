<?php

namespace App\Http\Controllers;

use Dom\Notation;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->unreadNotifications()->latest()->limit(5)->get();

        return response()->json([
            'notifications' => $notifications,
            'count' =>  $notifications->count()
        ]);
    }
    public function read(DatabaseNotification $notification)
    {

    if ($notification->notifiable_id !== Auth::id()) {
        abort(403);
    }

    $notification->markAsRead();

        return response()->json([
            'message' => 'Notification Readed!',
        ]);
    }
}

