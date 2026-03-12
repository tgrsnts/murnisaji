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
            'detail' => 'Kp Kelapa No. 67',
            'provinsi' => 'Jawa Barat',
            'kabupaten' => 'Bogor',
            'kecamatan' => 'Bojong Gede',
            'desa' => 'Rawa Panjang',
            'village_id' => 3201132011,
            'kodepos' => '12120',
            'isPrimary' => true,
            'catatan_kurir' => 'Titip satpam',
        ]);
    }
}
