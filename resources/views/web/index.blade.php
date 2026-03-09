@extends('web.layouts.app')

@section('content')

    <!-- Hero -->
    <section class="bg-white flex items-center justify-between px-20  pb-20">
        <div class="max-w-2xl">
            <div class="flex items-center w-full my-6">
                <div class="h-px bg-[#D4AF5A] flex-1 max-w-[30px]"></div>
                <span class="px-4 text-[#7A1F1F] text-lg font-semibold">Abon Murnisaji</span>
                <div class="h-px bg-[#D4AF5A] flex-1 max-w-[30px]"></div>
            </div>
            <h1 class="text-[40px] font-bold leading-snug" style="font-family: 'Libre Baskerville', serif;">
                <span class="text-[#D4AF5A]">Solusi</span>
                <span class="text-[#7A1F1F]">Praktis Cukupi Protein Setiap Hari</span>
            </h1>
            <p class="mt-6 text-[#6B645C] text-lg">
                Abon Sapi, Ayam, dan Tuna tanpa MSG,
                tanpa pengawet, siap tabur kapan saja.
            </p>

            <div class="mt-8 flex gap-4">
                <button class="bg-[#7A1F1F] text-white px-8 py-3 rounded-full">
                    Buy Now
                </button>

                <button class="border-2 border-[#7A1F1F] text-[#7A1F1F] px-8 py-3 rounded-full 
                    hover:bg-[#7A1F1F] hover:text-white transition duration-300">
                    See Product
                </button>
            </div>

        </div>

        <div class="w-full max-w-[300px] md:max-w-[600px] mx-auto">
            <img src="{{ asset('images/logo/logo abon.png') }}" class="w-full h-auto object-contain">
        </div>
        <div class="absolute z-0 -bottom-[1px] left-0 w-full h-10 overflow-hidden">
            <div class="w-full h-full" style="
                                                            background-image: url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22240%22 height=%2240%22 viewBox=%220 0 240 40%22><path d=%22M0 18 C 30 6, 60 6, 90 18 S 150 30, 180 18 S 210 6, 240 18 L240 40 L0 40 Z%22 fill=%22%23ffffff%22/></svg>');
                                                            background-repeat: repeat-x;
                                                            background-position: bottom;
                                                            background-size: 240px 40px;
                                                          ">
            </div>
        </div>
    </section>

    <!-- Kenapa Pilih -->
    <section class="bg-white py-24 px-20 text-center">

        <h2 class="text-3xl font-bold text-[#2B2B2B]">
            Kenapa Pilih Abon <span class="text-gray-300">Murnisaji?</span>
        </h2>

        <div class="grid md:grid-cols-4 gap-8 mt-16">

            <div class="bg-[#F6F1EA] rounded-xl p-8 shadow-sm">
                <img src="{{ asset('images/icon/icon1.png') }}" class="w-16 mx-auto">
                <p class="mt-6 font-semibold text-lg">Tanpa MSG</p>
            </div>

            <div class="bg-[#F6F1EA] rounded-xl p-8 shadow-sm">
                <img src="{{ asset('images/icon/icon2.png') }}" class="mx-auto w-16">
                <p class="mt-6 font-semibold text-lg">Tanpa Pengawet</p>
            </div>

            <div class="bg-[#F6F1EA] rounded-xl p-8 shadow-sm">
                <img src="{{ asset('images/icon/icon3.png') }}" class="mx-auto w-16">
                <p class="mt-6 font-semibold text-lg">Full Protein</p>
            </div>

            <div class="bg-[#F6F1EA] rounded-xl p-8 shadow-sm">
                <img src="{{ asset('images/icon/icon4.png') }}" class="mx-auto w-16">
                <p class="mt-6 font-semibold text-lg">Praktis & Siap Tabur</p>
            </div>

        </div>
    </section>

    <!-- Menu Produk -->
    <section class="bg-[#F7F4EF] py-24 px-20 text-center">

        <h2 class="text-3xl font-bold text-[#2B2B2B]">
            Pilihan Menu Abon <span class="text-gray-300">Murnisaji</span>
        </h2>

        <div class="grid md:grid-cols-3 gap-12 mt-40">

            <div class="bg-[#DDDDDD] p-6 pt-28 rounded-xl shadow relative">
                <img src="{{ asset('images/menu/menu1.png') }}"
                    class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[260px]">
                <h3 class="mt-6 text-[#ffffff] font-semibold">Abon Ayam</h3>
                <p class="text-sm text-gray-700 mt-2">
                    Abon yang dibuat dari daging ayam pilihan
                </p>

                <div class="flex justify-between mt-4">
                    <span>⭐ 4.9/5</span>
                    <span class="text-[#ffffff] font-semibold">Rp 6.000</span>
                </div>

                <button class="mt-4 bg-[#ffffff] w-full py-2 rounded-lg">
                    Buy Now
                </button>
            </div>

            <div class="bg-[#DDDDDD] p-6 pt-28 rounded-xl shadow relative">
                <img src="{{ asset('images/menu/menu2.png') }}"
                    class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[260px]">
                <h3 class="mt-6 text-[#ffffff] font-semibold">Abon Sapi</h3>
                <p class="text-sm text-gray-700 mt-2">
                    Abon yang dibuat dari daging sapi pilihan
                </p>

                <div class="flex justify-between mt-4">
                    <span>⭐ 4.9/5</span>
                    <span class="text-[#ffffff] font-semibold">Rp 6.000</span>
                </div>

                <button class="mt-4 bg-[#ffffff] w-full py-2 rounded-lg">
                    Buy Now
                </button>
            </div>

            <div class="bg-[#DDDDDD] p-6 pt-28 rounded-xl shadow relative">
                <img src="{{ asset('images/menu/menu3.png') }}"
                    class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[260px]">
                <h3 class="mt-6 text-[#ffffff] font-semibold">Abon Tuna</h3>
                <p class="text-sm text-gray-700 mt-2">
                    Abon yang dibuat dari daging tuna pilihan
                </p>

                <div class="flex justify-between mt-4">
                    <span>⭐ 4.9/5</span>
                    <span class="text-[#ffffff] font-semibold">Rp 6.000</span>
                </div>

                <button class="mt-4 bg-[#ffffff] w-full py-2 rounded-lg">
                    Buy Now
                </button>
            </div>

        </div>

    </section>

    <!-- Testimoni -->
    <section class="bg-white py-24 px-20 text-center">

        <h2 class="text-3xl font-bold text-[#2B2B2B]">
            Pendapat Mereka Tentang Abon <span class="text-gray-300">Murnisaji</span>
        </h2>

        <div class="grid md:grid-cols-3 gap-10 mt-16">

            <div class="bg-[#F7F4EF] p-8 rounded-xl text-left">
                <p class="text-gray-600 text-sm">
                    Kalau lagi buru-buru pagi hari, Abon Murnisaji jadi solusi cepat.
                    Tinggal tambahkan ke nasi atau roti.
                </p>

                <div class="flex items-center gap-3 mt-6">
                    <img src="{{ asset('images/profile/user1.png') }}" class="w-12 h-12 rounded-full">
                    <div>
                        <p class="font-semibold">Ciput</p>
                        <p class="text-xs text-gray-400">Happy Client</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#F7F4EF] p-8 rounded-xl text-left">
                <p class="text-gray-600 text-sm">
                    Rasanya gurih, teksturnya halus, dan yang paling penting tanpa MSG.
                </p>

                <div class="flex items-center gap-3 mt-6">
                    <img src="{{ asset('images/profile/user2.png') }}" class="w-12 h-12 rounded-full">
                    <div>
                        <p class="font-semibold">Asep</p>
                        <p class="text-xs text-gray-400">Happy Client</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#F7F4EF] p-8 rounded-xl text-left">
                <p class="text-gray-600 text-sm">
                    Praktis banget untuk anak kos. Tidak perlu masak ribet.
                </p>

                <div class="flex items-center gap-3 mt-6">
                    <img src="{{ asset('images/profile/user3.png') }}" class="w-12 h-12 rounded-full">
                    <div>
                        <p class="font-semibold">Maman</p>
                        <p class="text-xs text-gray-400">Happy Client</p>
                    </div>
                </div>
            </div>

        </div>
    </section>



@endsection