<aside class="w-64 bg-white rounded-3xl shadow-2xl flex flex-col overflow-hidden fixed top-6 left-6 bottom-6">
    <div class="p-8">
        <a href="/admin" class="flex justify-center items-center gap-2">
            {{-- <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center">
                        <span class="text-amber-800 font-bold text-xs">MS</span>
                    </div>
                    <h2 class="text-[#8B0000] text-2xl font-bold tracking-tight italic">Murnisaji</h2> --}}
            <img class="h-8" src="{{ asset('images/Murnisaji Logo Red 2.png') }}" alt="">
        </a>
    </div>

    <nav class="mt-4 flex-1 px-4 space-y-2">      
        <a href="#" class="flex items-center px-6 py-3 {{ request()->is('admin') ? 'text-[#8B0000] font-bold border-l-8 border-[#8B0000] rounded-lg' : 'text-gray-400 hover:text-[#8B0000]' }} transition">
            <i class="fas fa-home mr-4"></i> Dashboard
        </a>
        <a href="#" class="flex items-center px-6 py-3 {{ request()->is('admin/product') ? 'text-[#8B0000] font-bold border-l-8 border-[#8B0000] rounded-lg' : 'text-gray-400 hover:text-[#8B0000]' }} transition">
            <i class="fas fa-shopping-bag mr-4"></i> Product
        </a>
        <a href="#" class="flex items-center px-6 py-3 {{ request()->is('admin/order') ? 'text-[#8B0000] font-bold border-l-8 border-[#8B0000] rounded-lg' : 'text-gray-400 hover:text-[#8B0000]' }} transition">
            <i class="fas fa-shopping-cart mr-4"></i> Order
        </a>
        <a href="#" class="flex items-center px-6 py-3 {{ request()->is('admin/review') ? 'text-[#8B0000] font-bold border-l-8 border-[#8B0000] rounded-lg' : 'text-gray-400 hover:text-[#8B0000]' }} transition">
            <i class="fas fa-comment-alt mr-4"></i> Review
        </a>
        <a href="#" class="flex items-center px-6 py-3 {{ request()->is('admin/customer') ? 'text-[#8B0000] font-bold border-l-8 border-[#8B0000] rounded-lg' : 'text-gray-400 hover:text-[#8B0000]' }} transition">
            <i class="fas fa-users mr-4"></i> Customer
        </a>
        <a href="#" class="flex items-center px-6 py-3 {{ request()->is('admin/profile') ? 'text-[#8B0000] font-bold border-l-8 border-[#8B0000] rounded-lg' : 'text-gray-400 hover:text-[#8B0000]' }} transition">
            <i class="fas fa-user mr-4"></i> Profile
        </a>
    </nav>

    <div class="p-8">
        <button
            class="w-full bg-[#8B0000] text-white py-3 rounded-xl font-bold hover:opacity-90 transition shadow-lg uppercase text-xs tracking-widest">
            Logout
        </button>
    </div>
</aside>
