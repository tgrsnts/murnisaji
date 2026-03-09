@extends('admin.layout.main')

@section('content')
    <div class="bg-white rounded-lg shadow-lg">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <h2 class="font-bold text-gray-800">Daftar Transaksi</h2>
        </div>

        @if (session('success'))
            <div class="p-4 text-green-700 bg-green-100 border-b border-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-4 text-red-700 bg-red-100 border-b border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-red-800 text-white text-center">
                        <th class="py-2 px-3 text-xs">NO</th>
                        <th class="py-2 px-3 text-xs">ID TRANSAKSI</th>
                        <th class="py-2 px-3 text-xs">TANGGAL</th>
                        <th class="py-2 px-3 text-xs">PELANGGAN</th>
                        <th class="py-2 px-3 text-xs">TOTAL BAYAR</th>
                        <th class="py-2 px-3 text-xs">STATUS</th>
                        <th class="py-2 px-3 text-xs">KURIR</th>
                        <th class="py-2 px-3 text-xs">RESI</th>
                        <th class="py-2 px-3 text-xs">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $index => $transaksi)
                        <tr class="border-b border-gray-200 text-center hover:bg-gray-50 transition-colors">
                            <td class="py-2 px-3 text-xs">
                                {{ $transaksis->firstItem() + $index }}
                            </td>

                            <td class="py-2 px-3 text-xs text-red-800 font-semibold">
                                #{{ $transaksi->transaksi_id }}
                            </td>

                            <td class="py-2 px-3 text-xs text-gray-600">
                                {{ $transaksi->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="py-2 px-3 text-xs text-gray-800">
                                {{ $transaksi->alamat->user->name ?? 'N/A' }}
                            </td>

                            <td class="py-2 px-3 text-xs text-red-800 font-semibold">
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
                                    $statusColor = $statusColors[$transaksi->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                                    {{ $transaksi->status }}
                                </span>
                            </td>

                            <td class="py-2 px-3 text-xs text-gray-600">
                                {{ $transaksi->kurir }} - {{ $transaksi->layanan_kurir }}
                            </td>

                            <td class="py-2 px-3 text-xs text-gray-600">
                                {{ $transaksi->resi ?? '-' }}
                            </td>

                            <td class="py-2 px-3">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.transaksi.show', $transaksi->transaksi_id) }}"
                                        class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs" title="Lihat detail">
                                        Detail
                                    </a>

                                    <form action="{{ route('admin.transaksi.destroy', $transaksi->transaksi_id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs"
                                            title="Hapus transaksi">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">
                                Belum ada transaksi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($transaksis->hasPages())
            <div class="p-4 border-t border-gray-200">
                {{ $transaksis->links() }}
            </div>
        @endif
    </div>
@endsection
