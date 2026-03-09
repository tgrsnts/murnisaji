<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\TransaksiItem;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil transaksi items yang sudah ditandai sebagai rated
        $ratedItems = TransaksiItem::where('israted', true)->get();

        if ($ratedItems->count() > 0) {
            // Rating untuk item pertama (Abon Sapi Original 100gr)
            if (isset($ratedItems[0])) {
                Rating::create([
                    'id_transaksi_item' => $ratedItems[0]->transaksi_item_id,
                    'rating' => 5,
                    'comment' => 'Abon sapi nya enak banget! Gurih dan tidak terlalu asin. Teksturnya lembut dan cocok banget buat lauk nasi. Pasti akan beli lagi!',
                    'gambar' => null,
                    'created_at' => now()->subDays(2),
                    'updated_at' => now()->subDays(2),
                ]);
            }

            // Rating untuk item kedua (Abon Ayam Pedas 100gr)
            if (isset($ratedItems[1])) {
                Rating::create([
                    'id_transaksi_item' => $ratedItems[1]->transaksi_item_id,
                    'rating' => 4,
                    'comment' => 'Rasanya pedas nya pas, tidak terlalu pedas. Abon ayamnya juga enak dan halal. Cuma porsinya agak sedikit untuk ukuran 100gr. Overall bagus!',
                    'gambar' => null,
                    'created_at' => now()->subDays(2),
                    'updated_at' => now()->subDays(2),
                ]);
            }
        }

        // Tambahan rating untuk produk lain jika ada lebih banyak transaksi selesai
        $allItems = TransaksiItem::whereHas('transaksi', function ($query) {
            $query->where('status', 'DONE');
        })->where('israted', false)->take(3)->get();

        if ($allItems->count() > 0) {
            foreach ($allItems as $index => $item) {
                Rating::create([
                    'id_transaksi_item' => $item->transaksi_item_id,
                    'rating' => rand(3, 5),
                    'comment' => $this->getRandomComment(),
                    'gambar' => null,
                    'created_at' => now()->subDays(rand(1, 5)),
                    'updated_at' => now()->subDays(rand(1, 5)),
                ]);

                // Update israted
                $item->update(['israted' => true]);
            }
        }
    }

    private function getRandomComment(): string
    {
        $comments = [
            'Produk berkualitas dengan rasa yang sangat enak. Recommended!',
            'Pengiriman cepat dan produk sesuai deskripsi. Terima kasih!',
            'Abon nya lembut dan gurih, keluarga suka semua.',
            'Rasanya pas di lidah, tidak terlalu asin. Mantap!',
            'Kualitas oke, harga sesuai. Pasti repeat order.',
            'Enak banget! Cocok buat bekal anak sekolah.',
            'Packaging rapi, produk fresh. Puas!',
            'Rasa nya authentic, seperti buatan rumah. Suka!',
        ];

        return $comments[array_rand($comments)];
    }
}
