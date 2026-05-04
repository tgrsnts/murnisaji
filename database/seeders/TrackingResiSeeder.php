<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrackingResi;
use App\Models\TrackingHistory;
use Illuminate\Support\Carbon;

class TrackingResiSeeder extends Seeder
{
    public function run(): void
    {
        $resi = TrackingResi::create([
            'no_resi' => '8825112045716759',
            'kurir' => 'JNE',
            'status_terakhir' => 'SHIPPING',
            'last_checked_at' => now()->subMinutes(90),
            'delivered_at' => null,
            'raw_response' => null,
        ]);

        TrackingHistory::create([
            'tracking_id' => $resi->tracking_id,
            'status' => 'SHIPPING',
            'deskripsi' => 'Paket sedang dalam perjalanan',
            'lokasi' => 'Jakarta',
            'waktu' => Carbon::now()->subHours(2),
        ]);
        TrackingHistory::create([
            'tracking_id' => $resi->tracking_id,
            'status' => 'PICKED UP',
            'deskripsi' => 'Paket telah diambil oleh kurir',
            'lokasi' => 'Jakarta',
            'waktu' => Carbon::now()->subHours(4),
        ]);
    }
}
