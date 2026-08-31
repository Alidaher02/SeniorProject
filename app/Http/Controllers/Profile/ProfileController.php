<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

public function update(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'image' => ['nullable', 'image', 'max:2048'],
    ]);

    $user = $request->user();

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')
            ->store('profile-images', 'public');
    }

    $user->update($validated);

    return response()->json([
        'message' => 'Profile updated successfully'
    ]);
}

    public function deleteImage()
    {
        $user = Auth::user();

        if ($user->image) {
            Storage::disk('public')->delete($user->image);

            $user->image = null;
            $user->save();
        }

        return response()->json([
            'message' => 'Image deleted successfully',
            'name' => $user->name,
        ]);
    }
}
