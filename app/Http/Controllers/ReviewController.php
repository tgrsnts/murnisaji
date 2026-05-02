<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Show user reviews history
     */
    public function index()
    {
        $data = TransaksiItem::whereHas('transaksi', function ($query) {
            $query->where('id_user', Auth::user()->user_id)
                ->where('status', 'DELIVERED');
        })
            ->with(['produk', 'transaksi', 'rating'])
            ->latest()
            ->get();

        // return $data;

        return view('web.dashboard.review.index', compact('data'));
    }

    public function create($id)
    {
        $data = TransaksiItem::where('transaksi_item_id', $id)
            ->whereHas('transaksi', function ($query) {
                $query->where('id_user', Auth::user()->user_id)
                    ->where('status', 'DELIVERED');
            })
            ->with('produk')
            ->firstOrFail();

        return view('web.dashboard.review.create', compact('data'));
    }

    public function store(Request $request)
    {        
        $validated = $request->validate([
            'id_transaksi_item' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'gambar' => 'nullable|image|max:2048',
        ]); 

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('reviews', 'public');
            $validated['gambar'] = $path;
        }    
        
        if(Rating::where('id_transaksi_item', $validated['id_transaksi_item'])->exists()) {
            return redirect()->back()->with('error', 'Anda sudah memberikan ulasan untuk produk ini.');
        }

        $rating = Rating::create($validated);

        if ($rating) {
            TransaksiItem::where('transaksi_item_id', $validated['id_transaksi_item'])->update(['israted' => 1]);
            return redirect()->route('dashboard.reviews')->with('success', 'Ulasan berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan ulasan. Silakan coba lagi.');
        }
    }
}
