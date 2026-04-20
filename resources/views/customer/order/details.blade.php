@extends('customer.layouts.app')

@section('content')

    <div class="mb-6 flex pt-6 px-6">

        <div class="w-full flex gap-6">

            {{-- SIDEBAR --}}
            <div class="w-[260px] relative z-20 bg-white rounded-[30px] shadow-xl p-6 flex flex-col h-[95vh]">

                {{-- LOGO --}}
                <div class="mb-6 flex justify-center">
                    <img src="{{ asset('images/logo/Murnisaji Logo Red 2.png') }}" class="h-12 object-contain">
                </div>

                <div>
                    <ul class="space-y-4">

                        {{-- MY ORDER --}}
                        <a href="{{ route('customer.order') }}"
                            class="flex items-center gap-3 p-3 pl-4 rounded-lg font-semibold relative
                {{ request()->routeIs('customer.order*') ? 'text-[#7A1F1F] bg-gray-50 shadow' : 'text-gray-500 hover:bg-gray-100' }}">

                            {{-- GARIS MERAH --}}
                            @if(request()->routeIs('customer.order*'))
                                <span class="absolute left-0 top-0 h-full w-2 bg-[#7A1F1F] rounded-r"></span>
                            @endif

                            My Order
                        </a>
                        {{-- REVIEW --}}
                        <a href="{{ route('customer.review') }}"
                            class="flex items-center gap-3 p-3 rounded-lg font-semibold transition
                                                        {{ request()->routeIs('customer.review') ? 'bg-[#7A1F1F] text-white shadow-lg scale-[1.02]' : 'text-gray-500 hover:bg-gray-100' }}">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.32.988l-4.2 3.6a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.73-2.885a.563.563 0 00-.586 0l-4.73 2.885a.562.562 0 01-.84-.61l1.285-5.385a.563.563 0 00-.182-.557l-4.2-3.6a.562.562 0 01.32-.988l5.518-.442a.563.563 0 00.475-.345l2.125-5.111z" />
                            </svg>

                            Review
                        </a>

                        {{-- ADDRESS --}}
                        <a href="{{ route('customer.address') }}"
                            class="flex items-center gap-3 p-3 rounded-lg font-semibold transition
                                                        {{ request()->routeIs('customer.address') ? 'bg-[#7A1F1F] text-white shadow-lg scale-[1.02]' : 'text-gray-500 hover:bg-gray-100' }}">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V4.618a1 1 0 011.553-.832L9 6m0 14l6-3m-6 3V6m6 11l5.447 2.724A1 1 0 0021 16.382V4.618a1 1 0 00-1.553-.832L15 6m0 11V6m0 0L9 6" />
                            </svg>

                            Address
                        </a>

                        {{-- PROFILE --}}
                        <a href="{{ route('customer.profile') }}"
                            class="flex items-center gap-3 p-3 rounded-lg font-semibold transition
                                                        {{ request()->routeIs('customer.profile') ? 'bg-[#7A1F1F] text-white shadow-lg scale-[1.02]' : 'text-gray-500 hover:bg-gray-100' }}">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>

                            Profile
                        </a>

                    </ul>
                </div>


                {{-- LOGOUT --}}
                <div class="mt-auto">
                    <a href="{{ route('home') }}"
                        class="bg-[#7A1F1F] text-white px-6 py-2 rounded-lg w-full text-center block hover:opacity-90 transition">
                        Logout
                    </a>
                </div>

            </div>


            {{-- MAIN --}}
            <div class="flex-1">

                {{-- HEADER --}}
                <div class="bg-white rounded-xl shadow px-6 py-4 flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-[#7A1F1F]">My Order</h2>
                    <div class="font-semibold text-[#7A1F1F]">👤 Agus</div>
                </div>


                {{-- CONTENT BOX --}}
                <div class="bg-white rounded-xl shadow p-6">

                    <h3 class="font-semibold mb-12">My Order</h3>

                    {{-- TOP BAR --}}
                    <div class="flex justify-between items-center mb-6">

                        <a href="{{ route('customer.order') }}"
                            class="bg-[#7A1F1F] text-white px-5 py-2 rounded-lg text-sm font-semibold">
                            ← Back
                        </a>

                        <div class="border border-[#7A1F1F] rounded-full px-5 py-2 flex items-center gap-3">
                            <span class="font-semibold text-sm">Order Status</span>
                            <span class="bg-green-500 text-white text-xs px-3 py-1 rounded-full">
                                DELIVERED
                            </span>
                        </div>
                    </div>


                    <div class="flex gap-6">

                        {{-- LEFT TRACKING --}}
                        <div class="w-[320px] border border-[#7A1F1F] rounded-xl p-4">

                            <p class="font-semibold mb-3">Tracking Order</p>

                            <div class="w-full h-[200px] bg-gray-200 rounded-lg flex items-center justify-center">
                                <span class="text-gray-500 text-sm">Maps here</span>
                            </div>

                            <div class="mt-4 border border-[#7A1F1F] rounded-lg p-3 flex items-center gap-3">
                                <img src="{{ asset('images/menu/jne.png') }}" class="w-10">
                            </div>

                            <div class="flex gap-2 mt-3">
                                <div class="border border-[#7A1F1F] rounded-lg px-3 py-2 text-xs w-full">
                                    <p class="text-gray-400">Phone Number</p>
                                    <p class="font-semibold">0812 1234 1234</p>
                                </div>

                                <div class="border border-[#7A1F1F] rounded-lg px-3 py-2 text-xs w-full">
                                    <p class="text-gray-400">Delivery Time</p>
                                    <p class="font-semibold">12:00</p>
                                </div>
                            </div>

                        </div>


                        {{-- RIGHT DETAILS --}}
                        <div class="flex-1 border border-[#7A1F1F] rounded-xl p-5">

                            <p class="font-semibold mb-4">Details</p>

                            {{-- INFO --}}
                            <div class="text-sm space-y-2 mb-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Order id</span>
                                    <span class="font-semibold">#123123</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-gray-500">Date</span>
                                    <span class="font-semibold">1 January 2026, 12.00</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-gray-500">Item</span>
                                    <span class="font-semibold">1</span>
                                </div>
                            </div>

                            <hr class="my-4 border-gray-300">

                            {{-- PRODUCT --}}
                            <div class="flex items-center justify-between mb-4">

                                <div class="flex items-center gap-4">
                                    <img src="{{ asset('images/menu/menu1.png') }}"
                                        class="w-[60px] h-[60px] rounded object-cover">

                                    <div>
                                        <p class="font-semibold text-sm">Abon Sapi</p>
                                        <p class="text-xs text-gray-500">Size: 75g</p>
                                    </div>
                                </div>

                                <div class="text-sm">10</div>

                                <div class="text-sm font-semibold">Rp. 45.000</div>
                            </div>

                            <hr class="my-4 border-gray-300">

                            {{-- PAYMENT --}}
                            <div class="text-sm space-y-2">

                                <div class="flex justify-between">
                                    <span class="text-gray-500">Subtotal</span>
                                    <span class="font-semibold">Rp. 35.000</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-gray-500">Delivery Fee</span>
                                    <span class="font-semibold">Rp. 10.000</span>
                                </div>

                                <div class="flex justify-between font-semibold">
                                    <span>Total</span>
                                    <span class="font-bold">Rp. 45.000</span>
                                </div>
                            </div>

                            <button class="mt-6 w-full bg-[#7A1F1F] text-white py-3 rounded-lg font-semibold">
                                REORDER
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection