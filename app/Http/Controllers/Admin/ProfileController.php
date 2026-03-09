<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // Get admin user (assuming it's user with ID 1 for now)
        $user = \App\Models\User::where('role', 1)->first();
        
        return view('admin.profile.index', [
            'title' => 'Profile Admin',
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        // Get admin user (assuming it's user with ID 1 for now)
        $user = \App\Models\User::where('role', 1)->first();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->user_id . ',user_id',
            'email' => 'required|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
            'telp' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Update basic info
        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->telp = $validated['telp'] ?? $user->telp;

        // Update password if provided
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($user->gambar) {
                Storage::delete('public/' . $user->gambar);
            }

            $path = $request->file('gambar')->store('users', 'public');
            $user->gambar = $path;
        }

        $user->save();

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profile berhasil diupdate');
    }
}
