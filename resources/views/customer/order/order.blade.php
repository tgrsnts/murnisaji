@extends('web.layouts.app')

@section('content')

<div class="flex bg-[#f5f5f5] min-h-screen">

    {{-- SIDEBAR --}}
    <div class="w-[260px] bg-white shadow-lg rounded-r-2xl p-6 flex flex-col justify-between">

        <div>
            <ul class="space-y-4">

                <li class="flex items-center gap-3 bg-gray-100 p-3 rounded-lg font-semibold text-red-700 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386a1.125 1.125 0 011.094.877l.383 1.53" />
                    </svg>
                    My Order
                </li>

                <li class="flex items-center gap-3 text-gray-500 cursor-pointer">
                    Review
                </li>

                <li class="flex items-center gap-3 text-gray-500 cursor-pointer">
                    Address
                </li>

                <li class="flex items-center gap-3 text-gray-500 cursor-pointer">
                    Profile
                </li>

            </ul>
        </div>

        <div class="mt-20">
            <button class="bg-red-700 text-white px-6 py-2 rounded-lg w-full">
                Logout
            </button>
        </div>

    </div>


    {{-- MAIN CONTENT --}}
    <div class="flex-1 p-10">

        {{-- HEADER TOP --}}
        <div class="bg-white rounded-xl shadow px-6 py-4 flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-red-900">
                My Order
            </h2>

            <div class="font-semibold text-red-900">
                👤 Agus
            </div>
        </div>

        {{-- MAIN CARD --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="p-6 font-semibold">
                My Order
            </div>

            {{-- HEADER TABLE --}}
            <div class="grid grid-cols-[80px_1fr] bg-red-700 text-white text-sm font-semibold px-6 py-3">
                <div>NO</div>
                <div>ORDER</div>
            </div>

            @php
                $orders = [
                    [
                        "produk" => "Abon Sapi",
                        "size" => "75g",
                        "qty" => 10,
                        "price" => "Rp. 45.000",
                        "date" => "1 January 2026",
                        "image" => "menu1.png"
                    ],
                    [
                        "produk" => "Abon Ayam",
                        "size" => "15g",
                        "qty" => 10,
                        "price" => "Rp. 70.000",
                        "date" => "1 January 2025",
                        "image" => "menu2.png"
                    ],
                    [
                        "produk" => "Abon Tuna",
                        "size" => "15g",
                        "qty" => 10,
                        "price" => "Rp. 70.000",
                        "date" => "1 January 2025",
                        "image" => "menu3.png"
                    ]
                ];
            @endphp

            @foreach($orders as $index => $order)

            <div class="grid grid-cols-[80px_1fr] px-6 py-5 border-b">

                {{-- NUMBER --}}
                <div class="flex items-center justify-center text-red-700 font-semibold">
                    {{ $index + 1 }}
                </div>

                {{-- ORDER CARD --}}
                <div class="border border-red-700 rounded-lg overflow-hidden">

                    {{-- STATUS --}}
                    <div class="flex justify-between items-center px-4 py-3 border-b border-red-700">

                        <div class="flex items-center gap-3">
                            <div class="bg-red-700 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold">
                                ✓
                            </div>

                            <div>
                                <p class="font-semibold text-sm">Completed</p>
                                <p class="text-xs text-gray-400">Enjoy your meal</p>
                            </div>
                        </div>

                        <p class="font-semibold text-sm">
                            {{ $order['date'] }}
                        </p>
                    </div>

                    {{-- PRODUCT --}}
                    <div class="flex items-center justify-between px-6 py-4">

                        {{-- LEFT --}}
                        <div class="flex items-center gap-4 w-[300px]">
                            <img src="{{ asset('images/menu/' . $order['image']) }}"
                                class="w-[60px] h-[60px] object-cover rounded">

                            <div>
                                <p class="font-semibold text-sm">
                                    {{ $order['produk'] }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    Size: {{ $order['size'] }}
                                </p>
                            </div>
                        </div>

                        {{-- QTY --}}
                        <div class="w-[80px] text-center text-sm border-l border-r border-gray-300">
                            {{ $order['qty'] }}
                        </div>

                        {{-- PRICE --}}
                        <div class="w-[120px] text-center font-semibold text-sm">
                            {{ $order['price'] }}
                        </div>

                        {{-- BUTTON --}}
                        <div class="w-[150px] flex justify-end">
                            <button
                                class="border border-red-700 text-red-700 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-700 hover:text-white transition">
                                VIEW DETAILS
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            @endforeach

        </div>

    </div>

</div>

@endsection