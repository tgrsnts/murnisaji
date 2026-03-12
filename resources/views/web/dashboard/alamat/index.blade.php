@extends('web.dashboard.layout.main')

@php($title = 'Alamat')

@section('content')
        <div class="space-y-6">
            <!-- Header with Add Button -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Alamat Saya</h1>
                        <p class="text-gray-600 mt-1">Daftar alamat yang tersimpan pada akun Anda</p>
                    </div>
                    <button onclick="openAddModal()" class="bg-[#7A1F1F] hover:bg-[#5a1515] text-white px-6 py-3 rounded-lg font-semibold transition-all shadow-md hover:shadow-lg">
                        <i class="fas fa-plus mr-2"></i>Tambah Alamat
                    </button>
                </div>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Address List -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">
                @if ($addresses->count())
                    <div class="space-y-4">
                        @foreach ($addresses as $alamat)
                            <div class="border border-gray-200 rounded-xl p-4 hover:border-[#7A1F1F] transition-colors">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <p class="font-semibold text-gray-900">{{ $alamat->label_alamat }}</p>
                                            @if ($alamat->isPrimary)
                                                <span class="text-xs font-semibold bg-[#7A1F1F] text-white px-2 py-1 rounded-full">Utama</span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-700 mt-2">{{ $alamat->nama_penerima }} - {{ $alamat->no_telepon }}</p>
                                        <p class="text-sm text-gray-600 mt-1">{{ $alamat->detail }}, @if($alamat->desa){{ $alamat->desa }}, @endif{{ $alamat->kecamatan }}, {{ $alamat->kabupaten }}, {{ $alamat->provinsi }} {{ $alamat->kodepos }}</p>
                                    </div>
                                    <div class="flex gap-2">
                                        <button onclick="openEditModal({{ $alamat->alamat_id }}, '{{ addslashes($alamat->label_alamat) }}', '{{ addslashes($alamat->nama_penerima) }}', '{{ $alamat->no_telepon }}', '{{ addslashes($alamat->provinsi) }}', '{{ addslashes($alamat->kabupaten) }}', '{{ addslashes($alamat->kecamatan) }}', '{{ addslashes($alamat->desa ?? '') }}', '{{ addslashes($alamat->detail) }}', '{{ $alamat->kodepos }}', {{ $alamat->isPrimary ? 'true' : 'false' }})" class="text-blue-600 hover:text-blue-800 px-3 py-2 rounded-lg hover:bg-blue-50 transition-all">                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="confirmDelete({{ $alamat->alamat_id }})" class="text-red-600 hover:text-red-800 px-3 py-2 rounded-lg hover:bg-red-50 transition-all">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-map-marker-alt text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-600 text-lg">Belum ada alamat tersimpan.</p>
                        <p class="text-gray-500 text-sm mt-2">Klik tombol "Tambah Alamat" untuk menambahkan alamat baru.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Add Address Modal -->
        <div id="addModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50" onclick="closeModalOnOutsideClick(event, 'addModal')">
            <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
                <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 rounded-t-2xl">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-900">Tambah Alamat Baru</h2>
                        <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <form action="{{ route('dashboard.addresses.store') }}" method="POST" class="p-6">
                    @csrf
                    <input type="hidden" name="province_id" id="add_province_id">
                    <input type="hidden" name="city_id" id="add_city_id">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Label Alamat <span class="text-red-500">*</span></label>
                            <input type="text" name="label_alamat" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent" placeholder="Rumah / Kantor / Apartemen">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Penerima <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_penerima" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">No. Telepon <span class="text-red-500">*</span></label>
                            <input type="text" name="no_telepon" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Provinsi <span class="text-red-500">*</span></label>
                            <select id="add_provinsi" name="provinsi" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent">
                                <option value="">Pilih Provinsi</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kabupaten/Kota <span class="text-red-500">*</span></label>
                            <select id="add_kabupaten" name="kabupaten" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent" disabled>
                                <option value="">Pilih provinsi terlebih dahulu</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kecamatan <span class="text-red-500">*</span></label>
                            <select id="add_kecamatan" name="kecamatan" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent" disabled>
                                <option value="">Pilih kabupaten terlebih dahulu</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Desa/Kelurahan</label>
                            <select id="add_desa" name="desa" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent" disabled>
                                <option value="">Pilih kecamatan terlebih dahulu</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Pos <span class="text-red-500">*</span></label>
                            <input type="text" id="add_kodepos" name="kodepos" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent" placeholder="Contoh: 12345">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Detail Alamat <span class="text-red-500">*</span></label>
                            <textarea name="detail" required rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent" placeholder="Nama jalan, nomor rumah, patokan"></textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="isPrimary" value="1" class="w-4 h-4 text-[#7A1F1F] focus:ring-[#7A1F1F] border-gray-300 rounded">
                                <span class="ml-2 text-sm text-gray-700">Jadikan alamat utama</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <button type="button" onclick="closeAddModal()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold transition-all">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 bg-[#7A1F1F] hover:bg-[#5a1515] text-white px-6 py-3 rounded-lg font-semibold transition-all shadow-md hover:shadow-lg">
                            Simpan Alamat
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Address Modal -->
        <div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50" onclick="closeModalOnOutsideClick(event, 'editModal')">
            <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
                <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 rounded-t-2xl">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-900">Edit Alamat</h2>
                        <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <form id="editForm" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="province_id" id="edit_province_id">
                    <input type="hidden" name="city_id" id="edit_city_id">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Label Alamat <span class="text-red-500">*</span></label>
                            <input type="text" name="label_alamat" id="edit_label_alamat" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Penerima <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_penerima" id="edit_nama_penerima" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">No. Telepon <span class="text-red-500">*</span></label>
                            <input type="text" name="no_telepon" id="edit_no_telepon" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Provinsi <span class="text-red-500">*</span></label>
                            <select id="edit_provinsi" name="provinsi" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent">
                                <option value="">Pilih Provinsi</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kabupaten/Kota <span class="text-red-500">*</span></label>
                            <select id="edit_kabupaten" name="kabupaten" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent" disabled>
                                <option value="">Pilih provinsi terlebih dahulu</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kecamatan <span class="text-red-500">*</span></label>
                            <select id="edit_kecamatan" name="kecamatan" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent" disabled>
                                <option value="">Pilih kabupaten terlebih dahulu</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Desa/Kelurahan</label>
                            <select id="edit_desa" name="desa" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent" disabled>
                                <option value="">Pilih kecamatan terlebih dahulu</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Pos <span class="text-red-500">*</span></label>
                            <input type="text" id="edit_kodepos" name="kodepos" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent" placeholder="Contoh: 12345">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Detail Alamat <span class="text-red-500">*</span></label>
                            <textarea name="detail" id="edit_detail" required rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#7A1F1F] focus:border-transparent"></textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="isPrimary" id="edit_isPrimary" value="1" class="w-4 h-4 text-[#7A1F1F] focus:ring-[#7A1F1F] border-gray-300 rounded">
                                <span class="ml-2 text-sm text-gray-700">Jadikan alamat utama</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <button type="button" onclick="closeEditModal()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold transition-all">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 bg-[#7A1F1F] hover:bg-[#5a1515] text-white px-6 py-3 rounded-lg font-semibold transition-all shadow-md hover:shadow-lg">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50" onclick="closeModalOnOutsideClick(event, 'deleteModal')">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-6" onclick="event.stopPropagation()">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                        <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus Alamat</h3>
                    <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus alamat ini? Tindakan ini tidak dapat dibatalkan.</p>
                    
                    <form id="deleteForm" method="POST" class="flex gap-3">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="closeDeleteModal()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold transition-all">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition-all">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            let provinces = [];
            let addCitiesCache = {};
            let editCitiesCache = {};
            let addSubdistrictsCache = {};
            let editSubdistrictsCache = {};
            let addVillagesCache = {};
            let editVillagesCache = {};

            // Fetch provinces on page load
            async function loadProvinces() {
                try {
                    const response = await fetch('/api/apicoid/provinces');
                    const data = await response.json();
                    
                    if (!response.ok) {
                        console.error('Error loading provinces:', data);
                        alert('Error loading provinces: ' + (data.message || data.error || 'Unknown error'));
                        return;
                    }
                    
                    provinces = data.data;
                    console.log('Provinces loaded:', provinces.length > 0 ? provinces[0] : 'No data');
                } catch (error) {
                    console.error('Error loading provinces:', error);
                    alert('Error loading provinces: ' + error.message);
                }
            }

            // Populate province dropdown
            function populateProvinces(selectId) {
                const select = document.getElementById(selectId);
                select.innerHTML = '<option value="">Pilih Provinsi</option>';
                provinces.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.name;
                    option.textContent = province.name;
                    // API.co.id uses 'code' field for province ID
                    option.dataset.provinceId = province.code || province.id || province.province_id;
                    select.appendChild(option);
                });
            }

            // Fetch cities for a province
            async function loadCities(provinceId, selectId, cache) {
                if (cache[provinceId]) {
                    populateCities(cache[provinceId], selectId);
                    return cache[provinceId];
                }

                try {
                    const response = await fetch(`/api/apicoid/cities?province_id=${provinceId}`);
                    const data = await response.json();
                    cache[provinceId] = data.data;
                    populateCities(data.data, selectId);
                    return data.data;
                } catch (error) {
                    console.error('Error loading cities:', error);
                    return [];
                }
            }

            // Populate city dropdown
            function populateCities(cities, selectId) {
                const select = document.getElementById(selectId);
                select.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.name;
                    option.textContent = city.name;
                    // API.co.id uses 'code' field for city ID
                    option.dataset.cityId = city.code || city.id || city.city_id;
                    select.appendChild(option);
                });
                select.disabled = false;
            }

            // Fetch subdistricts for a city
            async function loadSubdistricts(cityId, selectId, cache) {
                if (cache[cityId]) {
                    populateSubdistricts(cache[cityId], selectId);
                    return cache[cityId];
                }

                try {
                    const response = await fetch(`/api/apicoid/districts?city_id=${cityId}`);
                    const data = await response.json();
                    cache[cityId] = data.data;
                    populateSubdistricts(data.data, selectId);
                    return data.data;
                } catch (error) {
                    console.error('Error loading subdistricts:', error);
                    return [];
                }
            }

            // Populate subdistrict dropdown
            function populateSubdistricts(subdistricts, selectId) {
                const select = document.getElementById(selectId);
                select.innerHTML = '<option value="">Pilih Kecamatan</option>';
                subdistricts.forEach(subdistrict => {
                    const option = document.createElement('option');
                    option.value = subdistrict.name;
                    option.textContent = subdistrict.name;
                    // API.co.id uses 'code' field for subdistrict ID
                    option.dataset.subdistrictId = subdistrict.code || subdistrict.id || subdistrict.subdistrict_id;
                    select.appendChild(option);
                });
                select.disabled = false;
            }

            // Fetch villages for a subdistrict
            async function loadVillages(subdistrictId, selectId, cache) {
                if (cache[subdistrictId]) {
                    populateVillages(cache[subdistrictId], selectId);
                    return cache[subdistrictId];
                }

                try {
                    const response = await fetch(`/api/apicoid/villages?subdistrict_id=${subdistrictId}`);
                    const data = await response.json();
                    cache[subdistrictId] = data.data;
                    populateVillages(data.data, selectId);
                    return data.data;
                } catch (error) {
                    console.error('Error loading villages:', error);
                    return [];
                }
            }

            // Populate village dropdown
            function populateVillages(villages, selectId) {
                const select = document.getElementById(selectId);
                select.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                villages.forEach(village => {
                    const option = document.createElement('option');
                    option.value = village.name;
                    option.textContent = village.name;
                    select.appendChild(option);
                });
                select.disabled = false;
            }

            // Add Modal Functions
            function openAddModal() {
                document.getElementById('addModal').classList.remove('hidden');
                document.getElementById('addModal').classList.add('flex');
                document.body.style.overflow = 'hidden';
                
                // Populate provinces
                populateProvinces('add_provinsi');
            }

            function closeAddModal() {
                document.getElementById('addModal').classList.add('hidden');
                document.getElementById('addModal').classList.remove('flex');
                document.body.style.overflow = 'auto';
                
                // Reset form
                document.querySelector('#addModal form').reset();
                document.getElementById('add_kabupaten').disabled = true;
                document.getElementById('add_kabupaten').innerHTML = '<option value="">Pilih provinsi terlebih dahulu</option>';
                document.getElementById('add_kecamatan').disabled = true;
                document.getElementById('add_kecamatan').innerHTML = '<option value="">Pilih kabupaten terlebih dahulu</option>';
                document.getElementById('add_desa').disabled = true;
                document.getElementById('add_desa').innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
            }

            // Edit Modal Functions
            async function openEditModal(id, label, nama, telepon, provinsi, kabupaten, kecamatan, desa, detail, kodepos, isPrimary) {
                document.getElementById('edit_label_alamat').value = label;
                document.getElementById('edit_nama_penerima').value = nama;
                document.getElementById('edit_no_telepon').value = telepon;
                document.getElementById('edit_detail').value = detail;
                document.getElementById('edit_kodepos').value = kodepos;
                document.getElementById('edit_isPrimary').checked = isPrimary;
                
                // Populate provinces
                populateProvinces('edit_provinsi');
                
                // Wait a bit for provinces to populate, then set selected province
                setTimeout(async () => {
                    const provinsiSelect = document.getElementById('edit_provinsi');
                    
                    // Find and select the matching province
                    for (let option of provinsiSelect.options) {
                        if (option.value === provinsi) {
                            option.selected = true;
                            const provinceId = option.dataset.provinceId;
                            
                            // Set hidden province_id field
                            document.getElementById('edit_province_id').value = provinceId || '';
                            
                            // Load cities for this province
                            const cities = await loadCities(provinceId, 'edit_kabupaten', editCitiesCache);
                            
                            // Set selected city
                            setTimeout(async () => {
                                const kabupatenSelect = document.getElementById('edit_kabupaten');
                                for (let cityOption of kabupatenSelect.options) {
                                    if (cityOption.value === kabupaten) {
                                        cityOption.selected = true;
                                        const cityId = cityOption.dataset.cityId;
                                        
                                        // Set hidden city_id field
                                        document.getElementById('edit_city_id').value = cityId || '';
                                        
                                        // Load subdistricts for this city
                                        const subdistricts = await loadSubdistricts(cityId, 'edit_kecamatan', editSubdistrictsCache);
                                        
                                        // Set selected subdistrict
                                        setTimeout(async () => {
                                            const kecamatanSelect = document.getElementById('edit_kecamatan');
                                            for (let subdistrictOption of kecamatanSelect.options) {
                                                if (subdistrictOption.value === kecamatan) {
                                                    subdistrictOption.selected = true;
                                                    const subdistrictId = subdistrictOption.dataset.subdistrictId;
                                                    
                                                    // Load villages for this subdistrict
                                                    await loadVillages(subdistrictId, 'edit_desa', editVillagesCache);
                                                    
                                                    // Set selected village
                                                    setTimeout(() => {
                                                        const desaSelect = document.getElementById('edit_desa');
                                                        for (let villageOption of desaSelect.options) {
                                                            if (villageOption.value === desa) {
                                                                villageOption.selected = true;
                                                                break;
                                                            }
                                                        }
                                                    }, 100);
                                                    break;
                                                }
                                            }
                                        }, 100);
                                        break;
                                    }
                                }
                            }, 100);
                            break;
                        }
                    }
                }, 100);
                
                document.getElementById('editForm').action = `/dashboard/addresses/${id}`;
                
                document.getElementById('editModal').classList.remove('hidden');
                document.getElementById('editModal').classList.add('flex');
                document.body.style.overflow = 'hidden';
            }

            function closeEditModal() {
                document.getElementById('editModal').classList.add('hidden');
                document.getElementById('editModal').classList.remove('flex');
                document.body.style.overflow = 'auto';
                
                // Reset form
                document.getElementById('edit_kabupaten').disabled = true;
                document.getElementById('edit_kabupaten').innerHTML = '<option value="">Pilih provinsi terlebih dahulu</option>';
                document.getElementById('edit_kecamatan').disabled = true;
                document.getElementById('edit_kecamatan').innerHTML = '<option value="">Pilih kabupaten terlebih dahulu</option>';
                document.getElementById('edit_desa').disabled = true;
                document.getElementById('edit_desa').innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
            }

            // Delete Modal Functions
            function confirmDelete(id) {
                document.getElementById('deleteForm').action = `/dashboard/addresses/${id}`;
                document.getElementById('deleteModal').classList.remove('hidden');
                document.getElementById('deleteModal').classList.add('flex');
                document.body.style.overflow = 'hidden';
            }

            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
                document.getElementById('deleteModal').classList.remove('flex');
                document.body.style.overflow = 'auto';
            }

            // Close modal when clicking outside
            function closeModalOnOutsideClick(event, modalId) {
                if (event.target.id === modalId) {
                    if (modalId === 'addModal') closeAddModal();
                    if (modalId === 'editModal') closeEditModal();
                    if (modalId === 'deleteModal') closeDeleteModal();
                }
            }

            // Close modals on ESC key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeAddModal();
                    closeEditModal();
                    closeDeleteModal();
                }
            });

            // Province change listeners
            document.addEventListener('DOMContentLoaded', function() {
                // Load provinces on page load
                loadProvinces();

                // Add modal province change
                document.getElementById('add_provinsi').addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const provinceId = selectedOption.dataset.provinceId;
                    
                    console.log('Province selected:', {
                        name: selectedOption.value,
                        provinceId: provinceId
                    });
                    
                    // Set hidden province_id field
                    document.getElementById('add_province_id').value = provinceId || '';
                    
                    if (provinceId) {
                        loadCities(provinceId, 'add_kabupaten', addCitiesCache);
                        // Reset dependent dropdowns
                        document.getElementById('add_kecamatan').disabled = true;
                        document.getElementById('add_kecamatan').innerHTML = '<option value="">Pilih kabupaten terlebih dahulu</option>';
                        document.getElementById('add_desa').disabled = true;
                        document.getElementById('add_desa').innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                    } else {
                        document.getElementById('add_kabupaten').disabled = true;
                        document.getElementById('add_kabupaten').innerHTML = '<option value="">Pilih provinsi terlebih dahulu</option>';
                        document.getElementById('add_kecamatan').disabled = true;
                        document.getElementById('add_kecamatan').innerHTML = '<option value="">Pilih kabupaten terlebih dahulu</option>';
                        document.getElementById('add_desa').disabled = true;
                        document.getElementById('add_desa').innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                    }
                });

                // Add modal city change
                document.getElementById('add_kabupaten').addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const cityId = selectedOption.dataset.cityId;
                    
                    // Set hidden city_id field
                    document.getElementById('add_city_id').value = cityId || '';
                    
                    if (cityId) {
                        loadSubdistricts(cityId, 'add_kecamatan', addSubdistrictsCache);
                        // Reset village dropdown
                        document.getElementById('add_desa').disabled = true;
                        document.getElementById('add_desa').innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                    } else {
                        document.getElementById('add_kecamatan').disabled = true;
                        document.getElementById('add_kecamatan').innerHTML = '<option value="">Pilih kabupaten terlebih dahulu</option>';
                        document.getElementById('add_desa').disabled = true;
                        document.getElementById('add_desa').innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                    }
                });

                // Add modal subdistrict change
                document.getElementById('add_kecamatan').addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const subdistrictId = selectedOption.dataset.subdistrictId;
                    
                    if (subdistrictId) {
                        loadVillages(subdistrictId, 'add_desa', addVillagesCache);
                    } else {
                        document.getElementById('add_desa').disabled = true;
                        document.getElementById('add_desa').innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                    }
                });

                // Edit modal province change
                document.getElementById('edit_provinsi').addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const provinceId = selectedOption.dataset.provinceId;
                    
                    // Set hidden province_id field
                    document.getElementById('edit_province_id').value = provinceId || '';
                    
                    if (provinceId) {
                        loadCities(provinceId, 'edit_kabupaten', editCitiesCache);
                        // Reset dependent dropdowns
                        document.getElementById('edit_kecamatan').disabled = true;
                        document.getElementById('edit_kecamatan').innerHTML = '<option value="">Pilih kabupaten terlebih dahulu</option>';
                        document.getElementById('edit_desa').disabled = true;
                        document.getElementById('edit_desa').innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                    } else {
                        document.getElementById('edit_kabupaten').disabled = true;
                        document.getElementById('edit_kabupaten').innerHTML = '<option value="">Pilih provinsi terlebih dahulu</option>';
                        document.getElementById('edit_kecamatan').disabled = true;
                        document.getElementById('edit_kecamatan').innerHTML = '<option value="">Pilih kabupaten terlebih dahulu</option>';
                        document.getElementById('edit_desa').disabled = true;
                        document.getElementById('edit_desa').innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                    }
                });

                // Edit modal city change
                document.getElementById('edit_kabupaten').addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const cityId = selectedOption.dataset.cityId;
                    
                    // Set hidden city_id field
                    document.getElementById('edit_city_id').value = cityId || '';
                    
                    if (cityId) {
                        loadSubdistricts(cityId, 'edit_kecamatan', editSubdistrictsCache);
                        // Reset village dropdown
                        document.getElementById('edit_desa').disabled = true;
                        document.getElementById('edit_desa').innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                    } else {
                        document.getElementById('edit_kecamatan').disabled = true;
                        document.getElementById('edit_kecamatan').innerHTML = '<option value="">Pilih kabupaten terlebih dahulu</option>';
                        document.getElementById('edit_desa').disabled = true;
                        document.getElementById('edit_desa').innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                    }
                });

                // Edit modal subdistrict change
                document.getElementById('edit_kecamatan').addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const subdistrictId = selectedOption.dataset.subdistrictId;
                    
                    if (subdistrictId) {
                        loadVillages(subdistrictId, 'edit_desa', editVillagesCache);
                    } else {
                        document.getElementById('edit_desa').disabled = true;
                        document.getElementById('edit_desa').innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                    }
                });
            });
        </script>
@endsection
