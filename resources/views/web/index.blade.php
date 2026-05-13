@extends('web.layouts.app')

@section('content')
    <!-- Hero -->
    <section class="relative bg-[#FCFBF5] flex flex-col-reverse md:flex-row items-center justify-between px-4 md:px-20 pb-20">
        <div class="max-w-2xl">
            <div class="flex items-center w-full my-2 md:my-6">
                <div class="h-px bg-[#D4AF5A] flex-1 w-full md:max-w-[30px]"></div>
                <span class="px-4 text-[#7A1F1F] text-sm md:text-lg font-semibold">Abon Murnisaji</span>
                <div class="h-px bg-[#D4AF5A] flex-1 w-full md:max-w-[30px]"></div>
            </div>
            <h1 class="text-xl md:text-[40px] font-bold leading-snug" style="font-family: 'Libre Baskerville', serif;">
                <span class="text-[#D4AF5A]">Solusi</span>
                <span class="text-[#7A1F1F]">Praktis Cukupi Protein Setiap Hari</span>
            </h1>
            <p class="mt-2 md:mt-6 text-[#6B645C] text-md md:text-lg">
                Abon Sapi, Ayam, dan Tuna tanpa MSG,
                tanpa pengawet, siap tabur kapan saja.
            </p>

            <div class="mt-8 flex justify-center md:justify-start gap-4">
                <x-button tone="primary" variant="full">
                    Buy Now
                </x-button>

                <x-button tone="secondary" variant="full">
                    See Product
                </x-button>
            </div>
        </div>

        <div class="w-full max-w-[300px] md:max-w-[600px] mx-auto">
            <img src="{{ asset('images/logo/logo abon.png') }}" class="w-full h-auto object-contain">
        </div>
    </section>

    <!-- Kenapa Pilih -->
    <section class="bg-white py-24 px-4 md:px-20 text-center">

        <h2 class="text-xl md:text-3xl font-bold text-[#2B2B2B]">
            Kenapa Pilih Abon <span class="text-[#D4AF5A]">Murnisaji?</span>
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 mt-8 md:mt-16">

            <div class="bg-[#FCFBF5] rounded-xl p-8 shadow-sm">
                <img src="{{ asset('images/icon/icon1.png') }}" class="w-16 mx-auto">
                <p class="mt-6 font-semibold text-lg">Tanpa MSG</p>
            </div>

            <div class="bg-[#FCFBF5] rounded-xl p-8 shadow-sm">
                <img src="{{ asset('images/icon/icon2.png') }}" class="mx-auto w-16">
                <p class="mt-6 font-semibold text-lg">Tanpa Pengawet</p>
            </div>

            <div class="bg-[#FCFBF5] rounded-xl p-8 shadow-sm">
                <img src="{{ asset('images/icon/icon3.png') }}" class="mx-auto w-16">
                <p class="mt-6 font-semibold text-lg">Full Protein</p>
            </div>

            <div class="bg-[#FCFBF5] rounded-xl p-8 shadow-sm">
                <img src="{{ asset('images/icon/icon4.png') }}" class="mx-auto w-16">
                <p class="mt-6 font-semibold text-lg">Praktis & Siap Tabur</p>
            </div>

        </div>
    </section>

    <!-- Menu Produk -->
    <section class="bg-[#FCFBF5] py-24 px-4 md:px-20 text-center">

        <h2 class="text-xl md:text-3xl font-bold text-[#2B2B2B]">
            Pilihan Menu Abon <span class="text-[#D4AF5A]">Murnisaji</span>
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-24 md:gap-x-16 md:gap-y-36 mt-40">

            @foreach ($produk as $item)
                <div class="bg-[#D4AF5A] flex flex-col p-2 md:p-6 pt-28 rounded-xl shadow relative">
                    <img src="{{ asset('/storage/' . $item->gambar) }}"
                        class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[260px]">
                    <h3 class="mt-2 md:mt-6 text-[#ffffff] font-semibold">{{ $item->nama_produk }}</h3>
                    <p class="text-sm text-gray-700 mt-2">
                        {{ $item->deskripsi }}
                    </p>

                    <div class="flex justify-between mt-4">
                        <span>⭐ {{ $item->getAverageRatingAttribute() }}/5</span>
                        <span class="text-[#ffffff] font-semibold">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('menu.show', $item->produk_id) }}"
                        class="mt-4 bg-[#ffffff] w-full py-2 px-4 rounded-lg hover:bg-gray-200 transition hover:cursor-pointer">
                        Lihat Detail
                    </a>
                </div>
            @endforeach
        </div>

    </section>

    <!-- Testimoni -->
    <section class="bg-white py-24 px-4 md:px-20 text-center">

        <h2 class="text-xl md:text-3xl font-bold text-[#2B2B2B]">
            Pendapat Mereka Tentang Abon <span class="text-[#D4AF5A]">Murnisaji</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-16">

            <div class="bg-[#FCFBF5] p-8 rounded-xl text-left">
                <p class="text-gray-600 text-sm">
                    Kalau lagi buru-buru pagi hari, Abon Murnisaji jadi solusi cepat.
                    Tinggal tambahkan ke nasi atau roti.
                </p>

                <div class="flex items-center gap-3 mt-6">
                    <img src="{{ asset('images/profile/user1.png') }}" class="w-12 h-12 rounded-full">
                    <div>
                        <p class="font-semibold">Ciput</p>
                        <p class="text-xs text-[#D4AF5A]">Happy Client</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#FCFBF5] p-8 rounded-xl text-left">
                <p class="text-gray-600 text-sm">
                    Rasanya gurih, teksturnya halus, dan yang paling penting tanpa MSG.
                </p>

                <div class="flex items-center gap-3 mt-6">
                    <img src="{{ asset('images/profile/user2.png') }}" class="w-12 h-12 rounded-full">
                    <div>
                        <p class="font-semibold">Asep</p>
                        <p class="text-xs text-[#D4AF5A]">Happy Client</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#FCFBF5] p-8 rounded-xl text-left">
                <p class="text-gray-600 text-sm">
                    Praktis banget untuk anak kos. Tidak perlu masak ribet.
                </p>

                <div class="flex items-center gap-3 mt-6">
                    <img src="{{ asset('images/profile/user3.png') }}" class="w-12 h-12 rounded-full">
                    <div>
                        <p class="font-semibold">Maman</p>
                        <p class="text-xs text-[#D4AF5A]">Happy Client</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
