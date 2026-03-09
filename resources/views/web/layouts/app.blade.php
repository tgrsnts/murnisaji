<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website - Murnisaji</title>

    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Libre Baskerville', serif;
        }
    </style>
</head>

<body class="bg-[#FCFBF5]">

    <!-- NAVBAR -->
    <nav class="fixed top-0 z-50 w-full h-[120px] bg-[#FCFBF5] flex items-center justify-between py-10 px-6 md:px-20">

        <!-- Logo -->
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo/Murnisaji Logo Red 2.png') }}" alt="Logo Murnisaji" class="h-10">
        </a>

        <!-- Menu -->
        <div class="flex items-center gap-10">

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

            <!-- Icons -->
            <div class="flex items-center gap-6">

                <!-- Search -->
                <button class="text-black hover:opacity-70 transition">
                    🔍
                </button>

                <!-- Cart -->
                <button class="relative text-black hover:opacity-70 transition">

                    <span class="absolute -top-2 -right-2 min-w-[18px] h-[18px] px-1
                rounded-full bg-[#7A1F1F] text-white text-[11px]
                flex items-center justify-center">
                        3
                    </span>

                    🛒

                </button>

            </div>

            <!-- Login -->
            <button class="bg-[#7A1F1F] text-white px-6 py-2 rounded-full">
                Login
            </button>

        </div>
    </nav>


    <!-- CONTENT -->
    <main class="pt-[120px]">
        @yield('content')
    </main>


    <!-- FOOTER -->
    <footer class="bg-[#7A1F1F] text-white px-20 py-16">

        <div class="grid md:grid-cols-4 gap-10">

            <!-- Logo -->
            <div>
                <img src="{{ asset('images/logo/Logo Murnisaji Putih 1.png') }}" class="h-10 mb-4">
            </div>

            <!-- Navigation -->
            <div>
                <h4 class="font-semibold mb-4">Navigation</h4>
                <ul class="grid grid-cols-2 gap-y-2 text-sm text-gray-200">
                    <li><a href="#" class="hover:text-white">Home</a></li>
                    <li><a href="#" class="hover:text-white">Products</a></li>
                    <li><a href="#" class="hover:text-white">About</a></li>
                    <li><a href="#" class="hover:text-white">Contact</a></li>
                </ul>
            </div>

            <!-- Address + Email -->
            <div class="space-y-6">

                <!-- Address -->
                <div class="flex items-start gap-4">
                    <div class="bg-white/20 w-10 h-10 flex items-center justify-center rounded-full shrink-0">
                        <i class="fa-solid fa-location-dot text-white"></i>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-2">Address:</h4>
                        <p class="text-sm text-gray-200">
                            Jl. Kumbang No.14, Babakan, Bogor Tengah,
                            Kota Bogor, Jawa Barat 16128
                        </p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-start gap-4">
                    <div class="bg-white/20 w-10 h-10 flex items-center justify-center rounded-full">
                        <i class="fa-solid fa-envelope text-white"></i>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-2">Email:</h4>
                        <p class="text-sm text-gray-200">
                            murnisaji@gmail.com
                        </p>
                    </div>
                </div>

            </div>

            <!-- Contact -->
            <div class="space-y-6">

                <div class="flex items-center gap-4">
                    <div class="bg-white/20 w-10 h-10 flex items-center justify-center rounded-full">
                        <i class="fa-solid fa-phone text-white"></i>
                    </div>

                    <p class="text-sm text-gray-200">+62 897-9792-989</p>
                </div>

                <!-- Social Media -->
                <div class="flex gap-4">
                    <div class="bg-white/20 w-10 h-10 flex items-center justify-center rounded-full">
                        <i class="fa-brands fa-facebook-f text-white"></i>
                    </div>

                    <div class="bg-white/20 w-10 h-10 flex items-center justify-center rounded-full">
                        <i class="fa-brands fa-instagram text-white"></i>
                    </div>

                    <div class="bg-white/20 w-10 h-10 flex items-center justify-center rounded-full">
                        <i class="fa-brands fa-whatsapp text-white"></i>
                    </div>
                </div>

            </div>
        </div>

        </div>

        <div class="border-t border-red-400 mt-10 pt-4 text-center text-sm text-gray-200">
            © {{ date('Y') }} Murnisaji. All rights reserved
        </div>

    </footer>