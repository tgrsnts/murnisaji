<aside class="w-64 bg-white rounded-3xl shadow-2xl flex flex-col overflow-hidden fixed top-6 left-6 bottom-6">
    <div class="p-8">
        <a href="{{ route('dashboard.index') }}" class="flex justify-center items-center gap-2">
            <img class="h-8" src="{{ asset('images/logo/Murnisaji Logo Red 2.png') }}" alt="Murnisaji">
        </a>
    </div>

    <nav class="mt-4 flex-1 px-4 space-y-2">
        <a href="{{ route('dashboard.transactions') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('dashboard.index') || request()->routeIs('dashboard.transactions') || request()->routeIs('dashboard.transaction') ? 'text-[#8B0000] font-bold border-l-8 border-[#8B0000] rounded-lg' : 'text-[#D4AF5A] hover:text-[#8B0000]' }} transition">
            <i class="fas fa-shopping-cart mr-4"></i> Transaksi
        </a>
        <a href="{{ route('dashboard.reviews') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('dashboard.reviews') ? 'text-[#8B0000] font-bold border-l-8 border-[#8B0000] rounded-lg' : 'text-[#D4AF5A] hover:text-[#8B0000]' }} transition">
            <i class="fas fa-comment-alt mr-4"></i> Review
        </a>
        <a href="{{ route('dashboard.addresses') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('dashboard.addresses') ? 'text-[#8B0000] font-bold border-l-8 border-[#8B0000] rounded-lg' : 'text-[#D4AF5A] hover:text-[#8B0000]' }} transition">
            <i class="fas fa-map-marker-alt mr-4"></i> Alamat
        </a>
        <a href="{{ route('dashboard.profile') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('dashboard.profile') ? 'text-[#8B0000] font-bold border-l-8 border-[#8B0000] rounded-lg' : 'text-[#D4AF5A] hover:text-[#8B0000]' }} transition">
            <i class="fas fa-user mr-4"></i> Profile
        </a>
    </nav>

    <div class="p-8">
        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-[#8B0000] text-white py-3 rounded-xl font-bold hover:opacity-90 transition shadow-lg uppercase text-xs tracking-widest">
                Logout
            </button>
        </form>
    </div>
</aside>
