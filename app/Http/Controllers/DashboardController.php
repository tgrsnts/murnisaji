<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Rating;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show user dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user transactions
        $transactions = Transaksi::where('id_user', $user->user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Count stats
        $totalTransactions = Transaksi::where('id_user', $user->user_id)->count();
        $totalSpent = Transaksi::where('id_user', $user->user_id)->sum('total_bayar');
        $pendingTransactions = Transaksi::where('id_user', $user->user_id)
            ->whereIn('status', ['PENDING', 'PROCESS'])
            ->count();

        return view('web.dashboard.index', compact('user', 'transactions', 'totalTransactions', 'totalSpent', 'pendingTransactions'));
    }

    /**
     * Show user profile
     */
    public function profile()
    {
        $user = Auth::user();
        return view('web.dashboard.profile.index', compact('user'));
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'telp' => 'required|string|max:20',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'telp.required' => 'Nomor telepon harus diisi',
        ]);

        $user->fill($validated);
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');
    }

    /**
     * Show transaction detail
     */
    public function showTransaction($id)
    {
        $transaction = Transaksi::where('transaksi_id', $id)
            ->where('id_user', Auth::user()->user_id)
            ->with(['items.produk', 'payment'])
            ->firstOrFail();

        return view('web.dashboard.transaksi.index', compact('transaction'));
    }

    /**
     * Mark shipped transaction as received by user.
     */
    public function receiveTransaction($id)
    {
        $transaction = Transaksi::where('transaksi_id', $id)
            ->where('id_user', Auth::user()->user_id)
            ->firstOrFail();

        if ($transaction->status !== 'SHIPPED') {
            return back()->with('error', 'Pesanan tidak bisa dikonfirmasi saat ini.');
        }

        $transaction->status = 'DONE';
        $transaction->save();

        return back()->with('success', 'Pesanan berhasil dikonfirmasi diterima.');
    }

    /**
     * Show user addresses
     */
    public function addresses()
    {
        $addresses = Alamat::where('id_user', Auth::user()->user_id)
            ->orderByDesc('isPrimary')
            ->orderByDesc('created_at')
            ->get();

        return view('web.dashboard.alamat.index', compact('addresses'));
    }

    /**
     * Show user reviews history
     */
    public function reviews()
    {
        $reviews = Rating::whereHas('transaksiItem.transaksi', function ($query) {
            $query->where('id_user', Auth::user()->user_id);
        })
            ->with(['transaksiItem.produk', 'transaksiItem.transaksi'])
            ->latest()
            ->get();

        return view('web.dashboard.review.index', compact('reviews'));
    }

    /**
     * Store a new address
     */
    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'label_alamat' => 'required|string|max:100',
            'nama_penerima' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:20',
            'provinsi' => 'required|string|max:100',
            'province_id' => 'required|integer',
            'kabupaten' => 'required|string|max:100',
            'city_id' => 'required|integer',
            'kecamatan' => 'required|string|max:100',
            'desa' => 'nullable|string|max:100',
            'detail' => 'required|string',
            'kodepos' => 'required|string|max:10',
            'isPrimary' => 'nullable|boolean',
        ], [
            'label_alamat.required' => 'Label alamat harus diisi',
            'nama_penerima.required' => 'Nama penerima harus diisi',
            'no_telepon.required' => 'Nomor telepon harus diisi',
            'provinsi.required' => 'Provinsi harus dipilih',
            'kabupaten.required' => 'Kabupaten harus dipilih',
            'kecamatan.required' => 'Kecamatan harus diisi',
            'detail.required' => 'Detail alamat harus diisi',
            'kodepos.required' => 'Kode pos harus diisi',
        ]);

        // If this is set as primary, unset other primary addresses
        if ($request->isPrimary) {
            Alamat::where('id_user', Auth::user()->user_id)
                ->update(['isPrimary' => false]);
        }

        // Create new address
        $alamat = new Alamat();
        $alamat->id_user = Auth::user()->user_id;
        $alamat->label_alamat = $validated['label_alamat'];
        $alamat->nama_penerima = $validated['nama_penerima'];
        $alamat->no_telepon = $validated['no_telepon'];
        $alamat->provinsi = $validated['provinsi'];
        $alamat->province_id = $validated['province_id'];
        $alamat->kabupaten = $validated['kabupaten'];
        $alamat->city_id = $validated['city_id'];
        $alamat->kecamatan = $validated['kecamatan'];
        $alamat->desa = $validated['desa'] ?? null;
        $alamat->detail = $validated['detail'];
        $alamat->kodepos = $validated['kodepos'];
        $alamat->isPrimary = $request->isPrimary ?? false;
        $alamat->save();

        return back()->with('success', 'Alamat berhasil ditambahkan');
    }

    /**
     * Update an existing address
     */
    public function updateAddress(Request $request, $id)
    {
        $alamat = Alamat::where('alamat_id', $id)
            ->where('id_user', Auth::user()->user_id)
            ->firstOrFail();

        $validated = $request->validate([
            'label_alamat' => 'required|string|max:100',
            'nama_penerima' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:20',
            'provinsi' => 'required|string|max:100',
            'province_id' => 'required|integer',
            'kabupaten' => 'required|string|max:100',
            'city_id' => 'required|integer',
            'kecamatan' => 'required|string|max:100',
            'desa' => 'nullable|string|max:100',
            'detail' => 'required|string',
            'kodepos' => 'required|string|max:10',
            'isPrimary' => 'nullable|boolean',
        ], [
            'label_alamat.required' => 'Label alamat harus diisi',
            'nama_penerima.required' => 'Nama penerima harus diisi',
            'no_telepon.required' => 'Nomor telepon harus diisi',
            'provinsi.required' => 'Provinsi harus dipilih',
            'kabupaten.required' => 'Kabupaten harus dipilih',
            'kecamatan.required' => 'Kecamatan harus diisi',
            'detail.required' => 'Detail alamat harus diisi',
            'kodepos.required' => 'Kode pos harus diisi',
        ]);

        // If this is set as primary, unset other primary addresses
        if ($request->isPrimary) {
            Alamat::where('id_user', Auth::user()->user_id)
                ->where('alamat_id', '!=', $id)
                ->update(['isPrimary' => false]);
        }

        // Update address
        $alamat->fill($validated);
        $alamat->isPrimary = $request->isPrimary ?? false;
        $alamat->save();

        return back()->with('success', 'Alamat berhasil diperbarui');
    }

    /**
     * Delete an address
     */
    public function destroyAddress($id)
    {
        $alamat = Alamat::where('alamat_id', $id)
            ->where('id_user', Auth::user()->user_id)
            ->firstOrFail();

        $alamat->delete();

        return back()->with('success', 'Alamat berhasil dihapus');
    }
}
