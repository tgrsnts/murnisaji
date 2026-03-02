<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website - Murnisaji</title>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    body {
        font-family: 'Libre Baskerville', serif;
    }
</style>

<body>

    <div class="min-h-screen bg-[#FCFBF5]">

        <!-- Navbar -->
        <nav class="fixed top-0 z-0 w-full h-[120px] bg-[#FCFBF5] flex items-center justify-between py-10 px-6 md:px-20">

            <!-- Logo -->
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/Murnisaji Logo Red 2.png') }}" alt="Logo Murnisaji" class="h-10">
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35m1.85-5.4a7.5 7.5 0 1 1-15 0
                     7.5 7.5 0 0 1 15 0Z" />
                        </svg>
                    </button>
                    <button class="relative text-black hover:opacity-70 transition">
                        <!-- Badge -->
                        <span
                            class="absolute -top-2 -right-2 min-w-[18px] h-[18px] px-1
           rounded-full bg-[#7A1F1F] text-white text-[11px]
           flex items-center justify-center leading-none">
                            3
                        </span>

                        <!-- Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 2.25h1.386c.51 0 .955.343
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

        <div class="mt-[120px]">
            @yield('content')
        </div>

    </div>
</body>

</html>
