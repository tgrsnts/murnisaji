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
            <div class="w-full h-full" style="
                                                            background-image: url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22240%22 height=%2240%22 viewBox=%220 0 240 40%22><path d=%22M0 18 C 30 6, 60 6, 90 18 S 150 30, 180 18 S 210 6, 240 18 L240 40 L0 40 Z%22 fill=%22%23ffffff%22/></svg>');
                                                            background-repeat: repeat-x;
                                                            background-position: bottom;
                                                            background-size: 240px 40px;
                                                        ">
            </div>
        </div>

    </section>
    <section class="bg-white flex items-center justify-between px-20  pb-20">
        <img src="/images/logo/logo abon.png" class="w-250 h-auto object-contain">
        <div class="space-y-8">
            <h2 class="text-5xl text-center font-bold text-[#2B2B2B]">
                Apa Itu Abon <span class="text-[#D4AF5A]">Murnisaji?</span>
            </h2>
            <p>
                MURNISAJI adalah brand pangan yang memproduksi abon protein hewani dalam kemasan sachet,
                dirancang sebagai solusi lauk praktis, siap saji, dan mudah diaplikasikan. Kami menghadirkan abon ayam dan
                abon
                tuna dengan fokus pada kemudahan penyajian,
                konsistensi kualitas, dan daya simpan, sehingga mendukung kebutuhan penyediaan makanan yang efisien. Melalui
                kemasan sachet, MURNISAJI membantu menghadirkan asupan protein yang praktis untuk berbagai kelompok usia,
                baik
                sebagai lauk utama maupun pendamping menu.
            </p>
        </div>

    </section>
    <section class="bg-white flex flex-col items-center px-180 pb-20">
        <div class="space-y-4 text-center">
            <h2 class="text-4xl font-bold text-[#2B2B2B]">
                Pemilik Abon <span class="text-[#D4AF5A]">Murnisaji?</span>
            </h2>
            <p>
                Get to know the friendly faces behind your favorite flavors.
            </p>

            <div class="flex flex-col items-center space-y-4 mt-8">
                <img src="{{ asset('images/profile/user1.png') }}" alt="Profile 1"
                    class="w-40 h-40 md:w-70 md:h-70 rounded-full object-cover shadow-lg">

                <h3 class="text-2xl md:text-4xl font-bold text-[#2B2B2B]">
                    Nama Keluarga
                </h3>

                <p class="text-gray-600">
                    CEO
                </p>

                <!-- Social Media -->
                <div class="flex gap-4 mt-4">
                    <div class="bg-[#7A1F1F] w-10 h-10 flex items-center justify-center rounded-full">
                        <i class="fa-brands fa-facebook-f text-white"></i>
                    </div>
                    <div class="bg-[#7A1F1F] w-10 h-10 flex items-center justify-center rounded-full">
                        <i class="fa-brands fa-instagram text-white"></i>
                    </div>
                    <div class="bg-[#7A1F1F] w-10 h-10 flex items-center justify-center rounded-full">
                        <i class="fa-brands fa-whatsapp text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white px-20 py-20">
        <div class="space-y-8">
        <h2 class="text-4xl text-center font-bold text-[#2B2B2B]">
                Lokasi Abon <span class="text-[#D4AF5A]">Murnisaji?</span>
            </h2>

        <div class="flex justify-center">
            <iframe
                src="https://www.google.com/maps?q=IPB%20Cilibende%20Bogor%2C%20Jawa%20Barat%2C%20ID&output=embed"
                width="100%" height="450" class="rounded-xl shadow-lg" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>
@endsection