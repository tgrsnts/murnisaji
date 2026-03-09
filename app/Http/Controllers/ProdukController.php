<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::with(['transaksiItems.rating'])
            ->latest()
            ->paginate(9);

        return view('web.menu.index', [
            'title' => 'Menu',
            'produk' => $produk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     Produk::create([
    //         'nama_produk' => $request->nama_produk,
    //         'kategori' => $request->kategori,
    //         'deskripsi' => $request->deskripsi,
    //         'harga' => $request->harga,
    //         'stok' => $request->stok,
    //         'berat_gram' => $request->berat_gram,
    //         'gambar' => $request->gambar
    //     ]);
    // }

    /**
     * Display the specified resource.
     */
    /**
     * Detail produk
     * URL: /menu/{produk_id}
     */
    public function show($produk_id)
    {
        $produk = Produk::with(['transaksiItems.rating', 'transaksiItems.transaksi.user'])
            ->where('produk_id', $produk_id)
            ->first();

        if (!$produk) {
            abort(404);
        }

        // Get reviews with user information
        $reviews = $produk->transaksiItems()
            ->whereHas('rating')
            ->with(['rating', 'transaksi.user'])
            ->get()
            ->map(function ($item) {
                return [
                    'user' => $item->transaksi->user,
                    'rating' => $item->rating->rating,
                    'comment' => $item->rating->comment,
                    'gambar' => $item->rating->gambar,
                    'created_at' => $item->rating->created_at,
                ];
            });

        return view('web.menu.show', [
            'title' => $produk->nama_produk,
            'produk' => $produk,
            'reviews' => $reviews
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
