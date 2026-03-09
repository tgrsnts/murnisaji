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
                'nama_produk' => 'Abon Sapi Original 100gr',
                'kategori' => 'Abon',
                'deskripsi' => 'Abon sapi premium dengan rasa gurih dan tekstur lembut. Cocok untuk lauk dan topping makanan.',
                'harga' => 35000,
                'stok' => 100,
                'berat_gram' => 100,
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Abon Ayam Pedas 100gr',
                'kategori' => 'Abon',
                'deskripsi' => 'Abon ayam dengan cita rasa pedas nikmat dan aroma rempah khas.',
                'harga' => 30000,
                'stok' => 80,
                'berat_gram' => 100,
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Abon Sapi Pedas Manis 200gr',
                'kategori' => 'Abon',
                'deskripsi' => 'Perpaduan rasa pedas dan manis dengan daging sapi pilihan, cocok untuk keluarga.',
                'harga' => 65000,
                'stok' => 60,
                'berat_gram' => 200,
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Abon Ikan Tuna Original 100gr',
                'kategori' => 'Abon',
                'deskripsi' => 'Abon ikan tuna dengan rasa gurih alami, tinggi protein dan sehat.',
                'harga' => 32000,
                'stok' => 70,
                'berat_gram' => 100,
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Abon Ayam Original 250gr',
                'kategori' => 'Abon',
                'deskripsi' => 'Abon ayam lembut dengan rasa klasik yang disukai semua kalangan.',
                'harga' => 72000,
                'stok' => 40,
                'berat_gram' => 250,
                'gambar' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}