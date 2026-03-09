@extends('web.layouts.app')

@section('content')
    <!-- Hero -->
    <section class="relative flex items-center justify-between px-20 py-24">
        <div class="w-full">
            <h1 class="text-center text-black text-[40px] font-semibold">
                Menu Abon <span class="text-[#7A1F1F]">Murnisaji</span>
            </h1>
        </div>
        <div class="absolute z-0 -bottom-[1px] left-0 w-full h-10 overflow-hidden">
            <div class="w-full h-full"
                style="
        background-image: url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22240%22 height=%2240%22 viewBox=%220 0 240 40%22><path d=%22M0 18 C 30 6, 60 6, 90 18 S 150 30, 180 18 S 210 6, 240 18 L240 40 L0 40 Z%22 fill=%22%23ffffff%22/></svg>');
        background-repeat: repeat-x;
        background-position: bottom;
        background-size: 240px 40px;
      ">
            </div>
        </div>
    </section>
    <section class="bg-white flex items-center justify-between px-20 py-24">
        <div class="flex flex-col gap-24 w-full">
            @forelse($produk as $index => $item)
                @if($index % 2 == 0)
                    {{-- Product (Even Index - Left to Right) --}}
                    <div class="flex items-center gap-4">
                        <div class="rounded-lg p-4 bg-[#D4AF5A] flex items-center justify-center">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" class="w-full h-full object-cover rounded">
                            @else
                                <img src="/images/menu/menu1.png" class="w-full h-auto object-contain">
                            @endif
                        </div>
                        <div class="flex bg-white border-12 border-l-0 border-[#D4AF5A] rounded-lg rounded-l-none p-6 flex-1">
                            <div class="flex flex-col gap-4 w-full">
                                <h2 class="text-[#7A1F1F] text-2xl font-semibold">{{ $item->nama_produk }}</h2>
                                <div class="flex flex-col gap-2">
                                    <p class="text-gray-700 line-clamp-3">{{ $item->deskripsi }}</p>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-2">
                                            <div class="flex items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= floor($item->average_rating))
                                                        <i class="fas fa-star text-yellow-400"></i>
                                                    @elseif($i - 0.5 <= $item->average_rating)
                                                        <i class="fas fa-star-half-alt text-yellow-400"></i>
                                                    @else
                                                        <i class="far fa-star text-[#D4AF5A]"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="text-gray-700 font-semibold">{{ number_format($item->average_rating, 1) }}</span>
                                            <span class="text-gray-500 text-sm">({{ $item->total_reviews }} reviews)</span>
                                        </div>
                                        <p class="text-[#7A1F1F] text-xl font-bold">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('menu.show', $item->produk_id) }}" class="bg-[#7A1F1F] text-white px-4 py-2 rounded-lg text-center hover:bg-[#5A0F0F] transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Product (Odd Index - Right to Left) --}}
                    <div class="flex flex-row-reverse items-center gap-4">
                        <div class="rounded-lg p-4 bg-[#D4AF5A] flex items-center justify-center">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" class="w-full h-full object-cover rounded">
                            @else
                                <img src="/images/menu/menu2.png" class="w-full h-auto object-contain">
                            @endif
                        </div>
                        <div class="flex bg-white border-12 border-r-0 border-[#D4AF5A] rounded-lg rounded-r-none p-6 flex-1">
                            <div class="flex flex-col gap-4 w-full">
                                <h2 class="text-[#7A1F1F] text-2xl font-semibold">{{ $item->nama_produk }}</h2>
                                <div class="flex flex-col gap-2">
                                    <p class="text-gray-700 line-clamp-3">{{ $item->deskripsi }}</p>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-2">
                                            <div class="flex items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= floor($item->average_rating))
                                                        <i class="fas fa-star text-yellow-400"></i>
                                                    @elseif($i - 0.5 <= $item->average_rating)
                                                        <i class="fas fa-star-half-alt text-yellow-400"></i>
                                                    @else
                                                        <i class="far fa-star text-[#D4AF5A]"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="text-gray-700 font-semibold">{{ number_format($item->average_rating, 1) }}</span>
                                            <span class="text-gray-500 text-sm">({{ $item->total_reviews }} reviews)</span>
                                        </div>
                                        <p class="text-[#7A1F1F] text-xl font-bold">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('menu.show', $item->produk_id) }}" class="bg-[#7A1F1F] text-white px-4 py-2 rounded-lg text-center hover:bg-[#5A0F0F] transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">Belum ada produk tersedia</p>
                </div>
            @endforelse

            @if($produk->hasPages())
                <div class="mt-8 flex justify-center">
                    {{ $produk->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
