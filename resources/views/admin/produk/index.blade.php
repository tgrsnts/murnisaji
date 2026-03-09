@extends('admin.layout.main')

@section('content')
    <div class="bg-white rounded-lg shadow-lg">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <h2 class="font-bold text-gray-800">Daftar Produk</h2>
            <a href="{{ route('admin.produk.create') }}"
                class="flex items-center bg-red-800 text-white px-3 py-1 rounded-lg text-sm">
                <span class="mr-1">+</span>
                <span>Tambah Produk</span>
            </a>
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
                        <th class="py-2 px-3 text-xs">NAMA</th>
                        <th class="py-2 px-3 text-xs">KATEGORI</th>
                        <th class="py-2 px-3 text-xs">DESKRIPSI</th>
                        <th class="py-2 px-3 text-xs">HARGA</th>
                        <th class="py-2 px-3 text-xs">STOK</th>
                        <th class="py-2 px-3 text-xs">BERAT (g)</th>
                        <th class="py-2 px-3 text-xs">FOTO</th>
                        <th class="py-2 px-3 text-xs">EDIT</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                        <tr class="border-b border-gray-200 text-center hover:bg-gray-50 transition-colors">
                            <td class="py-2 px-3 text-xs">
                                {{ $index + 1 }}
                            </td>

                            <td class="py-2 px-3 text-xs text-red-800">
                                {{ $item->nama_produk }}
                            </td>

                            <td class="py-2 px-3 text-xs text-red-800">
                                {{ $item->kategori }}
                            </td>

                            <td class="py-2 px-3 text-xs text-left text-red-800">
                                {{ \Illuminate\Support\Str::limit($item->deskripsi ?? 'No description', 50) }}
                            </td>

                            <td class="py-2 px-3 text-xs text-red-800">
                                Rp. {{ number_format($item->harga ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="py-2 px-3 text-xs text-red-800">
                                {{ $item->stok }}
                            </td>

                            <td class="py-2 px-3 text-xs text-red-800">
                                {{ $item->berat_gram }} g
                            </td>

                            <td class="py-2 px-3">
                                <div class="flex justify-center">
                                    <div class="relative h-12 w-12 rounded-full overflow-hidden">
                                        @if ($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                                alt="{{ $item->nama_produk }}" class="h-full w-full object-cover"
                                                onerror="this.onerror=null;this.src='https://via.placeholder.com/80?text=No+Image';">
                                        @else
                                            <div
                                                class="h-full w-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs">
                                                Tidak ada foto
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td class="py-2 px-3">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.produk.edit', $item->produk_id) }}"
                                        class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs" title="Edit produk">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.produk.destroy', $item->produk_id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs"
                                            title="Hapus produk">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                No menu items found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
