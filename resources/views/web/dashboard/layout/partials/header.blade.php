<header class="flex justify-between items-center text-[#8B0000] bg-white p-4 md:p-5 rounded-xl md:rounded-3xl">
    <div class="flex items-center gap-2">
        <button id="hamburger-btn-on" class="md:hidden text-[#7A1F1F] p-2 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
        <h1 class="text-lg md:text-2xl font-bold tracking-wide">{{ $title ?? 'Dashboard User' }}</h1>
    </div>
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

<script>
    const btnOn = document.getElementById('hamburger-btn-on');
    const btnOff = document.getElementById('hamburger-btn-off');
    const menu = document.getElementById('nav-menu');

    btnOn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    btnOff.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });


</script>