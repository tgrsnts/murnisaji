<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksis')->insert([
            [
                'id_user' => 1,
                'id_alamat' => 1,
                'nama_penerima' => 'John Doe',
                'no_telepon' => '08123456789',
                'email' => 'john@example.com',
                'label_alamat' => 'Rumah',
                'detail' => 'Jl. Merdeka No. 123',
                'provinsi' => 'DKI Jakarta',
                'province_id' => 6,
                'kabupaten' => 'Jakarta Selatan',
                'city_id' => 152,
                'kecamatan' => 'Kebayoran Baru',
                'kodepos' => '12180',
                'catatan_kurir' => 'Depan pagar hitam',
                'total_harga_produk' => 150000,
                'ongkir' => 15000,
                'total_bayar' => 165000,
                'kurir' => 'jne',
                'layanan_kurir' => 'REG',
                'status' => 'dibayar',
                'resi' => 'JNE123456789',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_user' => null, // Guest checkout
                'id_alamat' => null,
                'nama_penerima' => 'Jane Smith',
                'no_telepon' => '08987654321',
                'email' => 'jane@example.com',
                'label_alamat' => null,
                'detail' => 'Jl. Sudirman No. 456',
                'provinsi' => 'Jawa Barat',
                'province_id' => 9,
                'kabupaten' => 'Bandung',
                'city_id' => 23,
                'kecamatan' => 'Coblong',
                'kodepos' => '40132',
                'catatan_kurir' => null,
                'total_harga_produk' => 250000,
                'ongkir' => 20000,
                'total_bayar' => 270000,
                'kurir' => 'pos',
                'layanan_kurir' => 'Express',
                'status' => 'pending',
                'resi' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}