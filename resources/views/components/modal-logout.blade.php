<div class="p-8">
    <!-- Tombol Pemicu Modal -->
    <button 
        id="openModal"
        type="button" 
        class="w-full bg-[#8B0000] text-white py-3 rounded-xl font-bold hover:opacity-90 transition shadow-lg uppercase text-xs tracking-widest hover:cursor-pointer">
        Logout
    </button>

    <!-- Modal Overlay (Hidden by default) -->
    <div 
        id="logoutModal"
        class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-opacity"
    >
        <!-- Konten Modal -->
        <div class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-2xl scale-95 transition-transform duration-300">
            <div class="text-center">
                <!-- Icon Warning -->
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>
                
                <h3 class="text-lg font-bold text-gray-900 mb-2">Konfirmasi Logout</h3>
                <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin keluar dari akun Anda?</p>
            </div>

            <div class="flex flex-col gap-3">
                <!-- Form Logout -->
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-[#8B0000] text-white py-3 rounded-xl font-bold hover:bg-red-800 transition hover:cursor-pointer">
                        Ya, Logout
                    </button>
                </form>

                <!-- Tombol Batal -->
                <button 
                    id="closeModal"
                    type="button" 
                    class="w-full bg-gray-100 text-gray-700 py-3 rounded-xl font-bold hover:bg-gray-200 transition hover:cursor-pointer">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('logoutModal');
    const btnOpen = document.getElementById('openModal');
    const btnClose = document.getElementById('closeModal');

    // Fungsi untuk membuka modal
    btnOpen.onclick = function() {
        modal.classList.remove('hidden');
        // Sedikit delay agar transisi scale terasa halus
        setTimeout(() => {
            modal.querySelector('.bg-white').classList.remove('scale-95');
            modal.querySelector('.bg-white').classList.add('scale-100');
        }, 10);
    }

    // Fungsi untuk menutup modal
    const hideModal = () => {
        modal.classList.add('hidden');
        modal.querySelector('.bg-white').classList.remove('scale-100');
        modal.querySelector('.bg-white').classList.add('scale-95');
    }

    btnClose.onclick = hideModal;

    // Menutup modal jika klik di area luar (overlay)
    window.onclick = function(event) {
        if (event.target == modal) {
            hideModal();
        }
    }

    // Menutup modal dengan tombol ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            hideModal();
        }
    });
</script>