@extends('admin.layout.main')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Detail Review #{{ $rating->rating_id }}</h2>
                    <p class="text-gray-600 text-sm mt-1">{{ $rating->created_at->format('d F Y, H:i') }}</p>
                </div>
                <a href="{{ route('admin.rating.index') }}"
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
            <!-- Informasi Produk -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-bold text-red-800 mb-4">Informasi Produk</h3>
                <div class="space-y-3">
                    <div class="flex gap-4">
                        @if ($rating->transaksiItem->produk->gambar)
                            <img src="{{ asset('storage/' . $rating->transaksiItem->produk->gambar) }}"
                                alt="{{ $rating->transaksiItem->produk->nama_produk }}"
                                class="w-24 h-24 object-cover rounded-lg">
                        @else
                            <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                                <span class="text-sm text-gray-500">No Image</span>
                            </div>
                        @endif
                        <div>
                            <p class="font-bold text-lg">{{ $rating->transaksiItem->produk->nama_produk }}</p>
                            <p class="text-sm text-gray-600">{{ $rating->transaksiItem->produk->kategori }}</p>
                            <p class="text-sm font-semibold text-red-800 mt-1">
                                Rp {{ number_format($rating->transaksiItem->harga_saat_beli, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-gray-500">
                                Qty: {{ $rating->transaksiItem->quantity }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Pelanggan -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-bold text-red-800 mb-4">Informasi Pelanggan</h3>
                <div class="space-y-2">
                    <div>
                        <span class="text-gray-600 text-sm">Nama:</span>
                        <p class="font-semibold">{{ $rating->transaksiItem->transaksi->alamat->user->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600 text-sm">Email:</span>
                        <p class="font-semibold">{{ $rating->transaksiItem->transaksi->alamat->user->email ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600 text-sm">ID Transaksi:</span>
                        <p class="font-semibold">#{{ $rating->transaksiItem->transaksi->transaksi_id }}</p>
                    </div>
                    <div>
                        <span class="text-gray-600 text-sm">Tanggal Transaksi:</span>
                        <p class="font-semibold">
                            {{ $rating->transaksiItem->transaksi->created_at->format('d F Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rating & Komentar -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-bold text-red-800 mb-4">Rating & Komentar</h3>

            <div class="mb-4">
                <div class="flex items-center gap-2">
                    <div class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $rating->rating)
                                <span class="text-yellow-500 text-2xl">★</span>
                            @else
                                <span class="text-[#D4AF5A] text-2xl">★</span>
                            @endif
                        @endfor
                    </div>
                    <span class="text-2xl font-bold text-red-800">{{ $rating->rating }}/5</span>
                </div>
            </div>

            <div class="mb-4">
                <h4 class="font-semibold text-gray-700 mb-2">Komentar:</h4>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-800">{{ $rating->comment ?? 'Tidak ada komentar' }}</p>
                </div>
            </div>

            @if ($rating->gambar)
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2">Foto Review:</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @php
                            $images = is_array($rating->gambar) ? $rating->gambar : json_decode($rating->gambar, true);
                            if (!is_array($images)) {
                                $images = [$rating->gambar];
                            }
                        @endphp

                        @foreach ($images as $image)
                            <div class="aspect-square overflow-hidden rounded-lg border border-gray-200">
                                <img src="{{ asset('storage/' . $image) }}" alt="Review Image"
                                    class="w-full h-full object-cover hover:scale-110 transition-transform cursor-pointer">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-end">
                <form action="{{ route('admin.rating.destroy', $rating->rating_id) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus review ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Hapus Review
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
