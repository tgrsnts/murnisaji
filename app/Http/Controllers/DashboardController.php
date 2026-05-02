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
            ->with(['items.produk', 'payment'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Count stats
        $totalTransactions = Transaksi::where('id_user', $user->user_id)->count();
        $totalSpent = Transaksi::where('id_user', $user->user_id)->sum('total_bayar');
        $pendingTransactions = Transaksi::where('id_user', $user->user_id)
            ->whereIn('status', ['PENDING'])
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

        $transaction->status = 'DELIVERED';
        $transaction->save();

        return back()->with('success', 'Pesanan berhasil dikonfirmasi diterima.');
    }
}
