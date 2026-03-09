<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::with(['alamat.user', 'items.produk'])
            ->latest()
            ->paginate(20);

        return view('admin.transaksi.index', [
            'title' => 'Daftar Transaksi',
            'transaksis' => $transaksis
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['alamat.user', 'items.produk']);

        return view('admin.transaksi.show', [
            'title' => 'Detail Transaksi',
            'transaksi' => $transaksi
        ]);
    }

    /**
     * Update status transaksi
     */
    public function updateStatus(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'status' => 'required|in:PENDING,PAID,PACKED,SHIPPED,DONE,CANCEL'
        ]);

        $transaksi->update(['status' => $validated['status']]);

        return back()->with('success', 'Status transaksi berhasil diperbarui.');
    }

    /**
     * Update resi transaksi
     */
    public function updateResi(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'resi' => 'required|string|max:255'
        ]);

        $transaksi->update([
            'resi' => $validated['resi'],
            'status' => 'SHIPPED'
        ]);

        return back()->with('success', 'Nomor resi berhasil ditambahkan dan status diubah menjadi SHIPPED.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}
