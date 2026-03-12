@extends('web.dashboard.layout.main')

@php($title = 'Review')

@section('content')
        <div class="space-y-6">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
                <h1 class="text-3xl font-bold text-gray-900">Review Saya</h1>
                <p class="text-gray-600 mt-1">Daftar ulasan dari transaksi Anda</p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">
                @if ($reviews->count())
                    <div class="space-y-4">
                        @foreach ($reviews as $review)
                            <div class="border border-gray-200 rounded-xl p-4">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $review->transaksiItem->produk->nama_produk ?? 'Produk' }}</p>
                                        <p class="text-sm text-gray-500">Transaksi #{{ $review->transaksiItem->transaksi->transaksi_id ?? '-' }}</p>
                                    </div>
                                    <span class="text-sm font-semibold text-[#7A1F1F]">{{ $review->rating }}/5</span>
                                </div>
                                @if ($review->comment)
                                    <p class="text-sm text-gray-700 mt-3">{{ $review->comment }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">Belum ada review.</p>
                @endif
            </div>
        </div>
@endsection
