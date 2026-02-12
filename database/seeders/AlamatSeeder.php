<?php

namespace Database\Seeders;

use App\Models\Alamat;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('username', 'user1')->first();

        Alamat::create([
            'id_user' => $user->user_id,
            'nama_penerima' => 'User Satu',
            'no_telepon' => '081234567891',
            'label_alamat' => 'Rumah',
            'detail' => 'Jl. Contoh No. 123',
            'provinsi' => 'DKI Jakarta',
            'province_id' => 6,
            'kabupaten' => 'Jakarta Selatan',
            'city_id' => 153,
            'kecamatan' => 'Kebayoran Baru',
            'kodepos' => '12120',
            'isPrimary' => true,
            'catatan_kurir' => 'Titip satpam',
        ]);
    }
}
