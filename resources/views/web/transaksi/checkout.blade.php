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

                    @php
                        $isLoggedIn = auth()->check();
                        $hasSavedAddresses = $isLoggedIn && isset($savedAddresses) && $savedAddresses->count() > 0;
                    @endphp

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Checkout Form -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Shipping Address Section -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h2 class="text-xl font-bold text-gray-900 mb-4">Data Penerima</h2>

                                @if ($hasSavedAddresses)
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Alamat Tersimpan</label>
                                            <select name="selected_alamat_id" id="selected_alamat_id" required
                                                class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                                <option value="">Pilih Alamat</option>
                                                @foreach ($savedAddresses as $alamat)
                                                    <option value="{{ $alamat->alamat_id }}"
                                                        data-nama-penerima="{{ $alamat->nama_penerima }}"
                                                        data-no-telepon="{{ $alamat->no_telepon }}"
                                                        data-label-alamat="{{ $alamat->label_alamat }}"
                                                        data-detail="{{ $alamat->detail }}"
                                                        data-provinsi="{{ $alamat->provinsi }}"
                                                        data-province-id="{{ $alamat->province_id }}"
                                                        data-kabupaten="{{ $alamat->kabupaten }}"
                                                        data-city-id="{{ $alamat->city_id }}"
                                                        data-village-id="{{ $alamat->village_id }}"
                                                        data-kecamatan="{{ $alamat->kecamatan }}"
                                                        data-kodepos="{{ $alamat->kodepos }}"
                                                        data-catatan-kurir="{{ $alamat->catatan_kurir }}"
                                                        {{ old('selected_alamat_id') == $alamat->alamat_id ? 'selected' : '' }}>
                                                        {{ $alamat->label_alamat }} - {{ $alamat->detail }}, {{ $alamat->kabupaten }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div id="savedAddressPreview" class="hidden p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                            <p class="text-sm font-semibold text-gray-900 mb-1" id="previewLabel"></p>
                                            <p class="text-sm text-gray-700" id="previewRecipient"></p>
                                            <p class="text-sm text-gray-700" id="previewPhone"></p>
                                            <p class="text-sm text-gray-700" id="previewAddress"></p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Email (opsional)</label>
                                            <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}"
                                                class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Kurir (opsional)</label>
                                            <input type="text" name="catatan_kurir" id="catatan_kurir"
                                                value="{{ old('catatan_kurir') }}"
                                                placeholder="Contoh: Rumah cat hijau, dekat masjid"
                                                class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                        </div>

                                        <input type="hidden" name="nama_penerima" id="nama_penerima_hidden">
                                        <input type="hidden" name="no_telepon" id="no_telepon_hidden">
                                        <input type="hidden" name="label_alamat" id="label_alamat_hidden">
                                        <input type="hidden" name="detail" id="detail_hidden">
                                        <input type="hidden" name="provinsi" id="provinsi">
                                        <input type="hidden" name="province_id" id="province_id_hidden">
                                        <input type="hidden" name="kabupaten" id="kabupaten">
                                        <input type="hidden" name="city_id" id="city_id">
                                        <input type="hidden" name="kecamatan" id="kecamatan_hidden">
                                        <input type="hidden" name="kodepos" id="kodepos_hidden">
                                    </div>
                                @else
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
                                            <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}"
                                                class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                        </div>
                                    </div>

                                    @if ($isLoggedIn)
                                        <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg text-sm text-yellow-800">
                                            Anda belum punya alamat tersimpan. Isi alamat di bawah ini, alamat akan otomatis disimpan ke akun Anda.
                                        </div>
                                    @endif

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
                                        <div class="">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                            <select id="subdistrict_id" name="kecamatan" required
                                                class="w-full border border-gray-300 rounded-lg p-2 text-sm" disabled>
                                                <option value="">Pilih kabupaten terlebih dahulu</option>
                                            </select>
                                        </div>
                                        <div class="">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Desa/Kelurahan</label>
                                            <select id="village_id" name="desa"
                                                class="w-full border border-gray-300 rounded-lg p-2 text-sm" disabled>
                                                <option value="">Pilih kecamatan terlebih dahulu</option>
                                            </select>
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
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Kurir (opsional)</label>
                                            <input type="text" name="catatan_kurir" value="{{ old('catatan_kurir') }}"
                                                placeholder="Contoh: Rumah cat hijau, dekat masjid"
                                                class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Courier Section -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h2 class="text-xl font-bold text-gray-900 mb-4">Pilih Kurir</h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Layanan</label>
                                        <select id="category" required disabled
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                            <option value="">Pilih Kategori</option>
                                            <option value="reguler">Reguler</option>
                                            <option value="express">Express</option>
                                            <option value="kargo">Kargo</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kurir</label>
                                        <select name="kurir" id="courier" required disabled
                                            class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                            <option value="">Pilih Kurir</option>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="ongkir" id="ongkir" value="0">
                                <input type="hidden" name="layanan_kurir" id="layanan_kurir_hidden" value="">
                                
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
        const cartWeightKg = {{ max(1, count($cartItems)) }};
        const originVillageCode = '{{ (string) config('services.apicoid.origin_village_code', '') }}';

        // Allowed couriers - only J&T, AnterAja, JNE, SiCepat, Ninja
        const allowedCouriers = ['JT', 'anteraja', 'JNE', 'JNECargo', 'SiCepat', 'SiCepatCargo', 'Ninja'];
        
        // Courier categories mapping
        const courierCategories = {
            'JT': 'express',
            'anteraja': 'express',
            'JNE': 'express',
            'JNECargo': 'kargo',
            'SiCepat': 'reguler',
            'SiCepatCargo': 'kargo',
            'Ninja': 'reguler'
        };

        let provinces = [];
        let cities = [];
        let subdistricts = [];
        let villages = [];
        let shippingServices = []; // Full list from API
        let filteredServices = {}; // Services grouped by category then courier

        const categorySelect = document.getElementById('category');
        const provinceSelect = document.getElementById('province_id');
        const citySelect = document.getElementById('city_id');
        const subdistrictSelect = document.getElementById('subdistrict_id');
        const villageSelect = document.getElementById('village_id');
        const courierSelect = document.getElementById('courier');
        const layananKurirHidden = document.getElementById('layanan_kurir_hidden');
        const provinceHidden = document.getElementById('provinsi');
        const kabupatenHidden = document.getElementById('kabupaten');
        const ongkirInput = document.getElementById('ongkir');
        const ongkirDisplay = document.getElementById('ongkirDisplay');
        const totalDisplay = document.getElementById('totalDisplay');
        const shippingInfo = document.getElementById('shippingInfo');
        const shippingDetails = document.getElementById('shippingDetails');

        const selectedAddressSelect = document.getElementById('selected_alamat_id');
        const hasSavedAddressMode = !!selectedAddressSelect;

        function destinationVillageCode() {
            if (hasSavedAddressMode && selectedAddressSelect) {
                const option = selectedAddressSelect.options[selectedAddressSelect.selectedIndex];
                return option?.dataset.villageId || '';
            }

            if (villageSelect && villageSelect.tagName === 'SELECT') {
                const option = villageSelect.options[villageSelect.selectedIndex];
                return option?.dataset.villageId || '';
            }

            return '';
        }

        function applySelectedAddress() {
            if (!selectedAddressSelect) return;

            const option = selectedAddressSelect.options[selectedAddressSelect.selectedIndex];
            const hasValue = !!selectedAddressSelect.value;

            const setVal = (id, val) => {
                const el = document.getElementById(id);
                if (el) el.value = val || '';
            };

            setVal('nama_penerima_hidden', option?.dataset.namaPenerima);
            setVal('no_telepon_hidden', option?.dataset.noTelepon);
            setVal('label_alamat_hidden', option?.dataset.labelAlamat);
            setVal('detail_hidden', option?.dataset.detail);
            setVal('provinsi', option?.dataset.provinsi);
            setVal('province_id_hidden', option?.dataset.provinceId);
            setVal('kabupaten', option?.dataset.kabupaten);
            setVal('city_id', option?.dataset.cityId);
            setVal('kecamatan_hidden', option?.dataset.kecamatan);
            setVal('kodepos_hidden', option?.dataset.kodepos);

            const catatanInput = document.getElementById('catatan_kurir');
            if (catatanInput && !catatanInput.value) {
                catatanInput.value = option?.dataset.catatanKurir || '';
            }

            const preview = document.getElementById('savedAddressPreview');
            const previewLabel = document.getElementById('previewLabel');
            const previewRecipient = document.getElementById('previewRecipient');
            const previewPhone = document.getElementById('previewPhone');
            const previewAddress = document.getElementById('previewAddress');

            if (preview && previewLabel && previewRecipient && previewPhone && previewAddress) {
                if (hasValue) {
                    preview.classList.remove('hidden');
                    previewLabel.textContent = option?.dataset.labelAlamat || '';
                    previewRecipient.textContent = option?.dataset.namaPenerima || '';
                    previewPhone.textContent = option?.dataset.noTelepon || '';
                    previewAddress.textContent = `${option?.dataset.detail || ''}, ${option?.dataset.kecamatan || ''}, ${option?.dataset.kabupaten || ''}, ${option?.dataset.provinsi || ''} ${option?.dataset.kodepos || ''}`;
                } else {
                    preview.classList.add('hidden');
                }
            }

            resetCategory();
            if (categorySelect) {
                categorySelect.disabled = !hasValue;
            }
        }

        async function loadProvinces() {
            if (!provinceSelect || provinceSelect.tagName !== 'SELECT') return;

            try {
                const response = await fetch('/api/apicoid/provinces');
                const data = await response.json();

                if (data.success && Array.isArray(data.data) && data.data.length > 0) {
                    provinces = data.data;
                    populateProvinces();
                } else {
                    provinceSelect.innerHTML = '<option value="">Provinsi tidak tersedia</option>';
                }
            } catch (error) {
                console.error('Error loading provinces:', error);
            }
        }

        function populateProvinces() {
            if (!provinceSelect || provinceSelect.tagName !== 'SELECT') return;
            provinceSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
            provinces.forEach(province => {
                const option = document.createElement('option');
                option.value = province.province_id || province.id || province.code || province.province_code;
                option.textContent = province.province || province.name || province.province_name;
                option.dataset.name = province.province || province.name || province.province_name;
                provinceSelect.appendChild(option);
            });
        }

        async function loadCities(provinceId) {
            if (!citySelect || citySelect.tagName !== 'SELECT') return;

            try {
                citySelect.innerHTML = '<option value="">Memuat...</option>';
                const response = await fetch(`/api/apicoid/cities?province_id=${provinceId}`);
                const data = await response.json();

                if (data.success && data.data) {
                    cities = data.data;
                    populateCities();
                    citySelect.disabled = false;
                } else {
                    citySelect.innerHTML = '<option value="">Gagal memuat kota</option>';
                }
            } catch (error) {
                console.error('Error loading cities:', error);
                citySelect.innerHTML = '<option value="">Error memuat kota</option>';
            }
        }

        function populateCities() {
            if (!citySelect || citySelect.tagName !== 'SELECT') return;
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

        async function loadSubdistricts(cityId) {
            if (!subdistrictSelect || subdistrictSelect.tagName !== 'SELECT') return;

            try {
                subdistrictSelect.innerHTML = '<option value="">Memuat...</option>';
                const response = await fetch(`/api/apicoid/districts?city_id=${cityId}`);
                const data = await response.json();

                if (data.success && data.data) {
                    subdistricts = data.data;
                    populateSubdistricts();
                    subdistrictSelect.disabled = false;
                } else {
                    subdistrictSelect.innerHTML = '<option value="">Gagal memuat kecamatan</option>';
                }
            } catch (error) {
                console.error('Error loading subdistricts:', error);
                subdistrictSelect.innerHTML = '<option value="">Error memuat kecamatan</option>';
            }
        }

        function populateSubdistricts() {
            if (!subdistrictSelect || subdistrictSelect.tagName !== 'SELECT') return;
            subdistrictSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            subdistricts.forEach(subdistrict => {
                const option = document.createElement('option');
                const subdistrictName = subdistrict.district_name || subdistrict.subdistrict_name || subdistrict.name || '';

                option.value = subdistrictName;
                option.textContent = subdistrictName;
                option.dataset.subdistrictId = subdistrict.subdistrict_id || subdistrict.district_id || subdistrict.id || subdistrict.code || subdistrict.district_code;
                subdistrictSelect.appendChild(option);
            });
        }

        async function loadVillages(subdistrictId) {
            if (!villageSelect || villageSelect.tagName !== 'SELECT') return;

            try {
                villageSelect.innerHTML = '<option value="">Memuat...</option>';
                console.log('Loading villages for subdistrict:', subdistrictId);
                const response = await fetch(`/api/apicoid/villages?subdistrict_id=${subdistrictId}`);
                const data = await response.json();
                console.log('Villages API response:', data);

                if (data.success && data.data) {
                    villages = data.data;
                    populateVillages();
                    villageSelect.disabled = false;
                } else {
                    villageSelect.innerHTML = '<option value="">Gagal memuat desa/kelurahan</option>';
                }
            } catch (error) {
                console.error('Error loading villages:', error);
                villageSelect.innerHTML = '<option value="">Error memuat desa/kelurahan</option>';
            }
        }

        function populateVillages() {
            if (!villageSelect || villageSelect.tagName !== 'SELECT') return;
            villageSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
            console.log('Populating villages:', villages);
            villages.forEach(village => {
                const option = document.createElement('option');
                const villageName = village.village_name || village.name || '';
                const villageId = village.village_id || village.id || village.code || village.village_code;

                console.log('Village:', villageName, 'ID:', villageId);
                option.value = villageName;
                option.textContent = villageName;
                option.dataset.villageId = villageId;
                villageSelect.appendChild(option);
            });
        }

        async function loadShippingCost() {
            try {
                console.log('loadShippingCost called');
                console.log('Origin village:', originVillageCode);
                console.log('Destination village:', destinationVillageCode());
                console.log('Weight:', cartWeightKg);

                // Reset and disable all selection dropdowns while loading
                categorySelect.innerHTML = '<option value="">Memuat layanan...</option>';
                categorySelect.disabled = true;
                courierSelect.innerHTML = '<option value="">Pilih Kurir</option>';
                courierSelect.disabled = true;
                if (layananKurirHidden) layananKurirHidden.value = '';
                updatePrice(0);

                const response = await fetch('/api/apicoid/cost', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        origin_village_code: originVillageCode,
                        destination_village_code: destinationVillageCode(),
                        weight: cartWeightKg
                    })
                });

                const data = await response.json();
                console.log('API response:', data);

                // Handle both old and new API response formats
                let services = [];
                if (data.result && Array.isArray(data.result)) {
                    // New format: { status, timestamp, result: [...] }
                    services = data.result;
                } else if (data.data && Array.isArray(data.data)) {
                    // Old format: { success, data: [...] }
                    services = data.data;
                } else if (Array.isArray(data)) {
                    // Direct array format
                    services = data;
                }

                if (services.length > 0) {
                    // Filter to only allowed couriers
                    shippingServices = services.filter(s => allowedCouriers.includes(s.courier_code));
                    
                    console.log('Filtered services:', shippingServices);
                    
                    // Group services by category
                    filteredServices = {
                        'reguler': {},
                        'express': {},
                        'kargo': {}
                    };
                    
                    shippingServices.forEach(service => {
                        const category = courierCategories[service.courier_code];
                        if (category) {
                            if (!filteredServices[category][service.courier_code]) {
                                filteredServices[category][service.courier_code] = [];
                            }
                            filteredServices[category][service.courier_code].push(service);
                        }
                    });
                    
                    console.log('Grouped services:', filteredServices);
                    populateCategories();
                } else {
                    categorySelect.innerHTML = '<option value="">Tidak ada layanan tersedia</option>';
                    console.error('No services found in response');
                }
            } catch (error) {
                console.error('Error loading shipping cost:', error);
                categorySelect.innerHTML = '<option value="">Error memuat layanan</option>';
            }
        }

        function populateCategories() {
            categorySelect.innerHTML = '<option value="">Pilih Kategori</option>';
            
            const categories = ['reguler', 'express', 'kargo'];
            categories.forEach(category => {
                // Only show category if it has couriers
                if (Object.keys(filteredServices[category]).length > 0) {
                    const option = document.createElement('option');
                    option.value = category;
                    const categoryLabel = {
                        'reguler': 'Reguler',
                        'express': 'Express',
                        'kargo': 'Kargo'
                    };
                    option.textContent = categoryLabel[category];
                    categorySelect.appendChild(option);
                }
            });
            
            categorySelect.disabled = false;
        }

        function populateCouriersByCategory() {
            if (!categorySelect.value) {
                courierSelect.innerHTML = '<option value="">Pilih Kurir</option>';
                courierSelect.disabled = true;
                return;
            }
            
            const selectedCategory = categorySelect.value;
            const courierLabels = {
                'JT': 'J&T Express',
                'anteraja': 'AnterAja',
                'JNE': 'JNE Express',
                'JNECargo': 'JNE Cargo',
                'SiCepat': 'SiCepat Express',
                'SiCepatCargo': 'SiCepat Cargo',
                'Ninja': 'Ninja Express'
            };
            
            courierSelect.innerHTML = '<option value="">Pilih Kurir</option>';
            const couriers = Object.keys(filteredServices[selectedCategory] || {});

            couriers.forEach(courier => {
                const services = filteredServices[selectedCategory][courier] || [];

                services.forEach(service => {
                    const option = document.createElement('option');
                    const serviceName = service.courier_name || courierLabels[courier] || courier;
                    const price = service.price || 0;
                    const estimation = service.estimation || '';

                    option.value = courier;
                    option.textContent = `${serviceName} - Rp ${price.toLocaleString('id-ID')}${estimation ? ' (' + estimation + ')' : ''}`;
                    option.dataset.cost = price;
                    option.dataset.etd = estimation;
                    option.dataset.serviceName = serviceName;
                    courierSelect.appendChild(option);
                });
            });

            courierSelect.disabled = couriers.length === 0;
        }

        function resetCourier() {
            if (!courierSelect) return;
            courierSelect.value = '';
            courierSelect.innerHTML = '<option value="">Pilih Kurir</option>';
            courierSelect.disabled = true;
            if (layananKurirHidden) layananKurirHidden.value = '';
            updatePrice(0);
            shippingInfo.classList.add('hidden');
        }

        function resetCategory() {
            if (!categorySelect) return;
            categorySelect.value = '';
            categorySelect.innerHTML = '<option value="">Pilih Kategori</option>';
            categorySelect.disabled = true;
            resetCourier();
        }

        function updatePrice(cost) {
            ongkirInput.value = cost;
            ongkirDisplay.textContent = 'Rp ' + cost.toLocaleString('id-ID');

            const total = subtotal + cost;
            totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (selectedAddressSelect) {
                selectedAddressSelect.addEventListener('change', async function() {
                    applySelectedAddress();
                    // Load shipping services for the selected address
                    const villageCode = destinationVillageCode();
                    if (villageCode) {
                        await loadShippingCost();
                    }
                });
                
                // Initial setup if address is already selected
                const initialVillageCode = destinationVillageCode();
                if (initialVillageCode) {
                    loadShippingCost();
                }
            }

            if (provinceSelect && provinceSelect.tagName === 'SELECT') {
                provinceSelect.addEventListener('change', async function() {
                    const selectedOption = this.options[this.selectedIndex];
                    if (provinceHidden) provinceHidden.value = selectedOption?.dataset.name || '';

                    if (citySelect && citySelect.tagName === 'SELECT') {
                        citySelect.innerHTML = '<option value="">Pilih Kota</option>';
                        citySelect.disabled = true;
                    }

                    if (subdistrictSelect && subdistrictSelect.tagName === 'SELECT') {
                        subdistrictSelect.innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                        subdistrictSelect.disabled = true;
                    }

                    if (villageSelect && villageSelect.tagName === 'SELECT') {
                        villageSelect.innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                        villageSelect.disabled = true;
                    }

                    if (kabupatenHidden) kabupatenHidden.value = '';
                    resetCategory();

                    if (this.value) {
                        await loadCities(this.value);
                    }
                });

                loadProvinces();
            }

            if (citySelect && citySelect.tagName === 'SELECT') {
                citySelect.addEventListener('change', async function() {
                    const selectedOption = this.options[this.selectedIndex];
                    if (kabupatenHidden) kabupatenHidden.value = selectedOption?.dataset.name || '';

                    if (subdistrictSelect && subdistrictSelect.tagName === 'SELECT') {
                        subdistrictSelect.innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                        subdistrictSelect.disabled = true;
                    }

                    if (villageSelect && villageSelect.tagName === 'SELECT') {
                        villageSelect.innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                        villageSelect.disabled = true;
                    }

                    resetCategory();

                    if (this.value && !hasSavedAddressMode) {
                        await loadSubdistricts(this.value);
                    }
                });
            }

            if (subdistrictSelect && subdistrictSelect.tagName === 'SELECT') {
                subdistrictSelect.addEventListener('change', async function() {
                    if (villageSelect && villageSelect.tagName === 'SELECT') {
                        villageSelect.innerHTML = '<option value="">Pilih desa/kelurahan</option>';
                        villageSelect.disabled = true;
                    }

                    resetCategory();

                    const selectedOption = this.options[this.selectedIndex];
                    const subdistrictId = selectedOption?.dataset.subdistrictId || '';
                    if (subdistrictId) {
                        await loadVillages(subdistrictId);
                    }
                });
            }

            if (villageSelect && villageSelect.tagName === 'SELECT') {
                villageSelect.addEventListener('change', async function() {
                    const villageCode = destinationVillageCode();
                    console.log('=== VILLAGE CHANGED ===');
                    console.log('Village value:', this.value);
                    console.log('Village code:', villageCode);
                    
                    resetCategory();
                    
                    if (villageCode) {
                        await loadShippingCost();
                    }
                });
            }

            if (courierSelect) {
                courierSelect.addEventListener('change', function() {
                    console.log('Courier changed:', this.value);
                    const selectedOption = this.options[this.selectedIndex];
                    const cost = parseInt(selectedOption?.dataset.cost || '0', 10) || 0;
                    const etd = selectedOption?.dataset.etd || '';
                    const serviceName = selectedOption?.dataset.serviceName || '';

                    if (layananKurirHidden) {
                        layananKurirHidden.value = serviceName;
                    }

                    updatePrice(cost);
                    if (cost > 0) {
                        shippingDetails.textContent = `Estimasi ${etd}`;
                        shippingInfo.classList.remove('hidden');
                    } else {
                        shippingInfo.classList.add('hidden');
                    }
                });
            }

            if (categorySelect) {
                categorySelect.addEventListener('change', function() {
                    console.log('Category changed:', this.value);
                    populateCouriersByCategory();
                    if (layananKurirHidden) layananKurirHidden.value = '';
                    updatePrice(0);
                    shippingInfo.classList.add('hidden');
                });
            }

            if (hasSavedAddressMode && categorySelect) {
                categorySelect.disabled = !destinationVillageCode();
            }
        });
    </script>
@endsection
