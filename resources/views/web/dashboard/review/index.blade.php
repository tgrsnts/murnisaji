@extends('web.dashboard.layout.main')

@php($title = 'Ulasan')

@section('content')
    <div class="space-y-2 md:space-y-6">
        <div class="bg-white rounded-xl md:rounded-3xl shadow-xl border border-gray-100 p-4 md:p-6">
            <h1 class="text-lg md:text-3xl font-bold text-gray-900">Ulasan Saya</h1>
            <p class="text-gray-600 mt-1">Daftar ulasan dari transaksi Anda</p>
        </div>

        <div class="bg-white rounded-xl md:rounded-3xl shadow-sm border border-gray-200 p-4 md:p-6">
            @if ($data->count())
                <div class="space-y-4">
                    @foreach ($data as $item)
                        <div class="border border-gray-200 rounded-xl p-4">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex gap-4">
                                    <img src="/storage/{{ $item->produk->gambar }}"
                                        class="w-16 aspect-square object-cover rounded-md" alt="">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $item->produk->nama_produk ?? 'Produk' }}
                                        </p>
                                        <p class="text-sm text-gray-500">Transaksi
                                            #{{ $item->transaksi->transaksi_id ?? '-' }}</p>
                                    </div>
                                </div>
                                @if ($item->israted == 1)
                                    <div class="flex items-center space-x-1 text-lg">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span
                                                class="{{ $i <= $item->rating->rating ? 'text-yellow-400' : 'text-gray-300' }}">
                                                ★
                                            </span>
                                        @endfor
                                    </div>
                                @else
                                    <div class="flex flex-col gap-2 items-end">
                                        <span class="text-sm font-semibold text-gray-500">Belum dinilai</span>
                                        <a href="{{ route('dashboard.reviews.create', ['id' => $item->transaksi_item_id]) }}"
                                            class="text-sm text-white bg-[#7A1F1F] hover:bg-[#5a1818] py-2 px-4 rounded-lg">
                                            Beri Ulasan
                                        </a>
                                    </div>
                                @endif
                            </div>
                            @if ($item->israted == 1)
                                <div class="mt-4 flex flex-col gap-2">
                                    <p>Ulasan Anda:</p>
                                    <div>
                                        <img src="/storage/{{ $item->rating->gambar }}" alt="Gambar Ulasan"
                                            class="w-8 aspect-square object-cover rounded-md">
                                        <p class="text-sm text-gray-700 mt-3">{{ $item->rating->comment }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">Belum ada review.</p>
            @endif
        </div>
    </div>
@endsection
