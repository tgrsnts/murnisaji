<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::insert([
            [
                'nama_produk' => 'Beras Organik 5kg',
                'kategori' => 'Sembako',
                'deskripsi' => 'Beras organik premium',
                'harga' => 125000,
                'stok' => 50,
                'berat_gram' => 5000,
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Madu Hutan 500ml',
                'kategori' => 'Kesehatan',
                'deskripsi' => 'Madu asli',
                'harga' => 90000,
                'stok' => 30,
                'berat_gram' => 700,
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
