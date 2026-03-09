@extends('web.layouts.app')

@section('content')
    <section class="bg-white px-20 py-12 min-h-screen">
        <div class="max-w-4xl mx-auto">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg flex items-center gap-3">
                    <i class="fas fa-check-circle text-2xl"></i>
                    <div>
                        <p class="font-semibold">{{ session('success') }}</p>
                        <p class="text-sm">Terima kasih telah berbelanja di Murnisaji</p>
                    </div>
                </div>
            @endif

            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-[#7A1F1F] text-white p-6">
                    <h1 class="text-2xl font-bold mb-2">Detail Pesanan</h1>
                    <p class="text-sm opacity-90">Order ID: #{{ $transaksi->transaksi_id }}</p>
                </div>

                <!-- Order Info -->
                <div class="p-6 border-b border-gray-200">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Tanggal Pesanan</p>
                            <p class="font-semibold">{{ $transaksi->created_at->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Status</p>
                            @php
                                $statusColors = [
                                    'PENDING' => 'bg-yellow-100 text-yellow-800',
                                    'PAID' => 'bg-orange-100 text-orange-800',
                                    'PACKED' => 'bg-purple-100 text-purple-800',
                                    'SHIPPED' => 'bg-blue-100 text-blue-800',
                                    'DONE' => 'bg-green-100 text-green-800',
                                    'CANCEL' => 'bg-red-100 text-red-800',
                                ];
                                $statusColor = $statusColors[$transaksi->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                                {{ $transaksi->status }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Kurir</p>
                            <p class="font-semibold">{{ $transaksi->kurir }} - {{ $transaksi->layanan_kurir }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">No. Resi</p>
                            <p class="font-semibold">{{ $transaksi->resi ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="p-6 border-b border-gray-200">
                    <h3 class="font-bold text-gray-900 mb-3">Alamat Pengiriman</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="font-semibold text-gray-900 mb-1">{{ $transaksi->user->name }}</p>
                        <p class="text-gray-700">{{ $transaksi->alamat->alamat_lengkap }}</p>
                        <p class="text-gray-700">{{ $transaksi->alamat->kota }}, {{ $transaksi->alamat->kode_pos }}</p>
                        <p class="text-gray-700 mt-2">{{ $transaksi->alamat->no_telp }}</p>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="p-6 border-b border-gray-200">
                    <h3 class="font-bold text-gray-900 mb-4">Produk Pesanan</h3>
                    <div class="space-y-4">
                        @foreach ($transaksi->items as $item)
                            <div class="flex gap-4">
                                <div class="w-20 h-20 bg-gray-100 rounded-lg flex-shrink-0">
                                    @if ($item->produk->gambar)
                                        <img src="{{ asset('storage/' . $item->produk->gambar) }}"
                                            alt="{{ $item->produk->nama_produk }}"
                                            class="w-full h-full object-cover rounded-lg">
                                    @else
                                        <img src="/images/Abon Sapi.png" alt="{{ $item->produk->nama_produk }}"
                                            class="w-full h-full object-contain rounded-lg">
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">{{ $item->produk->nama_produk }}</h4>
                                    <p class="text-sm text-gray-500">{{ $item->produk->kategori }}</p>
                                    <p class="text-sm text-gray-600 mt-1">{{ $item->quantity }} x Rp
                                        {{ number_format($item->harga_saat_beli, 0, ',', '.') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">Rp
                                        {{ number_format($item->harga_saat_beli * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Payment Summary -->
                <div class="p-6 bg-gray-50">
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal Produk</span>
                            <span class="font-medium">Rp {{ number_format($transaksi->total_harga_produk, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Ongkos Kirim</span>
                            <span class="font-medium">Rp {{ number_format($transaksi->ongkir, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold border-t pt-2">
                            <span>Total Pembayaran</span>
                            <span class="text-[#7A1F1F]">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    @if ($transaksi->status == 'PENDING')
                        <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <p class="text-sm text-yellow-800 mb-2"><i class="fas fa-info-circle"></i> <strong>Menunggu Pembayaran</strong></p>
                            <p class="text-sm text-yellow-700">Silakan lakukan pembayaran untuk melanjutkan pesanan Anda.</p>
                        </div>
                    @endif

                    @if ($transaksi->status == 'SHIPPED' && $transaksi->resi)
                        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-sm text-blue-800 mb-2"><i class="fas fa-shipping-fast"></i> <strong>Pesanan Sedang Dikirim</strong></p>
                            <p class="text-sm text-blue-700">Nomor Resi: <strong>{{ $transaksi->resi }}</strong></p>
                            <p class="text-sm text-blue-700">Silakan lacak paket Anda melalui website kurir.</p>
                        </div>
                    @endif

                    @if ($transaksi->status == 'DONE')
                        <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <p class="text-sm text-green-800 mb-2"><i class="fas fa-check-circle"></i> <strong>Pesanan Selesai</strong></p>
                            <p class="text-sm text-green-700">Terima kasih telah berbelanja di Murnisaji!</p>
                        </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="p-6 flex gap-3">
                    <a href="{{ route('menu.index') }}"
                        class="flex-1 text-center bg-[#7A1F1F] text-white py-3 rounded-lg font-semibold hover:bg-[#5A0F0F] transition">
                        Lanjut Belanja
                    </a>
                    <button onclick="window.print()"
                        class="px-6 py-3 border-2 border-[#7A1F1F] text-[#7A1F1F] rounded-lg font-semibold hover:bg-[#7A1F1F] hover:text-white transition">
                        <i class="fas fa-print mr-2"></i>Cetak
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection
