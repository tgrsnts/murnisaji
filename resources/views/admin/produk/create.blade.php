@extends('admin.layout.main')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-red-800 mb-6">Tambah Produk</h2>

        @if (session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.produk.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label class="block text-red-800 font-medium mb-2">Nama Produk*</label>
                <input type="text" name="nama_produk" value="{{ old('nama_produk') }}"
                    placeholder="Abon Sapi Pedas" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg" required>
            </div>

            <div class="mb-6">
                <label class="block text-red-800 font-medium mb-2">Kategori*</label>
                <select name="kategori" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg" required>
                    @php
                        $selectedKategori = old('kategori', 'Abon Sapi');
                        $kategoriList = [
                            'Abon Sapi',
                            'Abon Ayam',
                            'Abon Ikan',
                            'Abon Kambing',
                        ];
                    @endphp

                    @foreach ($kategoriList as $kategori)
                        <option value="{{ $kategori }}" {{ $selectedKategori == $kategori ? 'selected' : '' }}>
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-red-800 font-medium mb-2">Deskripsi*</label>
                <textarea name="deskripsi" placeholder="Abon sapi berkualitas tinggi dengan rasa pedas yang nikmat........."
                    class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg h-32" required>{{ old('deskripsi') }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-red-800 font-medium mb-2">Harga*</label>
                <input type="number" name="harga" value="{{ old('harga') }}" placeholder="50000"
                    class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg" required>
                <p class="text-gray-500 text-xs mt-1">Masukkan harga tanpa 'Rp.'</p>
            </div>

            <div class="mb-6">
                <label class="block text-red-800 font-medium mb-2">Stok*</label>
                <input type="number" name="stok" value="{{ old('stok', 0) }}" placeholder="100"
                    class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg" required>
            </div>

            <div class="mb-6">
                <label class="block text-red-800 font-medium mb-2">Berat (gram)*</label>
                <input type="number" name="berat_gram" value="{{ old('berat_gram') }}"
                    placeholder="250" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg" required>
            </div>

            <div class="mb-6">
                <label class="block text-red-800 font-medium mb-2">Foto</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                    <input type="file" id="fileInput" name="gambar" accept="image/*" class="hidden">

                    <button type="button" id="triggerFile" class="bg-red-800 text-white px-4 py-2 rounded-lg mb-3">
                        Tambahkan File
                    </button>

                    <p class="text-gray-500 text-sm">Atau pilih file dari perangkat</p>

                    <div id="previewWrapper" class="mt-4 hidden">
                        <img id="previewImage" src="" alt="Preview"
                            class="w-40 h-40 object-cover mx-auto rounded-lg">

                        <button type="button" id="removeImage" class="mt-2 text-red-800 hover:text-red-900">
                            Hapus Foto
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('admin.produk.index') }}"
                    class="px-8 py-2 border border-red-800 text-red-800 rounded-lg">
                    KEMBALI
                </a>

                <button type="submit" class="px-8 py-2 bg-red-800 text-white rounded-lg">
                    SIMPAN
                </button>
            </div>
        </form>
    </div>

    <script>
        const fileInput = document.getElementById('fileInput');
        const triggerFile = document.getElementById('triggerFile');
        const previewImage = document.getElementById('previewImage');
        const previewWrapper = document.getElementById('previewWrapper');
        const removeImage = document.getElementById('removeImage');

        triggerFile.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewWrapper.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        removeImage.addEventListener('click', () => {
            fileInput.value = '';
            previewImage.src = '';
            previewWrapper.classList.add('hidden');
        });
    </script>
@endsection
