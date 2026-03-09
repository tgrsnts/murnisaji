@extends('admin.layout.main')

@section('content')
    <div class="bg-white rounded-lg shadow-lg">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <h2 class="font-bold text-gray-800">Daftar Review & Rating</h2>
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
                        <th class="py-2 px-3 text-xs">PRODUK</th>
                        <th class="py-2 px-3 text-xs">PELANGGAN</th>
                        <th class="py-2 px-3 text-xs">RATING</th>
                        <th class="py-2 px-3 text-xs">KOMENTAR</th>
                        <th class="py-2 px-3 text-xs">TANGGAL</th>
                        <th class="py-2 px-3 text-xs">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ratings as $index => $rating)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                            <td class="py-2 px-3 text-xs text-center">
                                {{ $ratings->firstItem() + $index }}
                            </td>

                            <td class="py-2 px-3 text-xs">
                                <div class="flex items-center gap-2">
                                    @if ($rating->transaksiItem->produk->gambar)
                                        <img src="{{ asset('storage/' . $rating->transaksiItem->produk->gambar) }}"
                                            alt="{{ $rating->transaksiItem->produk->nama_produk }}"
                                            class="w-10 h-10 object-cover rounded">
                                    @else
                                        <div class="w-10 h-10 bg-gray-200 rounded flex items-center justify-center">
                                            <span class="text-xs text-gray-500">No Img</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-red-800">
                                            {{ $rating->transaksiItem->produk->nama_produk }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $rating->transaksiItem->produk->kategori }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="py-2 px-3 text-xs text-gray-800">
                                {{ $rating->transaksiItem->transaksi->alamat->user->name ?? 'N/A' }}
                            </td>

                            <td class="py-2 px-3 text-xs text-center">
                                <div class="flex justify-center items-center gap-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating->rating)
                                            <span class="text-yellow-500">★</span>
                                        @else
                                            <span class="text-gray-300">★</span>
                                        @endif
                                    @endfor
                                    <span class="ml-1 font-semibold text-red-800">{{ $rating->rating }}/5</span>
                                </div>
                            </td>

                            <td class="py-2 px-3 text-xs text-gray-600">
                                <div class="max-w-xs">
                                    {{ \Illuminate\Support\Str::limit($rating->comment ?? '-', 50) }}
                                </div>
                            </td>

                            <td class="py-2 px-3 text-xs text-gray-600 text-center">
                                {{ $rating->created_at->format('d/m/Y') }}
                            </td>

                            <td class="py-2 px-3">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.review.show', $rating->rating_id) }}"
                                        class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs"
                                        title="Lihat detail">
                                        Detail
                                    </a>

                                    <form action="{{ route('admin.review.destroy', $rating->rating_id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus review ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs"
                                            title="Hapus review">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">
                                Belum ada review
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($ratings->hasPages())
            <div class="p-4 border-t border-gray-200">
                {{ $ratings->links() }}
            </div>
        @endif
    </div>
@endsection
