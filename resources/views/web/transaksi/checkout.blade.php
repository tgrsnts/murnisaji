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
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                        <select name="province_id" id="province_id" required 
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                        <input type="hidden" name="provinsi" id="provinsi">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kota/Kabupaten</label>
                                        <select name="city_id" id="city_id" required 
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm" disabled>
                                            <option value="">Pilih Kota</option>
                                        </select>
                                        <input type="hidden" name="kabupaten" id="kabupaten">
                                    </div>
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
                                        <textarea name="detail" rows="3" required class="w-full border border-gray-300 rounded-lg p-2 text-sm" placeholder="Jalan, nomor rumah, patokan">{{ old('detail') }}</textarea>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                        <input type="text" name="kecamatan" required value="{{ old('kecamatan') }}"
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Kurir (opsional)</label>
                                        <input type="text" name="catatan_kurir" value="{{ old('catatan_kurir') }}"
                                            placeholder="Contoh: Rumah cat hijau, dekat masjid"
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
                                        <select name="kurir" id="courier" required disabled
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                            <option value="">Pilih Kurir</option>
                                            <option value="jne">JNE</option>
                                            <option value="pos">POS Indonesia</option>
                                            <option value="tiki">TIKI</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Layanan</label>
                                        <select name="layanan_kurir" id="service" required disabled
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                            <option value="">Pilih Layanan</option>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="ongkir" id="ongkir" value="0">
                                
                                <div id="shippingInfo" class="hidden mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                                    <p class="text-sm text-blue-800">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        <span id="shippingDetails"></span>
                                    </p>
                                </div>
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
                                                    <img src="/images/menu/menu1.png"
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
        const cartWeight = {{ count($cartItems) * 1000 }}; // Assume 1kg per item, adjust as needed

        // State
        let provinces = [];
        let cities = [];
        let shippingServices = [];

        // DOM Elements
        const provinceSelect = document.getElementById('province_id');
        const citySelect = document.getElementById('city_id');
        const courierSelect = document.getElementById('courier');
        const serviceSelect = document.getElementById('service');
        const provinceHidden = document.getElementById('provinsi');
        const kabupatenHidden = document.getElementById('kabupaten');
        const ongkirInput = document.getElementById('ongkir');
        const ongkirDisplay = document.getElementById('ongkirDisplay');
        const totalDisplay = document.getElementById('totalDisplay');
        const shippingInfo = document.getElementById('shippingInfo');
        const shippingDetails = document.getElementById('shippingDetails');

        // Load provinces on page load
        async function loadProvinces() {
            try {
                const response = await fetch('/api/apicoid/provinces');
                const data = await response.json();
                
                if (data.success && Array.isArray(data.data) && data.data.length > 0) {
                    provinces = data.data;
                    populateProvinces();
                } else {
                    provinceSelect.innerHTML = '<option value="">Provinsi tidak tersedia</option>';
                    console.error('Failed to load provinces', data);
                }
            } catch (error) {
                console.error('Error loading provinces:', error);
            }
        }

        function populateProvinces() {
            provinceSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
            provinces.forEach(province => {
                const option = document.createElement('option');
                option.value = province.province_id || province.id || province.code || province.province_code;
                option.textContent = province.province || province.name || province.province_name;
                option.dataset.name = province.province || province.name || province.province_name;
                provinceSelect.appendChild(option);
            });
        }

        // Handle province change
        provinceSelect.addEventListener('change', async function() {
            const selectedOption = this.options[this.selectedIndex];
            provinceHidden.value = selectedOption.dataset.name || '';
            
            // Reset dependent fields
            citySelect.innerHTML = '<option value="">Pilih Kota</option>';
            citySelect.disabled = true;
            kabupatenHidden.value = '';
            resetCourier();
            
            if (this.value) {
                await loadCities(this.value);
            }
        });

        async function loadCities(provinceId) {
            try {
                citySelect.innerHTML = '<option value="">Memuat...</option>';
            const response = await fetch(`/api/apicoid/cities?province_id=${provinceId}`);
                const data = await response.json();
                
                if (data.success && data.data) {
                    cities = data.data;
                    populateCities();
                    citySelect.disabled = false;
                } else {
                    console.error('Failed to load cities');
                    citySelect.innerHTML = '<option value="">Gagal memuat kota</option>';
                }
            } catch (error) {
                console.error('Error loading cities:', error);
                citySelect.innerHTML = '<option value="">Error memuat kota</option>';
            }
        }

        function populateCities() {
            citySelect.innerHTML = '<option value="">Pilih Kota</option>';
            cities.forEach(city => {
                const option = document.createElement('option');
                const cityName = city.city_name || city.name || '';
                const cityType = city.type || '';

                option.value = city.city_id || city.id || city.code || city.city_code;
                option.textContent = `${cityType} ${cityName}`.trim();
                option.dataset.name = cityName;
                citySelect.appendChild(option);
            });
        }

        // Handle city change
        citySelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            kabupatenHidden.value = selectedOption.dataset.name || '';
            
            resetCourier();
            
            if (this.value) {
                courierSelect.disabled = false;
            } else {
                courierSelect.disabled = true;
            }
        });

        // Handle courier change
        courierSelect.addEventListener('change', async function() {
            resetService();
            
            if (this.value && citySelect.value) {
                await loadShippingCost();
            }
        });

        // Handle service change
        serviceSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const cost = parseInt(selectedOption.dataset.cost) || 0;
            const etd = selectedOption.dataset.etd || '';
            
            updatePrice(cost);
            
            if (cost > 0) {
                shippingDetails.textContent = `Estimasi ${etd}`;
                shippingInfo.classList.remove('hidden');
            } else {
                shippingInfo.classList.add('hidden');
            }
        });

        async function loadShippingCost() {
            try {
                serviceSelect.innerHTML = '<option value="">Memuat layanan...</option>';
                serviceSelect.disabled = true;
                
                const response = await fetch('/api/apicoid/cost', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        destination: citySelect.value,
                        weight: cartWeight,
                        courier: courierSelect.value
                    })
                });
                
                const data = await response.json();
                
                if (data.success && data.data && data.data.length > 0) {
                    shippingServices = data.data[0]?.costs || data.data;
                    populateServices();
                    serviceSelect.disabled = false;
                } else {
                    serviceSelect.innerHTML = '<option value="">Tidak ada layanan tersedia</option>';
                }
            } catch (error) {
                console.error('Error loading shipping cost:', error);
                serviceSelect.innerHTML = '<option value="">Error memuat layanan</option>';
            }
        }

        function populateServices() {
            serviceSelect.innerHTML = '<option value="">Pilih Layanan</option>';
            shippingServices.forEach(service => {
                const cost = service.cost?.[0]?.value || service.rate || service.price || service.cost || 0;
                const etd = service.cost?.[0]?.etd || service.etd || service.estimation || '';
                const serviceName = service.service_name || service.service || service.name;
                
                const option = document.createElement('option');
                option.value = serviceName;
                option.textContent = `${serviceName} - Rp ${cost.toLocaleString('id-ID')}${etd ? ' (' + etd + ')' : ''}`;
                option.dataset.cost = cost;
                option.dataset.etd = etd;
                serviceSelect.appendChild(option);
            });
        }

        function resetCourier() {
            courierSelect.value = '';
            courierSelect.disabled = true;
            resetService();
        }

        function resetService() {
            serviceSelect.innerHTML = '<option value="">Pilih Layanan</option>';
            serviceSelect.value = '';
            serviceSelect.disabled = true;
            shippingServices = [];
            updatePrice(0);
            shippingInfo.classList.add('hidden');
        }

        function updatePrice(cost) {
            ongkirInput.value = cost;
            ongkirDisplay.textContent = 'Rp ' + cost.toLocaleString('id-ID');
            
            const total = subtotal + cost;
            totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadProvinces();
        });
    </script>
@endsection
