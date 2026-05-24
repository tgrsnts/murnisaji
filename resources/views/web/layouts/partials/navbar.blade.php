<nav id="navbar"
    class="fixed top-0 z-[100] w-full h-[120px] bg-[#FCFBF5] flex items-center justify-between py-6 px-6 md:px-20 border-b border-gray-100">

    <a href="{{ route('home') }}">
        <img src="{{ asset('images/logo/MAIN LOGO-01.webp') }}" alt="Logo Murnisaji" class="h-16 md:h-24">
    </a>

    <button id="hamburger-btn" class="md:hidden text-[#7A1F1F] p-2 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
    </button>

    <div id="nav-menu"
        class="hidden md:flex flex-col md:flex-row items-center absolute md:static top-[90px] left-0 w-full md:w-auto bg-[#FCFBF5] p-6 md:p-0 shadow-lg md:shadow-none transition-all duration-300">

        <ul class="flex flex-col md:flex-row gap-6 md:gap-10 text-lg w-full md:w-auto text-center md:text-left">
            <li><a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'text-red-600 font-semibold' : 'text-[#7A1F1F]' }}">Home</a>
            </li>
            <li><a href="{{ route('about') }}"
                    class="{{ request()->routeIs('about') ? 'text-red-600 font-semibold' : 'text-[#7A1F1F]' }}">About
                    Us</a></li>
            <li><a href="{{ route('menu.index') }}"
                    class="{{ request()->routeIs('menu.index') ? 'text-red-600 font-semibold' : 'text-[#7A1F1F]' }}">Menu</a>
            </li>
        </ul>

        <div
            class="flex flex-col md:flex-row items-center gap-6 mt-6 md:mt-0 md:ml-10 pt-6 md:pt-0 border-t md:border-t-0 border-gray-200 w-full md:w-auto">
            <a href="{{ route('cart.index') }}" class="relative text-black hover:opacity-70 transition">
                @php
                    $cart = session()->get('cart', []);
                    $cartCount = count($cart);
                @endphp
                @if ($cartCount > 0)
                    <span
                        class="absolute -top-2 -right-2 min-w-[18px] h-[18px] px-1 rounded-full bg-[#7A1F1F] text-white text-[11px] flex items-center justify-center leading-none">
                        {{ $cartCount }}
                    </span>
                @endif
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 2.25h1.386c.51 0 .955.343 1.087.835L5.76 6.75m0 0h12.24m-12.24 0-1.12 5.598a1.125 1.125 0 0 0 1.1 1.402h9.52a1.125 1.125 0 0 0 1.1-.902L18 6.75m-12.24 0L5.76 6.75m0 0L4.723 3.085M16.5 21a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm-9 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                </svg>
            </a>

            @if (Auth::check())
                <div class="relative group">
                    <button
                        class="flex items-center gap-2 bg-[#7A1F1F] text-white px-6 py-2 rounded-full hover:bg-[#5A0F0F] transition font-medium">
                        {{ Auth::user()->name }}
                    </button>
                    <div
                        class="absolute right-0 pt-2 w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-200 z-50">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden">
                            @if (Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}"
                                    class="block px-4 py-2 text-gray-900 hover:bg-gray-100">Dashboard</a>
                                <a href="{{ route('admin.produk.index') }}"
                                    class="block px-4 py-2 text-gray-900 hover:bg-gray-100">Produk</a>
                                <a href="{{ route('admin.transaksi.index') }}"    
                                    class="block px-4 py-2 text-gray-900 hover:bg-gray-100">Transaksi</a>
                                <a href="{{ route('admin.review.index') }}"
                                    class="block px-4 py-2 text-gray-900 hover:bg-gray-100">Review</a>
                                <a href="{{ route('admin.users.index') }}"
                                    class="block px-4 py-2 text-gray-900 hover:bg-gray-100">Pelanggan</a>
                            
                                <a href="{{ route('admin.profile.index') }}"
                                    class="block px-4 py-2 text-gray-900 hover:bg-gray-100">Profil</a>  
                            @else
                                <a href="{{ route('dashboard.transactions') }}"
                                    class="block px-4 py-2 text-gray-900 hover:bg-gray-100">Transaksi</a>
                                <a href="{{ route('dashboard.reviews') }}"
                                    class="block px-4 py-2 text-gray-900 hover:bg-gray-100">Review</a>
                                <a href="{{ route('dashboard.addresses') }}"
                                    class="block px-4 py-2 text-gray-900 hover:bg-gray-100">Alamat</a>
                                <a href="{{ route('dashboard.profile') }}"
                                    class="block px-4 py-2 text-gray-900 hover:bg-gray-100">Profil</a>
                            @endif
                            <form method="POST" action="{{ route('auth.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-gray-900 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('auth.login') }}"
                    class="bg-[#7A1F1F] text-white px-6 py-2 rounded-full hover:bg-[#5A0F0F] transition font-medium">Login</a>
            @endif
        </div>
    </div>
</nav>

<script>
    const btn = document.getElementById('hamburger-btn');
    const menu = document.getElementById('nav-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
