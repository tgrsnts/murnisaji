@extends('customer.layouts.app')

@section('content')

    <div class="mb-6 flex justify-center pt-6 px-6">
        <div class="w-full flex gap-6">

            {{-- SIDEBAR --}}
            {{-- SIDEBAR --}}
            <div class="w-[260px] bg-white rounded-[30px] shadow-xl p-6 flex flex-col h-[95vh]">

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
                            class="flex items-center gap-3 p-3 pl-4 rounded-lg font-semibold relative
                            {{ request()->routeIs('customer.profile*') ? 'text-[#7A1F1F] bg-gray-50 shadow' : 'text-gray-500 hover:bg-gray-100' }}">

                            {{-- GARIS MERAH --}}
                            @if(request()->routeIs('customer.profile*'))
                                <span class="absolute left-0 top-0 h-full w-2 bg-[#7A1F1F] rounded-r"></span>
                            @endif

                            {{-- ICON --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5 {{ request()->routeIs('customer.profile*') ? 'text-[#7A1F1F]' : '' }}">
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

            {{-- CONTENT --}}
            <div class="flex-1">

                {{-- HEADER --}}
                <div class="bg-white rounded-2xl shadow-md p-4 mb-6 flex justify-between">
                    <h1 class="font-semibold">Profile</h1>
                    <span class="text-sm text-gray-600">Agus</span>
                </div>

                {{-- CARD --}}
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                    {{-- HEADER MERAH --}}
                    <div class="bg-[#7A1F1F] p-6 flex items-center gap-4 text-white">

                        {{-- FOTO --}}
                        <div class="relative">
                            <label for="photo" class="cursor-pointer">

                                <img id="preview" src="https://via.placeholder.com/150"
                                    class="w-20 h-20 rounded-full object-cover border-4 border-white">

                                {{-- ICON CAMERA --}}
                                <div class="absolute bottom-0 right-0 bg-white p-1 rounded-full">
                                    📷
                                </div>

                            </label>

                            <input type="file" id="photo" class="hidden" accept="image/*" onchange="previewImage(event)">
                        </div>

                        <div>
                            <h2 class="text-xl font-semibold">Agus</h2>
                            <p class="text-sm opacity-80">kebuli@gmail.com</p>
                        </div>

                        <div class="ml-auto">
                            <span class="bg-white text-[#7A1F1F] px-4 py-1 rounded-full text-sm font-semibold">
                                Customer
                            </span>
                        </div>
                    </div>

                    {{-- FORM --}}
                    <div class="p-6 space-y-5">

                        <div>
                            <label class="text-sm text-[#7A1F1F] font-semibold">Full Name</label>
                            <input type="text" value="Agus Mutiara"
                                class="w-full mt-2 px-4 py-3 rounded-lg border bg-gray-100">
                        </div>

                        <div>
                            <label class="text-sm text-[#7A1F1F] font-semibold">Email</label>
                            <input type="email" value="agus@gmail.com"
                                class="w-full mt-2 px-4 py-3 rounded-lg border bg-gray-100">
                        </div>

                        <div>
                            <label class="text-sm text-[#7A1F1F] font-semibold">Phone Number</label>
                            <input type="text" value="081212341234" inputmode="numeric" pattern="[0-9]*"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full mt-2 px-4 py-3 rounded-lg border bg-gray-100">
                        </div>

                        {{-- BUTTON --}}
                        <div class="flex justify-end gap-3 mt-6">

                            <a href="{{ route('customer.profile') }}"
                                class="border border-[#7A1F1F] text-[#7A1F1F] px-6 py-2 rounded-lg">
                                Back
                            </a>

                            <a href="{{ route('customer.profile') }}" class="bg-[#7A1F1F] text-white px-6 py-2 rounded-lg">
                                Save
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

    {{-- SCRIPT PREVIEW FOTO --}}
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById('preview').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

@endsection