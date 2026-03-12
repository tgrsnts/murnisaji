<footer class="bg-[#7A1F1F] text-white px-6 md:px-20 py-16 mt-20">
    <div class="grid md:grid-cols-4 gap-10">

        <!-- Logo + Menu -->
        <div>
            <img src="{{ asset('images/logo/Logo Murnisaji Putih 1.png') }}" alt="Logo Putih" class="h-10 mb-4">
            <ul class="flex flex-col gap-2">
                <li><a href="{{ route('home') }}" class="hover:text-[#D4AF5A]">Home</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-[#D4AF5A]">About Us</a></li>
                <li><a href="{{ route('menu.index') }}" class="hover:text-[#D4AF5A]">Menu</a></li>
            </ul>
        </div>

        <!-- Navigation -->
        <div>
            <h4 class="font-semibold mb-4">Navigation</h4>
            <ul class="flex flex-col gap-2 text-sm text-gray-200">
                <li><a href="#" class="hover:text-white">Home</a></li>
                <li><a href="#" class="hover:text-white">Products</a></li>
                <li><a href="#" class="hover:text-white">About</a></li>
                <li><a href="#" class="hover:text-white">Contact</a></li>
            </ul>
        </div>

        <!-- Address + Email -->
        <div class="space-y-6">
            <!-- Address -->
            <div class="flex items-start gap-3">
                <div class="bg-white/20 w-10 h-10 flex items-center justify-center rounded-full shrink-0">
                    <i class="fa-solid fa-location-dot text-white"></i>
                </div>
                <div>
                    <h4 class="font-semibold mb-1">Address:</h4>
                    <p class="text-sm text-gray-200">
                        Jl. Kumbang No.14, Babakan, Bogor Tengah, Kota Bogor, Jawa Barat 16128
                    </p>
                </div>
            </div>

            <!-- Email -->
            <div class="flex items-start gap-3">
                <div class="bg-white/20 w-10 h-10 flex items-center justify-center rounded-full shrink-0">
                    <i class="fa-solid fa-envelope text-white"></i>
                </div>
                <div>
                    <h4 class="font-semibold mb-1">Email:</h4>
                    <p class="text-sm text-gray-200">murnisaji@gmail.com</p>
                </div>
            </div>
        </div>

        <!-- Contact + Social Media -->
        <div class="space-y-6">
            <!-- Contact -->
            <div class="flex items-center gap-3">
                <div class="bg-white/20 w-10 h-10 flex items-center justify-center rounded-full shrink-0">
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

    <!-- Copyright -->
    <div class="border-t border-red-400 mt-10 pt-4 text-center text-sm text-gray-200">
        © {{ date('Y') }} Murnisaji. All rights reserved
    </div>
</footer>
