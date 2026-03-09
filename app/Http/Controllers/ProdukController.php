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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    /**
     * Detail produk
     * URL: /menu/{produk_id}
     */
    public function show($produk_id)
    {
        $produk = Produk::where('produk_id', $produk_id)->first();

        if (!$produk) {
            abort(404);
        }

        return view('web.menu.show', [
            'title' => $produk->nama_produk,
            'produk' => $produk
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
