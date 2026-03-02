@extends('web.layouts.app')

@section('content')
    <!-- Hero -->
    <section class="relative flex items-center justify-between px-20 py-24">
        <div class="w-full">
            <h1 class="text-center text-black text-[40px] font-semibold">
                Menu Abon <span class="text-[#7A1F1F]">Murnisaji</span>
            </h1>
        </div>
        <div class="absolute -bottom-[1px] left-0 w-full h-10 overflow-hidden">
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
        <div class="flex flex-col gap-8">
            {{-- Product 1 --}}
            <div class="flex items-center">
                <div class="rounded-lg p-4 bg-gray-400">
                    <img src="/images/Abon Sapi.png" class="w-full h-auto object-contain">
                </div>
                <div class="flex bg-white border-12 border-l-0 border-gray-400 rounded-lg rounded-l-none p-4 h-fit">
                    <div class="flex flex-col gap-4">
                        <h2 class="text-[#7A1F1F] text-2xl font-semibold">Abon Sapi</h2>
                        <div class="flex flex-col">
                            <p>Abon Sapi MURNISAJI dibuat dari daging sapi pilihan yang diolah secara higienis untuk
                                menghasilkan tekstur halus, rasa gurih, dan kandungan protein yang terjaga.</p>
                            <div class="flex justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <p class="text-gray-700">4,5/5</p>
                                </div>
                                <p class="text-gray-700">Rp. 150.000/kg</p>
                            </div>
                        </div>
                        <button class="bg-[#7A1F1F] text-white px-4 py-2 rounded-lg">
                            Buy Now
                        </button>
                    </div>
                </div>
            </div>
            {{-- Product 2 --}}
            <div class="flex flex-row-reverse items-center">
                <div class="rounded-lg p-4 bg-gray-400">
                    <img src="/images/Abon Sapi.png" class="w-full h-auto object-contain">
                </div>
                <div class="flex bg-white border-12 border-r-0 border-gray-400 rounded-lg rounded-r-none p-4 h-fit">
                    <div class="flex flex-col gap-4">
                        <h2 class="text-[#7A1F1F] text-2xl font-semibold">Abon Sapi</h2>
                        <div class="flex flex-col">
                            <p>Abon Sapi MURNISAJI dibuat dari daging sapi pilihan yang diolah secara higienis untuk
                                menghasilkan tekstur halus, rasa gurih, dan kandungan protein yang terjaga.</p>
                            <div class="flex justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <p class="text-gray-700">4,5/5</p>
                                </div>
                                <p class="text-gray-700">Rp. 150.000/kg</p>
                            </div>
                        </div>
                        <button class="bg-[#7A1F1F] text-white px-4 py-2 rounded-lg">
                            Buy Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
