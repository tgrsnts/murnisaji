@extends('web.dashboard.layout.main')

@php($title = 'Tambah Ulasan')

@section('content')
    <div class="space-y-6">
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
            <h1 class="text-3xl font-bold text-gray-900">Tambah Ulasan</h1>
            <p class="text-gray-600 mt-1">Transaksi #{{ $data->transaksi_item_id }}</p>
        </div>

        @if (session('success'))
            <div class="p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-8">
            <form method="POST" action="{{ route('dashboard.reviews.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Hidden: transaksi_item_id --}}
                <input type="hidden" name="id_transaksi_item" value="{{ $data->transaksi_item_id }}">

                {{-- Info Produk (readonly) --}}
                <div class="flex gap-4">
                    <img src="/storage/{{ $data->produk->gambar }}" class="w-16" alt="">
                    <div>
                        <p class="font-semibold text-gray-900">{{ $data->produk->nama_produk ?? 'Produk' }}</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>

                    <div id="star-container" class="flex space-x-1 cursor-pointer text-2xl">
                        @for ($i = 1; $i <= 5; $i++)
                            <span data-value="{{ $i }}" class="star text-gray-300">★</span>
                        @endfor
                    </div>

                    {{-- hidden input buat dikirim ke backend --}}
                    <input type="hidden" name="rating" id="rating-value" value="{{ old('rating') }}">

                    @error('rating')
                        <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <script>
                    const stars = document.querySelectorAll('.star');
                    const ratingInput = document.getElementById('rating-value');

                    stars.forEach((star, index) => {
                        star.addEventListener('click', () => {
                            let value = index + 1;
                            ratingInput.value = value;

                            stars.forEach((s, i) => {
                                s.classList.toggle('text-yellow-400', i < value);
                                s.classList.toggle('text-gray-300', i >= value);
                            });
                        });
                    });
                </script>

                <div class="mb-6">
                    <label class="block text-red-800 font-medium mb-2">Foto</label>
                    <div class="border-2 border-dashed border-[#D4AF5A] rounded-lg p-8 text-center">
                        <input type="file" id="fileInput" name="gambar" accept="image/*" class="hidden">

                        <button type="button" id="triggerFile" class="bg-red-800 text-white px-4 py-2 rounded-lg mb-3">
                            Tambahkan File
                        </button>

                        <div id="previewWrapper" class="mt-4 hidden">
                            <img id="previewImage" src="" alt="Preview"
                                class="w-40 h-40 object-cover mx-auto rounded-lg">

                            <button type="button" id="removeImage" class="mt-2 text-red-800 hover:text-red-900">
                                Hapus Foto
                            </button>
                        </div>
                    </div>
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

                {{-- Komentar --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ulasan</label>
                    <textarea name="comment" rows="4" required
                        class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:outline-none focus:border-red-500"
                        placeholder="Tulis pengalaman kamu...">{{ old('comment') }}</textarea>
                    @error('comment')
                        <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="pt-4 border-t border-gray-200">
                    <button type="submit"
                        class="bg-[#7A1F1F] text-white px-6 py-2 rounded-lg hover:bg-[#5A0F0F] transition font-medium">
                        Kirim Ulasan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
