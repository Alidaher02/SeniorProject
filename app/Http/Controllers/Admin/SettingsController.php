<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    public function update(Request $request)
    {

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
    ]);

    $request->user()->update($validated);

    return response()->json([
        'message' => 'Profile update successfully'
    ]);
    }

public function uploadPhoto(Request $request)
{
        dd([
        'upload_tmp_dir' => ini_get('upload_tmp_dir'),
        'sys_temp_dir' => sys_get_temp_dir(),
        'php_ini' => php_ini_loaded_file(),
        'file_uploads' => ini_get('file_uploads'),
        'has_file' => $request->hasFile('image'),
        'error' => $request->file('image')?->getError(),
    ]);
    $request->validate([
        'image' => ['required', 'image', 'max:2048'],
    ]);

    $path = $request->file('image')->store('profile-images', 'public');

    return back()->with('success', 'Image uploaded!');
}
}
