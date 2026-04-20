@extends('customer.layouts.app')

@section('content')

    <div class="mb-6 flex justify-center pt-6 px-6">

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

                        {{-- ICON --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 {{ request()->routeIs('customer.order*') ? 'text-[#7A1F1F]' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 100 6 3 3 0 000-6zm9 0a3 3 0 100 6 3 3 0 000-6zM7.5 14.25h9m-9 0L5.106 5.272M16.5 14.25l1.394-6.272a1.125 1.125 0 00-1.097-1.228H6.328" />
                        </svg>

                        My Order
                    </a>

                    {{-- REVIEW --}}
                    <a href="{{ route('customer.review') }}"
                        class="flex items-center gap-3 p-3 pl-4 rounded-lg font-semibold relative
                                    {{ request()->routeIs('customer.review*') ? 'text-[#7A1F1F] bg-gray-50 shadow' : 'text-gray-500 hover:bg-gray-100' }}">

                        {{-- GARIS MERAH --}}
                        @if(request()->routeIs('customer.review*'))
                            <span class="absolute left-0 top-0 h-full w-2 bg-[#7A1F1F] rounded-r"></span>
                        @endif

                        {{-- ICON --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 {{ request()->routeIs('customer.review*') ? 'text-[#7A1F1F]' : '' }}">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.32.988l-4.2 3.6a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.73-2.885a.563.563 0 00-.586 0l-4.73 2.885a.562.562 0 01-.84-.61l1.285-5.385a.563.563 0 00-.182-.557l-4.2-3.6a.562.562 0 01.32-.988l5.518-.442a.563.563 0 00.475-.345l2.125-5.111z" />
                        </svg>

                        Review
                    </a>

                    {{-- ADDRESS --}}
                    <a href="{{ route('customer.address') }}"
                        class="flex items-center gap-3 p-3 pl-4 rounded-lg font-semibold relative
                {{ request()->routeIs('customer.address*') ? 'text-[#7A1F1F] bg-gray-50 shadow' : 'text-gray-500 hover:bg-gray-100' }}">

                        {{-- GARIS MERAH --}}
                        @if(request()->routeIs('customer.address*'))
                            <span class="absolute left-0 top-0 h-full w-2 bg-[#7A1F1F] rounded-r"></span>
                        @endif

                        {{-- ICON --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 {{ request()->routeIs('customer.address*') ? 'text-[#7A1F1F]' : '' }}">
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
                <button class="bg-[#7A1F1F] text-white px-6 py-2 rounded-lg w-full">
                    Logout
                </button>
            </div>

        </div>


        {{-- MAIN CONTENT --}}
        <div class="flex-1 px-10">

            {{-- HEADER --}}
            <div class="bg-white rounded-xl shadow px-6 py-4 flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-[#7A1F1F]">Address</h2>
                <div class="font-semibold text-[#7A1F1F]">👤 Agus</div>
            </div>

            {{-- CARD --}}
            <div class="bg-white rounded-xl shadow overflow-hidden">

                {{-- TITLE --}}
                <div class="p-6 font-semibold">
                    Address
                </div>

                {{-- ADD BUTTON --}}
                <div class="bg-[#7A1F1F] px-6 py-4 flex justify-center">
                    <a href="{{ route('customer.address.create') }}"
                        class="border-2 border-white text-white px-8 py-2 rounded-lg font-semibold hover:bg-white hover:text-[#7A1F1F] transition">
                        ADD NEW ADDRESS
                    </a>
                </div>

                {{-- ADDRESS LIST --}}
                <div class="p-6">

                    <div class="border border-[#7A1F1F] rounded-xl p-4 flex justify-between items-start">

                        {{-- LEFT --}}
                        <div>
                            <p class="font-semibold">Agus</p>
                            <p class="text-sm text-gray-600">Jln. Raya Puncak Kp. Pasanggrahan</p>
                            <p class="text-sm text-gray-600">0812312312</p>

                            <p class="text-xs text-gray-400 mt-3">
                                This is your default delivery address
                            </p>
                        </div>

                        {{-- RIGHT --}}
                        <div class="flex flex-col items-end gap-3">

                            <button class="flex items-center gap-2 text-sm text-gray-700 hover:text-black">
                                EDIT ✏️
                            </button>

                            <button class="flex items-center gap-2 text-sm text-gray-300 cursor-not-allowed">
                                DELETE 🗑️
                            </button>

                        </div>

                    </div>

                </div>

            </div>

@endsection