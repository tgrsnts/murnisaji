<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 0)
            ->withCount(['alamats', 'transaksis'])
            ->withSum('transaksis', 'total_bayar')
            ->with(['transaksis' => function($query) {
                $query->latest()->limit(1);
            }])
            ->latest()
            ->paginate(20);

        return view('admin.users.index', [
            'title' => 'Daftar Customer',
            'users' => $users
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load(['alamats', 'transaksis.items.produk']);

        return view('admin.users.show', [
            'title' => 'Detail Customer',
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'title' => 'Edit Customer',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->user_id . ',user_id',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'telp' => 'required|string|max:20|unique:users,telp,' . $user->user_id . ',user_id',
            'role' => 'required|in:0,1',
            'password' => 'nullable|min:6',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Data customer berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Cek apakah user adalah admin
        if ($user->role == 1) {
            return back()->with('error', 'Tidak dapat menghapus user admin.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Customer berhasil dihapus.');
    }
}
