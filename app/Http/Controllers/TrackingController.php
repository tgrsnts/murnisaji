<?php

namespace App\Http\Controllers;

use App\Models\TrackingResi;
use App\Models\TrackingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

class TrackingController extends Controller
{
    public function show($id)
    {
        $tracking = TrackingResi::with('histories')->findOrFail($id);

        // If already delivered, return immediately
        if ($tracking->delivered_at) {
            return response()->json($tracking->load('histories'));
        }

        // Check TTL (60 minutes)
        $expired = !$tracking->last_checked_at || $tracking->last_checked_at->lt(now()->subMinutes(60));
        if ($expired) {
            $lock = Cache::lock('tracking_lock_' . $tracking->tracking_id, 30);
            if ($lock->get()) {
                try {
                    $this->updateTrackingData($tracking);
                } finally {
                    $lock->release();
                }
            }
        }

        $tracking->refresh();
        return response()->json($tracking->load('histories'));
    }

    protected function updateTrackingData(TrackingResi $tracking)
    {
        $apiKey = config('services.binderbyte.api_key');
        $courirlist = [
            'JT' => 'jnt',
            'anteraja' => 'anteraja',
            'JNE' => 'jne',
            'JNECargo' => 'jne_cargo',
            'SiCepat' => 'sicepat',
            'SiCepatCargo' => 'sicepat_cargo',
            'Ninja' => 'ninja'
        ];

        $courir = $courirlist[$tracking->kurir] ?? null;
        $response = Http::get('https://api.binderbyte.com/v1/track', [
            'api_key' => $apiKey,
            'courier' => $courir,
            'awb' => $tracking->no_resi,
        ]);
        $json = $response->json();

        $summary = $json['data']['summary'] ?? [];
        $history = $json['data']['history'] ?? [];
        $status = $summary['status'] ?? null;
        $now = now();

        $tracking->status_terakhir = $status;
        $tracking->last_checked_at = $now;
        if (strtoupper($status) === 'DELIVERED') {
            $tracking->delivered_at = $now;
        }
        $tracking->raw_response = $json;
        $tracking->save();

        foreach ($history as $item) {
            TrackingHistory::updateOrCreate(
                [
                    'tracking_id' => $tracking->tracking_id,
                    'waktu' => Carbon::parse($item['date'] ?? $item['waktu'] ?? $now),
                    'deskripsi' => $item['desc'] ?? $item['deskripsi'] ?? null,
                ],
                [
                    'status' => $item['status'] ?? '',
                    'lokasi' => $item['location'] ?? $item['lokasi'] ?? null,
                ]
            );
        }
    }
}
