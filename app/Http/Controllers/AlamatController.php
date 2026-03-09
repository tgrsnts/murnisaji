<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    /**
     * Store a new address via AJAX
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'catatan' => 'nullable|string|max:255'
        ]);

        // For demo, we'll use a dummy user_id = 2 (first customer from seed)
        // In real app, use Auth::id() after implementing authentication
        $user_id = 2;

        $alamat = Alamat::create([
            'id_user' => $user_id,
            'label' => $request->label,
            'alamat_lengkap' => $request->alamat_lengkap,
            'catatan' => $request->catatan
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Alamat berhasil ditambahkan',
            'data' => $alamat
        ]);
    }
}
