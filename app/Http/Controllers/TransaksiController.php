<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display cart page
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $subtotal = 0;

        foreach ($cart as $produk_id => $item) {
            $produk = Produk::find($produk_id);
            if ($produk) {
                $cartItems[] = [
                    'produk' => $produk,
                    'qty' => $item['qty'],
                    'subtotal' => $produk->harga * $item['qty']
                ];
                $subtotal += $produk->harga * $item['qty'];
            }
        }

        return view('web.transaksi.index', [
            'title' => 'Keranjang Belanja',
            'cartItems' => $cartItems,
            'subtotal' => $subtotal
        ]);
    }

    /**
     * Display checkout page
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong');
        }

        $cartItems = [];
        $subtotal = 0;

        foreach ($cart as $produk_id => $item) {
            $produk = Produk::find($produk_id);
            if ($produk) {
                $cartItems[] = [
                    'produk' => $produk,
                    'qty' => $item['qty'],
                    'subtotal' => $produk->harga * $item['qty']
                ];
                $subtotal += $produk->harga * $item['qty'];
            }
        }

        $savedAddresses = collect();
        if (Auth::check()) {
            $savedAddresses = Alamat::where('id_user', Auth::user()->user_id)
                ->orderByDesc('isPrimary')
                ->orderByDesc('created_at')
                ->get();
        }

        return view('web.transaksi.checkout', [
            'title' => 'Checkout',
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'savedAddresses' => $savedAddresses,
        ]);
    }

    /**
     * Add product to cart
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,produk_id',
            'qty' => 'required|integer|min:1'
        ]);

        $produk = Produk::find($request->produk_id);

        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        if ($request->qty > $produk->stok) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$request->produk_id])) {
            $cart[$request->produk_id]['qty'] += $request->qty;
        } else {
            $cart[$request->produk_id] = [
                'qty' => $request->qty
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    /**
     * Update cart item quantity
     */
    public function updateCartItem(Request $request, $produk_id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$produk_id])) {
            $produk = Produk::find($produk_id);
            
            if ($request->qty > $produk->stok) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi');
            }

            $cart[$produk_id]['qty'] = $request->qty;
            session()->put('cart', $cart);
            
            return redirect()->back()->with('success', 'Jumlah produk berhasil diupdate');
        }

        return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang');
    }

    /**
     * Remove item from cart
     */
    public function removeCartItem($produk_id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$produk_id])) {
            unset($cart[$produk_id]);
            session()->put('cart', $cart);
            
            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang');
        }

        return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang');
    }

    /**
     * Clear all cart
     */
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan');
    }

    /**
     * Process checkout and create transaction
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $isLoggedIn = Auth::check();
        $hasSavedAddress = $isLoggedIn
            ? Alamat::where('id_user', $user->user_id)->exists()
            : false;

        $rules = [
            'email' => 'nullable|email|max:255',
            'catatan_kurir' => 'nullable|string|max:255',
            'kurir' => 'required|string',
            'layanan_kurir' => 'required|string',
            'ongkir' => 'required|numeric|min:0',
        ];

        if ($isLoggedIn && $hasSavedAddress) {
            $rules['selected_alamat_id'] = 'required|exists:alamats,alamat_id';
        } else {
            $rules = array_merge($rules, [
                'nama_penerima' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:20',
                'label_alamat' => 'required|string|max:255',
                'detail' => 'required|string',
                'provinsi' => 'required|string|max:255',
                'province_id' => 'required|integer|min:1',
                'kabupaten' => 'required|string|max:255',
                'city_id' => 'required|integer|min:1',
                'kecamatan' => 'required|string|max:255',
                'kodepos' => 'required|string|max:10',
            ]);
        }

        $validated = $request->validate($rules);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong');
        }

        // Calculate total
        $total_harga_produk = 0;
        foreach ($cart as $produk_id => $item) {
            $produk = Produk::find($produk_id);
            if ($produk) {
                $total_harga_produk += $produk->harga * $item['qty'];
            }
        }

        $total_bayar = $total_harga_produk + $request->ongkir;

        $alamatId = null;

        if ($isLoggedIn && $hasSavedAddress) {
            $alamat = Alamat::where('alamat_id', $validated['selected_alamat_id'])
                ->where('id_user', $user->user_id)
                ->firstOrFail();

            $alamatId = $alamat->alamat_id;
            $alamatData = [
                'nama_penerima' => $alamat->nama_penerima,
                'no_telepon' => $alamat->no_telepon,
                'label_alamat' => $alamat->label_alamat,
                'detail' => $alamat->detail,
                'provinsi' => $alamat->provinsi,
                'province_id' => $alamat->province_id,
                'kabupaten' => $alamat->kabupaten,
                'city_id' => $alamat->city_id,
                'kecamatan' => $alamat->kecamatan,
                'kodepos' => $alamat->kodepos,
                'catatan_kurir' => $request->catatan_kurir ?? $alamat->catatan_kurir,
            ];
        } else {
            $alamatData = [
                'nama_penerima' => $request->nama_penerima,
                'no_telepon' => $request->no_telepon,
                'label_alamat' => $request->label_alamat,
                'detail' => $request->detail,
                'provinsi' => $request->provinsi,
                'province_id' => $request->province_id,
                'kabupaten' => $request->kabupaten,
                'city_id' => $request->city_id,
                'kecamatan' => $request->kecamatan,
                'kodepos' => $request->kodepos,
                'catatan_kurir' => $request->catatan_kurir,
            ];

            // If user logged in and has no saved address, save this address first.
            if ($isLoggedIn && !$hasSavedAddress) {
                $newAlamat = Alamat::create([
                    'id_user' => $user->user_id,
                    'nama_penerima' => $request->nama_penerima,
                    'no_telepon' => $request->no_telepon,
                    'label_alamat' => $request->label_alamat,
                    'detail' => $request->detail,
                    'provinsi' => $request->provinsi,
                    'province_id' => $request->province_id,
                    'kabupaten' => $request->kabupaten,
                    'city_id' => $request->city_id,
                    'kecamatan' => $request->kecamatan,
                    'kodepos' => $request->kodepos,
                    'isPrimary' => true,
                    'catatan_kurir' => $request->catatan_kurir,
                ]);

                $alamatId = $newAlamat->alamat_id;
            }
        }

        // Create transaction
        $transaksi = Transaksi::create([
            'id_user' => $isLoggedIn ? $user->user_id : null,
            'id_alamat' => $alamatId,
            'nama_penerima' => $alamatData['nama_penerima'],
            'no_telepon' => $alamatData['no_telepon'],
            'email' => $request->email ?? ($isLoggedIn ? $user->email : null),
            'label_alamat' => $alamatData['label_alamat'],
            'detail' => $alamatData['detail'],
            'provinsi' => $alamatData['provinsi'],
            'province_id' => $alamatData['province_id'],
            'kabupaten' => $alamatData['kabupaten'],
            'city_id' => $alamatData['city_id'],
            'kecamatan' => $alamatData['kecamatan'],
            'kodepos' => $alamatData['kodepos'],
            'catatan_kurir' => $alamatData['catatan_kurir'],
            'total_harga_produk' => $total_harga_produk,
            'ongkir' => $request->ongkir,
            'total_bayar' => $total_bayar,
            'kurir' => $request->kurir,
            'layanan_kurir' => $request->layanan_kurir,
            'status' => 'PENDING',
            'resi' => null,
        ]);

        // Create transaction items
        foreach ($cart as $produk_id => $item) {
            $produk = Produk::find($produk_id);
            if ($produk) {
                TransaksiItem::create([
                    'id_transaksi' => $transaksi->transaksi_id,
                    'id_produk' => $produk_id,
                    'quantity' => $item['qty'],
                    'harga_saat_beli' => $produk->harga,
                    'israted' => false
                ]);

                // Update stock
                $produk->stok -= $item['qty'];
                $produk->save();
            }
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('transaksi.show', $transaksi->transaksi_id)
            ->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Display transaction detail
     */
    public function show($id)
    {
        $transaksi = Transaksi::with(['items.produk', 'alamat', 'user', 'payment'])
            ->where('transaksi_id', $id)
            ->first();

        if (!$transaksi) {
            abort(404);
        }

        return view('web.transaksi.show', [
            'title' => 'Detail Pesanan',
            'transaksi' => $transaksi
        ]);
    }
}
