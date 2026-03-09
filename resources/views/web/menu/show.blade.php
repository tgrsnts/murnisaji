@extends('web.layouts.app')

@section('content')
    <section class="bg-white px-20 py-12">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <a href="{{ route('menu.index') }}" class="text-gray-500 hover:text-[#7A1F1F]">Menu</a>
                <span class="text-gray-400 mx-2">/</span>
                <span class="text-gray-800">{{ $produk->nama_produk }}</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Product Image -->
                <div class="bg-gray-100 rounded-lg p-8 flex items-center justify-center">
                    @if ($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                            class="w-full h-auto object-contain max-h-96">
                    @else
                        <img src="/images/Abon Sapi.png" alt="{{ $produk->nama_produk }}"
                            class="w-full h-auto object-contain max-h-96">
                    @endif
                </div>

                <!-- Product Info -->
                <div class="flex flex-col gap-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $produk->nama_produk }}</h1>
                        <p class="text-sm text-gray-500">Kategori: {{ $produk->kategori }}</p>
                    </div>

                    <!-- Rating -->
                    <div class="flex items-center gap-2">
                        <div class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($produk->average_rating))
                                    <i class="fas fa-star text-yellow-400"></i>
                                @elseif($i - 0.5 <= $produk->average_rating)
                                    <i class="fas fa-star-half-alt text-yellow-400"></i>
                                @else
                                    <i class="far fa-star text-gray-300"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="text-gray-700 font-semibold">{{ number_format($produk->average_rating, 1) }}</span>
                        <span class="text-gray-500 text-sm">({{ $produk->total_reviews }} reviews)</span>
                    </div>

                    <!-- Price -->
                    <div class="border-t border-b py-4">
                        <p class="text-4xl font-bold text-[#7A1F1F]">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    </div>

                    <!-- Product Details -->
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-weight text-gray-400"></i>
                            <span class="text-gray-700">Berat: <strong>{{ $produk->berat_gram }}g</strong></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-box text-gray-400"></i>
                            <span class="text-gray-700">Stok: <strong>{{ $produk->stok }}</strong></span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <h3 class="font-bold text-gray-900 mb-2">Deskripsi Produk</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $produk->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                    </div>

                    <!-- Add to Cart Form -->
                    @if (session('success'))
                        <div class="p-4 bg-green-100 text-green-800 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="p-4 bg-red-100 text-red-800 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('cart.add') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="produk_id" value="{{ $produk->produk_id }}">
                        
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Jumlah</label>
                            <div class="flex items-center gap-3">
                                <button type="button" onclick="decreaseQty()" class="w-10 h-10 border border-gray-300 rounded-lg hover:bg-gray-100">
                                    <i class="fas fa-minus text-gray-600"></i>
                                </button>
                                <input type="number" name="qty" id="qty" value="1" min="1" max="{{ $produk->stok }}"
                                    class="w-20 text-center border border-gray-300 rounded-lg py-2 font-semibold">
                                <button type="button" onclick="increaseQty()" class="w-10 h-10 border border-gray-300 rounded-lg hover:bg-gray-100">
                                    <i class="fas fa-plus text-gray-600"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <button type="submit" 
                                class="flex-1 bg-[#7A1F1F] text-white py-3 rounded-lg font-semibold hover:bg-[#5A0F0F] transition flex items-center justify-center gap-2"
                                @if($produk->stok == 0) disabled @endif>
                                <i class="fas fa-shopping-cart"></i>
                                @if($produk->stok == 0)
                                    Stok Habis
                                @else
                                    Tambah ke Keranjang
                                @endif
                            </button>
                            <a href="{{ route('menu.index') }}" 
                                class="px-6 py-3 border-2 border-[#7A1F1F] text-[#7A1F1F] rounded-lg font-semibold hover:bg-[#7A1F1F] hover:text-white transition">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="mt-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Ulasan Pelanggan</h2>
                    <div class="flex items-center gap-2">
                        <div class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($produk->average_rating))
                                    <i class="fas fa-star text-yellow-400 text-lg"></i>
                                @elseif($i - 0.5 <= $produk->average_rating)
                                    <i class="fas fa-star-half-alt text-yellow-400 text-lg"></i>
                                @else
                                    <i class="far fa-star text-gray-300 text-lg"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="text-xl font-bold text-gray-900">{{ number_format($produk->average_rating, 1) }}</span>
                        <span class="text-gray-500">({{ $produk->total_reviews }} ulasan)</span>
                    </div>
                </div>

                @if ($reviews->count() > 0)
                    <div class="space-y-6">
                        @foreach ($reviews as $review)
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <div class="flex items-start gap-4">
                                    <!-- User Avatar -->
                                    <div class="shrink-0">
                                        @if ($review['user']->gambar)
                                            <img src="{{ asset('storage/' . $review['user']->gambar) }}"
                                                alt="{{ $review['user']->name }}"
                                                class="w-12 h-12 rounded-full object-cover">
                                        @else
                                            <div
                                                class="w-12 h-12 bg-[#7A1F1F] rounded-full flex items-center justify-center text-white font-bold text-lg">
                                                {{ strtoupper(substr($review['user']->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Review Content -->
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <div>
                                                <h4 class="font-semibold text-gray-900">{{ $review['user']->name }}</h4>
                                                <p class="text-sm text-gray-500">
                                                    {{ $review['created_at']->format('d M Y') }}
                                                </p>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review['rating'])
                                                        <i class="fas fa-star text-yellow-400"></i>
                                                    @else
                                                        <i class="far fa-star text-gray-300"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>

                                        @if ($review['comment'])
                                            <p class="text-gray-700 leading-relaxed mb-3">{{ $review['comment'] }}</p>
                                        @endif

                                        @if ($review['gambar'])
                                            <div class="flex gap-2">
                                                @php
                                                    $images = is_array($review['gambar']) ? $review['gambar'] : json_decode($review['gambar'], true);
                                                    if (!is_array($images)) {
                                                        $images = [$review['gambar']];
                                                    }
                                                @endphp
                                                @foreach ($images as $image)
                                                    @if($image)
                                                        <img src="{{ asset('storage/' . $image) }}"
                                                            alt="Review image"
                                                            class="w-24 h-24 object-cover rounded-lg border border-gray-200 cursor-pointer hover:opacity-75 transition"
                                                            onclick="openImageModal('{{ asset('storage/' . $image) }}')">
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-50 rounded-lg p-12 text-center">
                        <i class="fas fa-comment-slash text-gray-300 text-5xl mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Ulasan</h3>
                        <p class="text-gray-500">Jadilah yang pertama memberikan ulasan untuk produk ini</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Image Modal -->
    <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 p-4"
        onclick="closeImageModal()">
        <div class="flex items-center justify-center h-full">
            <div class="relative max-w-4xl max-h-full">
                <button onclick="closeImageModal()"
                    class="absolute -top-10 right-0 text-white hover:text-gray-300 text-2xl">
                    <i class="fas fa-times"></i>
                </button>
                <img id="modalImage" src="" alt="Review image" class="max-w-full max-h-[90vh] rounded-lg">
            </div>
        </div>
    </div>

    <script>
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            const modal = document.getElementById('imageModal');
            modal.classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        function increaseQty() {
            const input = document.getElementById('qty');
            const max = parseInt(input.max);
            const current = parseInt(input.value);
            if (current < max) {
                input.value = current + 1;
            }
        }

        function decreaseQty() {
            const input = document.getElementById('qty');
            const min = parseInt(input.min);
            const current = parseInt(input.value);
            if (current > min) {
                input.value = current - 1;
            }
        }
    </script>
@endsection
