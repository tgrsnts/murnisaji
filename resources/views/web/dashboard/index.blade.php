@extends('web.dashboard.layout.main')

@php($title = 'Transaksi')

@section('content')
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
            <h1 class="text-2xl font-bold text-gray-900">Transaksi Saya</h1>
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

            @if ($transactions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-red-800 text-white text-center">
                                <th class="py-2 px-3 text-xs">NO</th>
                                <th class="py-2 px-3 text-xs">ID TRANSAKSI</th>
                                <th class="py-2 px-3 text-xs">TANGGAL</th>
                                <th class="py-2 px-3 text-xs">TOTAL BAYAR</th>
                                <th class="py-2 px-3 text-xs">STATUS</th>
                                <th class="py-2 px-3 text-xs">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $index => $transaksi)
                                <tr class="border-b border-gray-200 text-center hover:bg-gray-50 transition-colors">
                                    <td class="py-2 px-3 text-xs">{{ $transactions->firstItem() + $index }}</td>
                                    <td class="py-2 px-3 text-xs text-red-800 font-semibold">#{{ $transaksi->transaksi_id }}</td>
                                    <td class="py-2 px-3 text-xs text-gray-600">{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="py-2 px-3 text-xs text-red-800 font-semibold">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                                    <td class="py-2 px-3 text-xs">
                                        @switch($transaksi->status)
                                            @case('PENDING')
                                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">{{ $transaksi->status }}</span>
                                                @break
                                            @case('PAID')
                                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">{{ $transaksi->status }}</span>
                                                @break
                                            @case('PROCESS')
                                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">{{ $transaksi->status }}</span>
                                                @break
                                            @case('SHIPPED')
                                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800">{{ $transaksi->status }}</span>
                                                @break
                                            @case('COMPLETED')
                                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">{{ $transaksi->status }}</span>
                                                @break
                                            @case('CANCEL')
                                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">{{ $transaksi->status }}</span>
                                                @break
                                            @default
                                                <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">{{ $transaksi->status }}</span>
                                        @endswitch
                                    </td>
                                    <td class="py-2 px-3 text-xs">
                                        <a href="{{ route('dashboard.transaction', ['id' => $transaksi->transaksi_id]) }}" class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-200">
                    {{ $transactions->links() }}
                </div>
            @else
                <div class="text-center py-4 text-gray-500">Belum ada transaksi</div>
            @endif
        </div>
@endsection
