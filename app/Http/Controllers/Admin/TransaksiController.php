<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Alamat;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Helper ambil cart dari session
     * Struktur:
     * cart = [
     *   produk_id => [
     *      'produk_id' => 1,
     *      'nama_produk' => '...',
     *      'harga' => 10000,
     *      'berat_gram' => 200,
     *      'gambar' => 'path',
     *      'qty' => 2,
     *   ],
     * ]
     */
    private function getCart(Request $request): array
    {
        return $request->session()->get('cart', []);
    }

    private function saveCart(Request $request, array $cart): void
    {
        $request->session()->put('cart', $cart);
    }

    private function cartSummary(array $cart): array
    {
        $totalQty = 0;
        $totalHarga = 0;
        $totalBerat = 0;

        foreach ($cart as $item) {
            $totalQty += (int) $item['qty'];
            $totalHarga += ((int) $item['harga']) * ((int) $item['qty']);
            $totalBerat += ((int) $item['berat_gram']) * ((int) $item['qty']);
        }

        return [
            'total_qty' => $totalQty,
            'total_harga_produk' => $totalHarga,
            'total_berat_gram' => $totalBerat,
        ];
    }

    /**
     * ==============
     * KERANJANG
     * ==============
     */

    // GET /cart (atau route ke transaksi.index kalau kamu mau)
    public function index(Request $request)
    {
        $cart = $this->getCart($request);
        $summary = $this->cartSummary($cart);

        // kalau user login, tampilkan alamatnya buat checkout
        $alamats = [];
        if (Auth::check()) {
            $alamats = Alamat::where('id_user', Auth::id())->get();
        }

        return view('cart.index', [
            'title' => 'Keranjang',
            'cart' => $cart,
            'summary' => $summary,
            'alamats' => $alamats,
        ]);
    }

    // POST /cart/add
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => ['required', 'integer'],
            'qty' => ['nullable', 'integer', 'min:1'],
        ]);

        $qty = $validated['qty'] ?? 1;

        $produk = Produk::find($validated['produk_id']);
        if (!$produk) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        if ($produk->stok < $qty) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $cart = $this->getCart($request);
        $pid = (int) $produk->produk_id;

        if (isset($cart[$pid])) {
            $newQty = $cart[$pid]['qty'] + $qty;
            if ($produk->stok < $newQty) {
                return back()->with('error', 'Stok tidak mencukupi untuk menambah quantity.');
            }
            $cart[$pid]['qty'] = $newQty;
        } else {
            $cart[$pid] = [
                'produk_id' => $pid,
                'nama_produk' => $produk->nama_produk,
                'harga' => (int) $produk->harga,
                'berat_gram' => (int) $produk->berat_gram,
                'gambar' => $produk->gambar,
                'qty' => $qty,
            ];
        }

        $this->saveCart($request, $cart);

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    // PATCH /cart/item/{produk_id}
    public function updateCartItem(Request $request, int $produk_id)
    {
        $validated = $request->validate([
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $cart = $this->getCart($request);

        if (!isset($cart[$produk_id])) {
            return back()->with('error', 'Item keranjang tidak ditemukan.');
        }

        $produk = Produk::find($produk_id);
        if (!$produk) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        if ($produk->stok < $validated['qty']) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $cart[$produk_id]['qty'] = (int) $validated['qty'];
        $this->saveCart($request, $cart);

        return back()->with('success', 'Keranjang diperbarui.');
    }

    // DELETE /cart/item/{produk_id}
    public function removeCartItem(Request $request, int $produk_id)
    {
        $cart = $this->getCart($request);

        if (!isset($cart[$produk_id])) {
            return back()->with('error', 'Item keranjang tidak ditemukan.');
        }

        unset($cart[$produk_id]);
        $this->saveCart($request, $cart);

        return back()->with('success', 'Item dihapus dari keranjang.');
    }

    // POST /cart/clear
    public function clearCart(Request $request)
    {
        $request->session()->forget('cart');
        return back()->with('success', 'Keranjang dikosongkan.');
    }

    /**
     * ==============
     * CHECKOUT -> BUAT TRANSAKSI
     * ==============
     */

    // POST /checkout
    public function store(Request $request)
    {
        // pastikan login (kalau kamu wajib login saat checkout)
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk checkout.');
        }

        $cart = $this->getCart($request);
        if (count($cart) === 0) {
            return back()->with('error', 'Keranjang masih kosong.');
        }

        $validated = $request->validate([
            'id_alamat' => ['required', 'integer'],
            'kurir' => ['required', 'string', 'max:50'],          // jne, tiki, pos, dll
            'layanan_kurir' => ['required', 'string', 'max:50'],  // REG, YES, OKE, dll
            'ongkir' => ['required', 'integer', 'min:0'],
        ]);

        // cek alamat milik user
        $alamat = Alamat::where('alamat_id', $validated['id_alamat'])
            ->where('id_user', Auth::id())
            ->first();

        if (!$alamat) {
            return back()->with('error', 'Alamat tidak valid.');
        }

        $summary = $this->cartSummary($cart);

        DB::beginTransaction();
        try {
            // 1) buat transaksi
            $transaksi = Transaksi::create([
                'id_user' => Auth::id(),
                'id_alamat' => (int) $validated['id_alamat'],
                'total_harga_produk' => (int) $summary['total_harga_produk'],
                'ongkir' => (int) $validated['ongkir'],
                'total_bayar' => (int) $summary['total_harga_produk'] + (int) $validated['ongkir'],
                'kurir' => $validated['kurir'],
                'layanan_kurir' => $validated['layanan_kurir'],
                'status' => 'WAITING_PAYMENT', // contoh
                'resi' => null,
            ]);

            // 2) buat transaksi_item + kurangi stok
            foreach ($cart as $item) {
                $produk = Produk::lockForUpdate()->find($item['produk_id']);
                if (!$produk) {
                    throw new \Exception('Produk tidak ditemukan saat checkout.');
                }

                if ($produk->stok < $item['qty']) {
                    throw new \Exception("Stok produk {$produk->nama_produk} tidak mencukupi.");
                }

                TransaksiItem::create([
                    'id_transaksi' => $transaksi->transaksi_id,
                    'id_produk' => $produk->produk_id,
                    'quantity' => (int) $item['qty'],
                    'harga_saat_beli' => (int) $produk->harga,
                    'israted' => false,
                ]);

                $produk->update([
                    'stok' => $produk->stok - (int) $item['qty'],
                ]);
            }

            DB::commit();

            // kosongkan keranjang
            $request->session()->forget('cart');

            // arahkan ke halaman detail transaksi
            return redirect()
                ->route('transaksi.show', $transaksi->transaksi_id)
                ->with('success', 'Checkout berhasil. Silakan lanjutkan pembayaran.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    // GET /transaksi/{id}
    public function show(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $transaksi = Transaksi::with(['items.produk', 'alamat'])
            ->where('transaksi_id', $id)
            ->where('id_user', Auth::id())
            ->first();

        if (!$transaksi) {
            abort(404);
        }

        return view('transaksi.show', [
            'title' => 'Detail Transaksi',
            'transaksi' => $transaksi,
        ]);
    }
}