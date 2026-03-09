@extends('admin.layout.main')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    @if ($user->gambar)
                        <img src="{{ asset('storage/' . $user->gambar) }}" alt="{{ $user->name }}"
                            class="w-16 h-16 object-cover rounded-full">
                    @else
                        <div
                            class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center text-red-800 font-bold text-2xl">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                        <p class="text-gray-600 text-sm">
                            @if ($user->role == 1)
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">
                                    Admin
                                </span>
                            @else
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                                    Customer
                                </span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.users.edit', $user->user_id) }}"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Edit
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                        class="px-4 py-2 border border-red-800 text-red-800 rounded-lg hover:bg-red-50">
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Informasi Dasar -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-bold text-red-800 mb-4">Informasi Dasar</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <span class="text-gray-600 text-sm">Username:</span>
                    <p class="font-semibold">{{ $user->username }}</p>
                </div>
                <div>
                    <span class="text-gray-600 text-sm">Email:</span>
                    <p class="font-semibold">{{ $user->email }}</p>
                </div>
                <div>
                    <span class="text-gray-600 text-sm">No. Telepon:</span>
                    <p class="font-semibold">{{ $user->telp }}</p>
                </div>
                <div>
                    <span class="text-gray-600 text-sm">Terdaftar Sejak:</span>
                    <p class="font-semibold">{{ $user->created_at->format('d F Y, H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Statistik -->
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Total Alamat</p>
                        <p class="text-3xl font-bold text-red-800">{{ $user->alamats->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <span class="text-2xl">📍</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Total Transaksi</p>
                        <p class="text-3xl font-bold text-red-800">{{ $user->transaksis->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-2xl">🛒</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Total Belanja</p>
                        <p class="text-xl font-bold text-red-800">
                            Rp {{ number_format($user->transaksis->sum('total_bayar'), 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <span class="text-2xl">💰</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Alamat -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-bold text-red-800 mb-4">Daftar Alamat</h3>
            @if ($user->alamats->count() > 0)
                <div class="space-y-3">
                    @foreach ($user->alamats as $alamat)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="font-semibold text-red-800">{{ $alamat->label_alamat }}</span>
                                        @if ($alamat->isPrimary)
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">
                                                Utama
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-800 font-semibold">{{ $alamat->nama_penerima }}</p>
                                    <p class="text-sm text-gray-600">{{ $alamat->no_telepon }}</p>
                                    <p class="text-sm text-gray-600 mt-2">{{ $alamat->alamat_lengkap }}</p>
                                    @if ($alamat->catatan_kurir)
                                        <p class="text-xs text-gray-500 mt-1">Catatan: {{ $alamat->catatan_kurir }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">Belum ada alamat tersimpan</p>
            @endif
        </div>

        <!-- Riwayat Transaksi -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-bold text-red-800 mb-4">Riwayat Transaksi</h3>
            @if ($user->transaksis->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-3 text-left text-xs text-gray-700">ID</th>
                                <th class="py-2 px-3 text-left text-xs text-gray-700">Tanggal</th>
                                <th class="py-2 px-3 text-left text-xs text-gray-700">Total</th>
                                <th class="py-2 px-3 text-left text-xs text-gray-700">Status</th>
                                <th class="py-2 px-3 text-left text-xs text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->transaksis->sortByDesc('created_at')->take(10) as $transaksi)
                                <tr class="border-b">
                                    <td class="py-2 px-3 text-xs font-semibold">#{{ $transaksi->transaksi_id }}</td>
                                    <td class="py-2 px-3 text-xs">{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="py-2 px-3 text-xs font-semibold text-red-800">
                                        Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                                    </td>
                                    <td class="py-2 px-3 text-xs">
                                        @php
                                            $statusColors = [
                                                'PENDING' => 'bg-yellow-100 text-yellow-800',
                                                'PAID' => 'bg-blue-100 text-blue-800',
                                                'PACKED' => 'bg-purple-100 text-purple-800',
                                                'SHIPPED' => 'bg-indigo-100 text-indigo-800',
                                                'DONE' => 'bg-green-100 text-green-800',
                                                'CANCEL' => 'bg-red-100 text-red-800',
                                            ];
                                            $statusColor =
                                                $statusColors[$transaksi->status] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                                            {{ $transaksi->status }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-3 text-xs">
                                        <a href="{{ route('admin.transaksi.show', $transaksi->transaksi_id) }}"
                                            class="text-blue-600 hover:text-blue-800">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($user->transaksis->count() > 10)
                    <p class="text-xs text-gray-500 mt-2">Menampilkan 10 transaksi terakhir dari
                        {{ $user->transaksis->count() }} total transaksi</p>
                @endif
            @else
                <p class="text-gray-500 text-center py-4">Belum ada transaksi</p>
            @endif
        </div>
    </div>
@endsection
