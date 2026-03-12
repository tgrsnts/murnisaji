@extends('web.dashboard.layout.main')

@php($title = 'Detail Transaksi')

@section('content')
    <div class="space-y-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-200 text-green-800 rounded-2xl p-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-200 text-red-800 rounded-2xl p-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
            <h1 class="text-3xl font-bold text-gray-900">Detail Transaksi</h1>
            <p class="text-gray-600 mt-1">No. Transaksi: #{{ $transaction->transaksi_id }}</p>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="xl:col-span-2 space-y-6">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">
                    <div class="flex justify-between items-start gap-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Status Transaksi</p>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $transaction->status }}</h2>
                        </div>
                        @if ($transaction->status === 'PENDING')
                            <form method="POST" action="{{ route('payment.createSnap', $transaction->transaksi_id) }}">
                                @csrf
                                <button type="submit"
                                    class="bg-[#7A1F1F] text-white px-4 py-2 rounded-lg hover:bg-[#5A0F0F] transition text-sm font-medium">
                                    Lanjutkan Pembayaran
                                </button>
                            </form>
                        @elseif ($transaction->status === 'SHIPPED')
                            <form method="POST"
                                action="{{ route('dashboard.transaction.receive', $transaction->transaksi_id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm font-medium">
                                    Pesanan Diterima
                                </button>
                            </form>
                        @elseif ($transaction->status === 'DONE')
                            <a href="{{ route('dashboard.reviews') }}"
                                class="inline-flex items-center bg-[#7A1F1F] text-white px-4 py-2 rounded-lg hover:bg-[#5A0F0F] transition text-sm font-medium">
                                Ulasan
                            </a>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Barang yang Dipesan</h3>
                    <div class="space-y-4 mb-4 pb-4 border-b border-gray-200">
                        @foreach ($transaction->items as $item)
                            <div class="flex justify-between items-start gap-3">
                                <div class="w-12 h-16 bg-gray-100 rounded-lg overflow-hidden">
                                    <img class="w-12" src="{{ asset('storage/' . $item->produk->gambar) }}"
                                        alt="">
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $item->produk->nama_produk ?? '-' }}</p>
                                    <p class="text-sm text-gray-600">{{ $item->quantity }} x
                                        Rp{{ number_format($item->harga_saat_beli, 0, ',', '.') }}</p>
                                </div>
                                <p class="font-semibold text-gray-900">
                                    Rp{{ number_format($item->quantity * $item->harga_saat_beli, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format($transaction->total_harga_produk, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkir ({{ strtoupper($transaction->kurir) }})</span>
                            <span>Rp{{ number_format($transaction->ongkir, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold text-gray-900 pt-2 border-t border-gray-200">
                            <span>Total</span>
                            <span>Rp{{ number_format($transaction->total_bayar, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Pengiriman</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-gray-600">Penerima</p>
                            <p class="font-medium text-gray-900">{{ $transaction->nama_penerima }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Alamat</p>
                            <p class="font-medium text-gray-900">{{ $transaction->detail }},
                                {{ $transaction->kecamatan }}, {{ $transaction->kabupaten }},
                                {{ $transaction->provinsi }} {{ $transaction->kodepos }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Nomor Telepon</p>
                            <p class="font-medium text-gray-900">{{ $transaction->no_telepon }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal</span>
                            <span class="font-medium">{{ $transaction->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Item</span>
                            <span class="font-medium">{{ $transaction->items->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jumlah</span>
                            <span class="font-medium">{{ $transaction->items->sum('quantity') }} produk</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
