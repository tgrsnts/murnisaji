@extends('web.layouts.app')

@section('content')
    <!-- Hero -->
    <section class="flex items-center justify-between px-20 py-24">
        <div class="max-w-2xl">
            <div class="flex items-center w-full my-6">
                <div class="h-px bg-[#D4AF5A] flex-1 max-w-[30px]"></div>
                <span class="px-4 text-[#7A1F1F] text-lg font-semibold">Abon Murnisaji</span>
                <div class="h-px bg-[#D4AF5A] flex-1 max-w-[30px]"></div>
            </div>
            <h1 class="text-[40px] font-bold leading-snug"style="font-family: 'Libre Baskerville', serif;">
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

                <button class="border border-[#7A1F1F] text-[#7A1F1F] px-8 py-3 rounded-full">
                    See Product
                </button>
            </div>

        </div>

        <div class="w-full max-w-[300px] md:max-w-[600px] mx-auto">
            <img src="/images/logo abon.png" class="w-full h-auto object-contain">
        </div>
    </section>
@endsection
