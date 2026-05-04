<header class="flex justify-between items-center text-[#8B0000] bg-white p-5 rounded-3xl">
    <h1 class="text-2xl font-bold tracking-wide">{{ $title ?? 'Dashboard' }}</h1>
    <div class="flex items-center gap-2">
        @if (Auth::user()->gambar)
            <img src="{{ asset('storage/' . Auth::user()->gambar) }}" alt="{{ Auth::user()->name }}"
                class="w-12 h-12 object-cover rounded-full border-2 border-[#8B0000]">
        @else
            <i class="fas fa-user-circle text-2xl"></i>
        @endif
        <span class="font-semibold text-sm">{{ Auth::user()->name }}</span>
    </div>
</header>
