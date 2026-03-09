@extends('web.layouts.app')

@section('content')
    <section class="bg-white px-20 py-12 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                    <ul class="list-disc pl-5 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (count($cartItems) > 0)
                <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Checkout Form -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Shipping Address Section -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h2 class="text-xl font-bold text-gray-900 mb-4">Data Penerima</h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                                        <input type="text" name="nama_penerima" required value="{{ old('nama_penerima') }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                                        <input type="text" name="no_telepon" required value="{{ old('no_telepon') }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Email (opsional)</label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                    </div>
                                </div>

                                <h3 class="text-lg font-semibold text-gray-900 mt-6 mb-3">Alamat Pengiriman</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Label Alamat</label>
                                        <input type="text" name="label_alamat" required value="{{ old('label_alamat') }}"
                                            placeholder="Contoh: Rumah"
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                                        <input type="text" name="kodepos" required value="{{ old('kodepos') }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Detail Alamat</label>
                                        <textarea name="detail" rows="3" required class="w-full border border-gray-300 rounded-lg p-2 text-sm">{{ old('detail') }}</textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                        <input type="text" name="provinsi" required value="{{ old('provinsi') }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">ID Provinsi</label>
                                        <input type="number" name="province_id" min="1" required value="{{ old('province_id') }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kabupaten/Kota</label>
                                        <input type="text" name="kabupaten" required value="{{ old('kabupaten') }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">ID Kota</label>
                                        <input type="number" name="city_id" min="1" required value="{{ old('city_id') }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                        <input type="text" name="kecamatan" required value="{{ old('kecamatan') }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Kurir (opsional)</label>
                                        <input type="text" name="catatan_kurir" value="{{ old('catatan_kurir') }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                    </div>
                                </div>
                            </div>

                            <!-- Courier Section -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h2 class="text-xl font-bold text-gray-900 mb-4">Pilih Kurir</h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kurir</label>
                                        <select name="kurir" required onchange="updateShipping()"
                                            class="w-full border border-[#D4AF5A] rounded-lg p-2 text-sm">
                                            <option value="">Pilih Kurir</option>
                                            <option value="JNE">JNE</option>
                                            <option value="JNT">J&T Express</option>
                                            <option value="SiCepat">SiCepat</option>
                                            <option value="Pos Indonesia">Pos Indonesia</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Layanan</label>
                                        <select name="layanan_kurir" required onchange="updateShipping()"
                                            class="w-full border border-[#D4AF5A] rounded-lg p-2 text-sm">
                                            <option value="">Pilih Layanan</option>
                                            <option value="REG" data-cost="15000">REG (Rp 15.000)</option>
                                            <option value="YES" data-cost="25000">YES (Rp 25.000)</option>
                                            <option value="OKE" data-cost="10000">OKE (Rp 10.000)</option>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="ongkir" id="ongkir" value="0">
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="lg:col-span-1">
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 sticky top-4">
                                <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Pesanan</h2>

                                <!-- Product List -->
                                <div class="space-y-3 mb-4">
                                    @foreach ($cartItems as $item)
                                        <div class="flex gap-3">
                                            <div class="w-16 h-16 bg-gray-200 rounded shrink-0">
                                                @if ($item['produk']->gambar)
                                                    <img src="{{ asset('storage/' . $item['produk']->gambar) }}"
                                                        alt="{{ $item['produk']->nama_produk }}"
                                                        class="w-full h-full object-cover rounded">
                                                @else
                                                    <img src="/images/Abon Sapi.png"
                                                        alt="{{ $item['produk']->nama_produk }}"
                                                        class="w-full h-full object-contain rounded">
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900">
                                                    {{ $item['produk']->nama_produk }}</p>
                                                <p class="text-xs text-gray-500">{{ $item['qty'] }} x Rp
                                                    {{ number_format($item['produk']->harga, 0, ',', '.') }}</p>
                                                <p class="text-sm font-semibold text-[#7A1F1F]">Rp
                                                    {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Price Summary -->
                                <div class="border-t border-gray-200 pt-4 space-y-2 mb-6">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Subtotal Produk</span>
                                        <span class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Ongkir</span>
                                        <span class="font-medium" id="ongkirDisplay">Rp 0</span>
                                    </div>
                                    <div class="flex justify-between text-lg font-bold border-t pt-2">
                                        <span>Total</span>
                                        <span class="text-[#7A1F1F]" id="totalDisplay">Rp
                                            {{ number_format($subtotal, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full bg-[#7A1F1F] text-white py-3 rounded-lg font-semibold hover:bg-[#5A0F0F] transition cursor-pointer">
                                    Bayar Sekarang
                                </button>

                                <a href="{{ route('cart.index') }}"
                                    class="block w-full text-center border-2 border-[#D4AF5A] text-gray-700 py-2 rounded-lg hover:bg-gray-50 transition text-sm mt-3 cursor-pointer">
                                    Kembali ke Keranjang
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <div class="text-center py-20">
                    <i class="fas fa-shopping-cart text-[#D4AF5A] text-6xl mb-4"></i>
                    <h2 class="text-2xl font-semibold text-gray-700 mb-2">Keranjang Kosong</h2>
                    <p class="text-gray-500 mb-6">Tidak ada produk untuk di-checkout</p>
                    <a href="{{ route('menu.index') }}"
                        class="inline-block bg-[#7A1F1F] text-white px-6 py-3 rounded-lg hover:bg-[#5A0F0F] transition cursor-pointer">
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
    </section>

    <script>
        const subtotal = {{ $subtotal }};

        function updateShipping() {
            const layananSelect = document.querySelector('select[name="layanan_kurir"]');
            const selectedOption = layananSelect.options[layananSelect.selectedIndex];
            const cost = parseInt(selectedOption.getAttribute('data-cost')) || 0;

            document.getElementById('ongkir').value = cost;
            document.getElementById('ongkirDisplay').textContent = 'Rp ' + cost.toLocaleString('id-ID');

            const total = subtotal + cost;
            document.getElementById('totalDisplay').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

    </script>
@endsection
