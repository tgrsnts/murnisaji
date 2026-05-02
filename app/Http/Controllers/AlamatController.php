<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlamatController extends Controller
{
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
