<header class="flex justify-between items-center text-[#8B0000] bg-white p-5 rounded-3xl">
    <h1 class="text-2xl font-bold tracking-wide">{{ $title ?? 'Dashboard User' }}</h1>
    <div class="flex items-center gap-2">
        <i class="fas fa-user-circle text-2xl"></i>
        <span class="font-semibold text-sm">{{ Auth::user()->name }}</span>
    </div>
</header>
