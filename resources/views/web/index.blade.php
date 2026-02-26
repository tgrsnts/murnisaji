@extends('web.layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-[#EFECD7] via-[#FCFBF5] to-[#F8EAE1]">

    <!-- Navbar -->
    <nav class="flex items-center justify-between py-10 px-6 md:px-20"
     style="font-family: 'Libre Baskerville', serif;">

    <!-- Logo -->
    <a href="{{ route('home') }}">
        <img src="{{ asset('images/Murnisaji Logo Red 2.png') }}" 
             alt="Logo Murnisaji" 
             class="h-10">
    </a>

    <!-- Menu -->
    <div class="flex items-center space-x-6">
    <ul class="flex gap-10 text-lg">

        <li>
            <a href="{{ route('home') }}"
               class="{{ request()->routeIs('home') ? 'text-red-600 font-semibold' : 'text-[#7A1F1F]' }}">
                Home
            </a>
        </li>

        <li>
            <a href="{{ route('about') }}"
               class="{{ request()->routeIs('about') ? 'text-red-600 font-semibold' : 'text-[#7A1F1F]' }}">
                About Us
            </a>
        </li>

        <li>
            <a href="{{ route('menu') }}"
               class="{{ request()->routeIs('menu') ? 'text-red-600 font-semibold' : 'text-[#7A1F1F]' }}">
                Menu
            </a>
        </li>

    </ul>


    <div class="flex items-center gap-6">
        <button class="text-[#000000] hover:opacity-70 transition">
    <svg xmlns="http://www.w3.org/2000/svg" 
         fill="none" 
         viewBox="0 0 24 24" 
         stroke-width="1.5" 
         stroke="currentColor" 
         class="w-6 h-6">
        <path stroke-linecap="round" 
              stroke-linejoin="round" 
              d="m21 21-4.35-4.35m1.85-5.4a7.5 7.5 0 1 1-15 0 
                 7.5 7.5 0 0 1 15 0Z" />
    </svg>
        </button>
    <button class="text-[#000000] hover:opacity-70 transition">
    <svg xmlns="http://www.w3.org/2000/svg" 
         fill="none" 
         viewBox="0 0 24 24" 
         stroke-width="1.5" 
         stroke="currentColor" 
         class="w-6 h-6">
        <path stroke-linecap="round" 
              stroke-linejoin="round" 
              d="M2.25 2.25h1.386c.51 0 .955.343 
                 1.087.835L5.76 6.75m0 0h12.24m-12.24 
                 0-1.12 5.598a1.125 1.125 0 0 
                 0 1.1 1.402h9.52a1.125 1.125 0 
                 0 0 1.1-.902L18 6.75m-12.24 
                 0L5.76 6.75m0 0L4.723 
                 3.085M16.5 21a1.5 1.5 0 
                 1 1-3 0 1.5 1.5 0 0 1 
                 3 0Zm-9 0a1.5 1.5 0 1 
                 1-3 0 1.5 1.5 0 0 1 
                 3 0Z" />
    </svg>
    </button>
    </div>
    <!-- Login Button -->
    <button class="bg-[#7A1F1F] text-white px-6 py-2 rounded-full">
        Login
    </button>
    </div>

</nav>
    <!-- Brand Bar -->
        <div class="flex items-center justify-center my-6 px-6 md:px-20">
            <div class="h-px bg-[#D4AF5A] flex-1 max-w-[30px]"></div>
            <span class="px-4 text-[#7A1F1F] text-lg font-semibold">Abon Murnisaji</span>
            <div class="h-px bg-[#D4AF5A] flex-1 max-w-[30px]"></div>
        </div>

    <!-- Hero -->
   <section class="flex items-center justify-between px-20 py-24">
    

        <div class="max-w-2xl">

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

                <button class="bg-white border border-[#7A1F1F] text-[#7A1F1F] px-8 py-3 rounded-full">
                    See Product
                </button>
            </div>

        </div>

        <div class="w-full max-w-[300px] md:max-w-[600px] mx-auto">
            <img src="/images/logo abon.png" class="w-full h-auto object-contain">
        </div>
    </section>

</div>

@endsection