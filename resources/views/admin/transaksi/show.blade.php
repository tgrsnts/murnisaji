@extends('admin.layout.main')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Detail Transaksi #{{ $transaksi->transaksi_id }}</h2>
                    <p class="text-gray-600 text-sm mt-1">{{ $transaksi->created_at->format('d F Y, H:i') }}</p>
                </div>
                <a href="{{ route('admin.transaksi.index') }}"
                    class="px-4 py-2 border border-red-800 text-red-800 rounded-lg hover:bg-red-50">
                    Kembali
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Informasi Pelanggan -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-bold text-red-800 mb-4">Informasi Pelanggan</h3>
                <div class="space-y-2">
                    <div>
                        <span class="text-gray-600 text-sm">Nama:</span>
                        <p class="font-semibold">{{ $transaksi->alamat->user->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600 text-sm">Email:</span>
                        <p class="font-semibold">{{ $transaksi->alamat->user->email ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600 text-sm">Alamat Pengiriman:</span>
                        <p class="font-semibold">{{ $transaksi->alamat->alamat_lengkap ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-600">
                            {{ $transaksi->alamat->kota ?? '' }}, {{ $transaksi->alamat->provinsi ?? '' }}
                            {{ $transaksi->alamat->kode_pos ?? '' }}
                        </p>
                    </div>
                    <div>
                        <span class="text-gray-600 text-sm">No. Telepon:</span>
                        <p class="font-semibold">{{ $transaksi->alamat->no_telp ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Status & Pengiriman -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-bold text-red-800 mb-4">Status & Pengiriman</h3>
                <div class="space-y-4">
                    <!-- Status Update Form -->
                    <div>
                        <form action="{{ route('admin.transaksi.updateStatus', $transaksi->transaksi_id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <label class="text-gray-600 text-sm">Status Transaksi:</label>
                            <div class="flex gap-2 mt-1">
                                <select name="status" class="flex-1 p-2 border border-gray-300 rounded-lg text-sm">
                                    <option value="PENDING" {{ $transaksi->status == 'PENDING' ? 'selected' : '' }}>
                                        PENDING
                                    </option>
                                    <option value="PAID" {{ $transaksi->status == 'PAID' ? 'selected' : '' }}>PAID
                                    </option>
                                    <option value="PACKED" {{ $transaksi->status == 'PACKED' ? 'selected' : '' }}>PACKED
                                    </option>
                                    <option value="SHIPPED" {{ $transaksi->status == 'SHIPPED' ? 'selected' : '' }}>
                                        SHIPPED</option>
                                    <option value="DONE" {{ $transaksi->status == 'DONE' ? 'selected' : '' }}>DONE
                                    </option>
                                    <option value="CANCEL" {{ $transaksi->status == 'CANCEL' ? 'selected' : '' }}>CANCEL
                                    </option>
                                </select>
                                <button type="submit"
                                    class="px-4 py-2 bg-red-800 text-white rounded-lg hover:bg-red-900 text-sm">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Resi Update Form -->
                    <div>
                        <form action="{{ route('admin.transaksi.updateResi', $transaksi->transaksi_id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <label class="text-gray-600 text-sm">Nomor Resi:</label>
                            <div class="flex gap-2 mt-1">
                                <input type="text" name="resi" value="{{ $transaksi->resi }}"
                                    placeholder="Masukkan nomor resi"
                                    class="flex-1 p-2 border border-gray-300 rounded-lg text-sm">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                    Simpan
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Status akan otomatis berubah menjadi SHIPPED</p>
                        </form>
                    </div>

                    <div class="border-t pt-3">
                        <span class="text-gray-600 text-sm">Kurir:</span>
                        <p class="font-semibold">{{ $transaksi->kurir }} - {{ $transaksi->layanan_kurir }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Item Pesanan -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-bold text-red-800 mb-4">Item Pesanan</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="py-2 px-3 text-left text-sm">Produk</th>
                            <th class="py-2 px-3 text-right text-sm">Harga</th>
                            <th class="py-2 px-3 text-center text-sm">Qty</th>
                            <th class="py-2 px-3 text-right text-sm">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi->items as $item)
                            <tr class="border-b">
                                <td class="py-3 px-3">
                                    <div class="flex items-center gap-3">
                                        @if ($item->produk->gambar)
                                            <img src="{{ asset('storage/' . $item->produk->gambar) }}"
                                                alt="{{ $item->produk->nama_produk }}"
                                                class="w-12 h-12 object-cover rounded">
                                        @else
                                            <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                                <span class="text-xs text-gray-500">No Img</span>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-semibold text-sm">{{ $item->produk->nama_produk }}</p>
                                            <p class="text-xs text-gray-500">{{ $item->produk->kategori }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-3 text-right text-sm">
                                    Rp {{ number_format($item->harga_saat_beli, 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-3 text-center text-sm">
                                    {{ $item->quantity }}
                                </td>
                                <td class="py-3 px-3 text-right text-sm font-semibold">
                                    Rp {{ number_format($item->harga_saat_beli * $item->quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Ringkasan Pembayaran -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-bold text-red-800 mb-4">Ringkasan Pembayaran</h3>
            <div class="space-y-2 max-w-md ml-auto">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Subtotal Produk:</span>
                    <span class="font-semibold">Rp {{ number_format($transaksi->total_harga_produk, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Ongkir:</span>
                    <span class="font-semibold">Rp {{ number_format($transaksi->ongkir, 0, ',', '.') }}</span>
                </div>
                <div class="border-t pt-2 flex justify-between">
                    <span class="font-bold text-lg">Total Bayar:</span>
                    <span class="font-bold text-lg text-red-800">Rp
                        {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
