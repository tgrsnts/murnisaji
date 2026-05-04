@extends('web.dashboard.layout.main')

@php($title = 'Transaksi')

@section('content')
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
        <h1 class="text-3xl font-bold text-gray-900">Transaksi Saya</h1>
        <p class="text-gray-600 mt-1">Ringkasan aktivitas belanja Anda</p>
    </div>

    @if (session('success'))
        <div class="p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-3xl shadow-sm flex justify-between items-center">
            <div>
                <p class="text-sm text-[#D4AF5A] font-bold uppercase tracking-tighter">Total Transaksi</p>
                <h2 class="text-xl font-black text-gray-800">{{ $totalTransactions }}</h2>
            </div>
            <div class="bg-[#8B0000] p-3 rounded-xl text-white shadow-md">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
        <div class="bg-white p-5 rounded-3xl shadow-sm flex justify-between items-center">
            <div>
                <p class="text-sm text-[#D4AF5A] font-bold uppercase tracking-tighter">Total Belanja</p>
                <h2 class="text-xl font-black text-gray-800">Rp{{ number_format($totalSpent, 0, ',', '.') }}</h2>
            </div>
            <div class="bg-[#8B0000] p-3 rounded-xl text-white shadow-md">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
        <div class="bg-white p-5 rounded-3xl shadow-sm flex justify-between items-center">
            <div>
                <p class="text-sm text-[#D4AF5A] font-bold uppercase tracking-tighter">Pending</p>
                <h2 class="text-xl font-black text-gray-800">{{ $pendingTransactions }}</h2>
            </div>
            <div class="bg-[#8B0000] p-3 rounded-xl text-white shadow-md">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-4 border-b border-gray-200">
            <h2 class="font-bold text-gray-800">Riwayat Transaksi</h2>
        </div>

        <div class="pb-2">
            @if ($transactions->count() > 0)
            @foreach ($transactions as $index => $transaksi)
                <div class="flex justify-between p-4 border-b border-gray-200 items-center">
                    <div class="flex gap-4">
                        <img class="w-16 aspect-square object-cover"
                            src="/storage/{{ $transaksi->firstItem->produk->gambar }}" alt="">
                        <div class="flex-1">
                            {{-- <p class="text-sm text-gray-600">#{{ $transaksi->transaksi_id }}</p> --}}
                            <p class="text-lg font-bold text-gray-800">{{ $transaksi->firstItem->produk->nama_produk }}</p>
                            <p class="text-sm text-gray-500">{{ $transaksi->created_at->format('d/m/Y H:i') }}</p>
                            <p class="text-sm text-red-800 font-semibold">Rp
                                {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <a href="{{ route('dashboard.transaction', ['id' => $transaksi->transaksi_id]) }}"
                        class="bg-red-800 h-fit px-4 rounded-lg text-white text-center py-2 text-sm font-semibold">
                        Periksa Pesanan
                    </a>
                </div>
            @endforeach
        @else
            <div class="text-center py-4 text-gray-500">Belum ada transaksi</div>
        @endif
        </div>
    </div>
@endsection
