<aside id="nav-menu" class="hidden transition-all w-64 bg-white rounded-3xl shadow-2xl md:flex flex-col overflow-hidden fixed top-4 left-4 md:top-6 md:left-6 bottom-6">
    <div class="flex justify-between p-4">
        <a href="{{ route('home') }}" class="flex justify-center items-center gap-2">
            <img class="h-16 md:h-24" src="{{ asset('images/logo/MAIN LOGO-01.webp') }}" alt="Murnisaji">
        </a>

        <button id="hamburger-btn-off" class="md:hidden text-[#7A1F1F] p-2 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    <nav class="mt-4 flex-1 px-4 space-y-2">
        <a href="{{ route('dashboard.transactions') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('dashboard.index') || request()->routeIs('dashboard.transactions') || request()->routeIs('dashboard.transaction') ? 'text-[#8B0000] font-bold border-l-8 border-[#8B0000] rounded-lg' : 'text-[#D4AF5A] hover:text-[#8B0000]' }} transition">
            <i class="fas fa-shopping-cart mr-4"></i> Transaksi
        </a>
        <a href="{{ route('dashboard.reviews') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('dashboard.reviews') ? 'text-[#8B0000] font-bold border-l-8 border-[#8B0000] rounded-lg' : 'text-[#D4AF5A] hover:text-[#8B0000]' }} transition">
            <i class="fas fa-comment-alt mr-4"></i> Ulasan
        </a>
        <a href="{{ route('dashboard.addresses') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('dashboard.addresses') ? 'text-[#8B0000] font-bold border-l-8 border-[#8B0000] rounded-lg' : 'text-[#D4AF5A] hover:text-[#8B0000]' }} transition">
            <i class="fas fa-map-marker-alt mr-4"></i> Alamat
        </a>
        <a href="{{ route('dashboard.profile') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('dashboard.profile') ? 'text-[#8B0000] font-bold border-l-8 border-[#8B0000] rounded-lg' : 'text-[#D4AF5A] hover:text-[#8B0000]' }} transition">
            <i class="fas fa-user mr-4"></i> Profil
        </a>
    </nav>

    {{-- <div class="p-8">
        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-[#8B0000] text-white py-3 rounded-xl font-bold hover:opacity-90 transition shadow-lg uppercase text-xs tracking-widest hover:cursor-pointer">
                Logout
            </button>
        </form>
    </div> --}}

    <x-modal-logout />
</aside>
