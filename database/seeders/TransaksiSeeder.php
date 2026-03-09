<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Models\User;
use App\Models\Alamat;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('username', 'user1')->first();
        $alamat = Alamat::where('id_user', $user->user_id)->first();
        $produks = Produk::all();

        // Transaksi 1: Status PENDING
        $transaksi1 = Transaksi::create([
            'id_user' => $user->user_id,
            'id_alamat' => $alamat->alamat_id,
            'total_harga_produk' => 100000,
            'ongkir' => 15000,
            'total_bayar' => 115000,
            'kurir' => 'JNE',
            'layanan_kurir' => 'REG',
            'status' => 'PENDING',
            'resi' => null,
            'snaptoken' => null,
            'created_at' => now()->subDays(5),
            'updated_at' => now()->subDays(5),
        ]);

        TransaksiItem::create([
            'id_transaksi' => $transaksi1->transaksi_id,
            'id_produk' => $produks[0]->produk_id, // Abon Sapi Original 100gr
            'quantity' => 2,
            'harga_saat_beli' => 35000,
            'israted' => false,
        ]);

        TransaksiItem::create([
            'id_transaksi' => $transaksi1->transaksi_id,
            'id_produk' => $produks[1]->produk_id, // Abon Ayam Pedas 100gr
            'quantity' => 1,
            'harga_saat_beli' => 30000,
            'israted' => false,
        ]);

        // Transaksi 2: Status PAID
        $transaksi2 = Transaksi::create([
            'id_user' => $user->user_id,
            'id_alamat' => $alamat->alamat_id,
            'total_harga_produk' => 65000,
            'ongkir' => 12000,
            'total_bayar' => 77000,
            'kurir' => 'JNE',
            'layanan_kurir' => 'OKE',
            'status' => 'PAID',
            'resi' => null,
            'snaptoken' => 'SNAP_TOKEN_ABC123',
            'created_at' => now()->subDays(4),
            'updated_at' => now()->subDays(4),
        ]);

        TransaksiItem::create([
            'id_transaksi' => $transaksi2->transaksi_id,
            'id_produk' => $produks[2]->produk_id, // Abon Sapi Pedas Manis 200gr
            'quantity' => 1,
            'harga_saat_beli' => 65000,
            'israted' => false,
        ]);

        // Transaksi 3: Status PACKED
        $transaksi3 = Transaksi::create([
            'id_user' => $user->user_id,
            'id_alamat' => $alamat->alamat_id,
            'total_harga_produk' => 96000,
            'ongkir' => 14000,
            'total_bayar' => 110000,
            'kurir' => 'SiCepat',
            'layanan_kurir' => 'REG',
            'status' => 'PACKED',
            'resi' => null,
            'snaptoken' => 'SNAP_TOKEN_DEF456',
            'created_at' => now()->subDays(3),
            'updated_at' => now()->subDays(3),
        ]);

        TransaksiItem::create([
            'id_transaksi' => $transaksi3->transaksi_id,
            'id_produk' => $produks[3]->produk_id, // Abon Ikan Tuna Original 100gr
            'quantity' => 3,
            'harga_saat_beli' => 32000,
            'israted' => false,
        ]);

        // Transaksi 4: Status SHIPPED
        $transaksi4 = Transaksi::create([
            'id_user' => $user->user_id,
            'id_alamat' => $alamat->alamat_id,
            'total_harga_produk' => 144000,
            'ongkir' => 16000,
            'total_bayar' => 160000,
            'kurir' => 'JNT',
            'layanan_kurir' => 'EZ',
            'status' => 'SHIPPED',
            'resi' => 'JNT123456789012',
            'snaptoken' => 'SNAP_TOKEN_GHI789',
            'created_at' => now()->subDays(2),
            'updated_at' => now()->subDays(1),
        ]);

        TransaksiItem::create([
            'id_transaksi' => $transaksi4->transaksi_id,
            'id_produk' => $produks[4]->produk_id, // Abon Ayam Original 250gr
            'quantity' => 2,
            'harga_saat_beli' => 72000,
            'israted' => false,
        ]);

        // Transaksi 5: Status DONE
        $transaksi5 = Transaksi::create([
            'id_user' => $user->user_id,
            'id_alamat' => $alamat->alamat_id,
            'total_harga_produk' => 130000,
            'ongkir' => 13000,
            'total_bayar' => 143000,
            'kurir' => 'JNE',
            'layanan_kurir' => 'YES',
            'status' => 'DONE',
            'resi' => 'JNE987654321098',
            'snaptoken' => 'SNAP_TOKEN_JKL012',
            'created_at' => now()->subDays(10),
            'updated_at' => now()->subDays(3),
        ]);

        TransaksiItem::create([
            'id_transaksi' => $transaksi5->transaksi_id,
            'id_produk' => $produks[0]->produk_id, // Abon Sapi Original 100gr
            'quantity' => 2,
            'harga_saat_beli' => 35000,
            'israted' => true,
        ]);

        TransaksiItem::create([
            'id_transaksi' => $transaksi5->transaksi_id,
            'id_produk' => $produks[1]->produk_id, // Abon Ayam Pedas 100gr
            'quantity' => 2,
            'harga_saat_beli' => 30000,
            'israted' => true,
        ]);

        // Transaksi 6: Status CANCEL
        $transaksi6 = Transaksi::create([
            'id_user' => $user->user_id,
            'id_alamat' => $alamat->alamat_id,
            'total_harga_produk' => 64000,
            'ongkir' => 11000,
            'total_bayar' => 75000,
            'kurir' => 'Pos Indonesia',
            'layanan_kurir' => 'Paket Kilat Khusus',
            'status' => 'CANCEL',
            'resi' => null,
            'snaptoken' => null,
            'created_at' => now()->subDays(7),
            'updated_at' => now()->subDays(6),
        ]);

        TransaksiItem::create([
            'id_transaksi' => $transaksi6->transaksi_id,
            'id_produk' => $produks[3]->produk_id, // Abon Ikan Tuna Original 100gr
            'quantity' => 2,
            'harga_saat_beli' => 32000,
            'israted' => false,
        ]);

        // Transaksi 7: Status PAID (Baru kemarin)
        $transaksi7 = Transaksi::create([
            'id_user' => $user->user_id,
            'id_alamat' => $alamat->alamat_id,
            'total_harga_produk' => 195000,
            'ongkir' => 18000,
            'total_bayar' => 213000,
            'kurir' => 'JNE',
            'layanan_kurir' => 'REG',
            'status' => 'PAID',
            'resi' => null,
            'snaptoken' => 'SNAP_TOKEN_MNO345',
            'created_at' => now()->subDay(),
            'updated_at' => now()->subDay(),
        ]);

        TransaksiItem::create([
            'id_transaksi' => $transaksi7->transaksi_id,
            'id_produk' => $produks[2]->produk_id, // Abon Sapi Pedas Manis 200gr
            'quantity' => 3,
            'harga_saat_beli' => 65000,
            'israted' => false,
        ]);
    }
}
