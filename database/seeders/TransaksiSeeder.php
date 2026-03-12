<?php

namespace Database\Seeders;

use App\Models\Alamat;
use App\Models\Produk;
use App\Models\User;
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
        $now = Carbon::now();

        $user1 = User::where('username', 'user1')->first();
        $user2 = User::where('username', 'budi')->first();
        $alamatUser1 = $user1 ? Alamat::where('id_user', $user1->user_id)->first() : null;

        $produks = Produk::orderBy('produk_id')->get()->keyBy('produk_id');
        if ($produks->isEmpty()) {
            return;
        }

        $produkIds = $produks->keys()->values();

        $tx1Items = [
            ['id_produk' => $produkIds[0], 'quantity' => 2, 'israted' => true],
            ['id_produk' => $produkIds[1], 'quantity' => 1, 'israted' => true],
            ['id_produk' => $produkIds[3] ?? $produkIds[0], 'quantity' => 1, 'israted' => false],
        ];

        $tx2Items = [
            ['id_produk' => $produkIds[2] ?? $produkIds[0], 'quantity' => 2, 'israted' => false],
            ['id_produk' => $produkIds[4] ?? $produkIds[1], 'quantity' => 1, 'israted' => false],
            ['id_produk' => $produkIds[1], 'quantity' => 1, 'israted' => false],
        ];

        $tx3Items = [
            ['id_produk' => $produkIds[0], 'quantity' => 1, 'israted' => false],
            ['id_produk' => $produkIds[1], 'quantity' => 2, 'israted' => false],
        ];

        $insertTransaksi = function (array $baseData, array $items, int $ongkir) use ($produks, $now) {
            $subtotal = 0;
            foreach ($items as $item) {
                $harga = (int) ($produks[$item['id_produk']]->harga ?? 0);
                $subtotal += $harga * (int) $item['quantity'];
            }

            $transaksiId = DB::table('transaksis')->insertGetId([
                ...$baseData,
                'total_harga_produk' => $subtotal,
                'ongkir' => $ongkir,
                'total_bayar' => $subtotal + $ongkir,
                'created_at' => $now,
                'updated_at' => $now,
            ], 'transaksi_id');

            foreach ($items as $item) {
                $harga = (int) ($produks[$item['id_produk']]->harga ?? 0);
                DB::table('transaksi_items')->insert([
                    'id_transaksi' => $transaksiId,
                    'id_produk' => $item['id_produk'],
                    'quantity' => (int) $item['quantity'],
                    'harga_saat_beli' => $harga,
                    'israted' => (bool) ($item['israted'] ?? false),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            return $transaksiId;
        };

        // Transaksi 1: user login + alamat tersimpan (total akan cocok dengan PaymentSeeder 165000)
        $insertTransaksi([
            'id_user' => $user1?->user_id,
            'id_alamat' => $alamatUser1?->alamat_id,
            'nama_penerima' => $alamatUser1?->nama_penerima ?? 'Tegar',
            'no_telepon' => $alamatUser1?->no_telepon ?? '081234567891',
            'email' => $user1?->email ?? 'user1@example.com',
            'label_alamat' => $alamatUser1?->label_alamat ?? 'Rumah',
            'detail' => $alamatUser1?->detail ?? 'Kp Kelapa No. 67',
            'provinsi' => $alamatUser1?->provinsi ?? 'Jawa Barat',
            'kabupaten' => $alamatUser1?->kabupaten ?? 'Bogor',
            'kecamatan' => $alamatUser1?->kecamatan ?? 'Bojong Gede',
            'desa' => $alamatUser1?->desa ?? 'Rawa Panjang',
            'village_id' => $alamatUser1?->village_id ?? 3201132011,
            'kodepos' => $alamatUser1?->kodepos ?? '12120',
            'catatan_kurir' => 'Titip satpam',
            'kurir' => 'jne',
            'layanan_kurir' => 'JNE Express',
            'status' => 'PAID',
            'resi' => 'JNE123456789',
        ], $tx1Items, 33000);

        // Transaksi 2: guest checkout (total akan cocok dengan PaymentSeeder 270000)
        $insertTransaksi([
            'id_user' => null,
            'id_alamat' => null,
            'nama_penerima' => 'Jane Smith',
            'no_telepon' => '08987654321',
            'email' => 'jane@example.com',
            'label_alamat' => 'Alamat Tamu',
            'detail' => 'Jl. Sudirman No. 456',
            'provinsi' => 'Jawa Barat',
            'kabupaten' => 'Bogor',
            'kecamatan' => 'Bojong Gede',
            'desa' => 'Rawa Panjang',
            'village_id' => 3201132011,
            'kodepos' => '12120',
            'catatan_kurir' => null,
            'kurir' => 'anteraja',
            'layanan_kurir' => 'AnterAja',
            'status' => 'PENDING',
            'resi' => null,
        ], $tx2Items, 38000);

        // Transaksi 3: status DONE untuk kebutuhan dashboard/rating demo
        $insertTransaksi([
            'id_user' => $user2?->user_id,
            'id_alamat' => null,
            'nama_penerima' => $user2?->name ?? 'Budi Santoso',
            'no_telepon' => $user2?->telp ?? '081234567892',
            'email' => $user2?->email ?? 'budi@example.com',
            'label_alamat' => 'Kantor',
            'detail' => 'Jl. Pajajaran No. 10',
            'provinsi' => 'Jawa Barat',
            'kabupaten' => 'Bogor',
            'kecamatan' => 'Bogor Tengah',
            'desa' => 'Paledang',
            'village_id' => 3271011001,
            'kodepos' => '16122',
            'catatan_kurir' => 'Hubungi sebelum kirim',
            'kurir' => 'sicepat',
            'layanan_kurir' => 'SiCepat Express',
            'status' => 'DONE',
            'resi' => 'SICEPAT1234567',
        ], $tx3Items, 15000);
    }
}
