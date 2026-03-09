<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ratings = Rating::with(['transaksiItem.produk', 'transaksiItem.transaksi.alamat.user'])
            ->latest()
            ->paginate(20);

        return view('admin.rating.index', [
            'title' => 'Daftar Review',
            'ratings' => $ratings
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        $rating->load(['transaksiItem.produk', 'transaksiItem.transaksi.alamat.user']);

        return view('admin.rating.show', [
            'title' => 'Detail Review',
            'rating' => $rating
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        $rating->delete();

        return redirect()->route('admin.rating.index')
            ->with('success', 'Review berhasil dihapus.');
    }
}
