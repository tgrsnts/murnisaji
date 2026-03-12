<nav class="fixed top-0 z-10 w-full h-[120px] bg-[#FCFBF5] flex items-center justify-between py-10 px-6 md:px-20">

    <!-- Logo -->
    <a href="{{ route('home') }}">
        <img src="{{ asset('images/logo/Murnisaji Logo Red 2.png') }}" alt="Logo Murnisaji" class="h-10">
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
                <a href="{{ route('menu.index') }}"
                    class="{{ request()->routeIs('menu.index') ? 'text-red-600 font-semibold' : 'text-[#7A1F1F]' }}">
                    Menu
                </a>
            </li>

        </ul>



        <a href="{{ route('cart.index') }}" class="relative text-black hover:opacity-70 transition">
            @php
                $cart = session()->get('cart', []);
                $cartCount = count($cart);
            @endphp

            <!-- Badge -->
            @if ($cartCount > 0)
                <span
                    class="absolute -top-2 -right-2 min-w-[18px] h-[18px] px-1
                               rounded-full bg-[#7A1F1F] text-white text-[11px]
                               flex items-center justify-center leading-none">
                    {{ $cartCount }}
                </span>
            @endif

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
        </a>

        <!-- Auth Menu -->
        @if (Auth::check())
            <div class="relative group">
                <button
                    class="flex items-center gap-2 bg-[#7A1F1F] text-white px-6 py-2 rounded-full hover:bg-[#5A0F0F] transition font-medium">
                    {{ Auth::user()->name }}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div
                    class="absolute right-0 mt-0 w-48 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition z-20">
                    <a href="{{ route('dashboard.transactions') }}"
                        class="block px-4 py-2 text-gray-900 hover:bg-gray-100 transition">Transaksi</a>
                    <a href="{{ route('dashboard.reviews') }}"
                        class="block px-4 py-2 text-gray-900 hover:bg-gray-100 transition">Review</a>
                    <a href="{{ route('dashboard.addresses') }}"
                        class="block px-4 py-2 text-gray-900 hover:bg-gray-100 transition">Alamat</a>
                    <a href="{{ route('dashboard.profile') }}"
                        class="block px-4 py-2 text-gray-900 hover:bg-gray-100 transition">Profil</a>
                    <form method="POST" action="{{ route('auth.logout') }}" class="block">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-gray-900 hover:bg-gray-100 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('auth.login') }}"
                class="bg-[#7A1F1F] text-white px-6 py-2 rounded-full hover:bg-[#5A0F0F] transition font-medium">
                Login
            </a>
        @endif
    </div>
</nav>
