<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiCoIdController extends Controller
{
    private function getHeaders(): array
    {
        $apiKey = config('services.apicoid.api_key');

        $headers = [
            'Accept' => 'application/json',
        ];

        if (!empty($apiKey)) {
            // Header resmi API.co.id.
            $headers['x-api-co-id'] = $apiKey;
        }

        return $headers;
    }

    private function baseUrl(): string
    {
        return rtrim(config('services.apicoid.base_url', 'https://use.api.co.id'), '/');
    }

    private function endpoint(string $key, string $default): string
    {
        return ltrim(config("services.apicoid.{$key}", $default), '/');
    }

    private function extractList($response): array
    {
        $data = $response->json('data');
        if (is_array($data) && array_is_list($data)) {
            return $data;
        }

        if (is_array($data) && isset($data['couriers']) && is_array($data['couriers'])) {
            return $data['couriers'];
        }

        $results = $response->json('results');
        if (is_array($results) && array_is_list($results)) {
            return $results;
        }

        $result = $response->json('result');
        if (is_array($result) && array_is_list($result)) {
            return $result;
        }

        $rajaResults = $response->json('rajaongkir.results');
        if (is_array($rajaResults) && array_is_list($rajaResults)) {
            return $rajaResults;
        }

        return [];
    }

    public function getProvinces()
    {
        try {
            $url = $this->baseUrl() . '/' . $this->endpoint('provinces_endpoint', 'regional/indonesia/provinces');
            
            Log::info('Fetching provinces from API.co.id', ['url' => $url]);
            
            $response = Http::withHeaders($this->getHeaders())->get($url);

            Log::info('API.co.id provinces response', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if ($response->successful() && $response->json('is_success', true)) {
                return response()->json([
                    'success' => true,
                    'data' => $this->extractList($response),
                ]);
            }

            Log::error('API.co.id get provinces error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data provinsi',
                'debug' => [
                    'status' => $response->status(),
                    'body' => $response->json(),
                ],
            ], 500);
        } catch (\Throwable $e) {
            Log::error('API.co.id provinces exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data provinsi',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getCities(Request $request)
    {
        $provinceId = $request->input('province_id');

        if (!$provinceId) {
            return response()->json([
                'success' => false,
                'message' => 'Province ID is required',
            ], 400);
        }

        try {
            $url = $this->baseUrl() . '/' . $this->endpoint('cities_endpoint', 'regional/indonesia/regencies');
            $response = Http::withHeaders($this->getHeaders())
                ->get($url, [
                    'province_code' => $provinceId,
                ]);

            if ($response->successful() && $response->json('is_success', true)) {
                return response()->json([
                    'success' => true,
                    'data' => $this->extractList($response),
                ]);
            }

            Log::error('API.co.id get cities error', [
                'province_id' => $provinceId,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kota',
            ], 500);
        } catch (\Throwable $e) {
            Log::error('API.co.id cities exception', [
                'province_id' => $provinceId,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data kota',
            ], 500);
        }
    }

    public function getSubdistricts(Request $request)
    {
        $cityId = $request->input('city_id');

        if (!$cityId) {
            return response()->json([
                'success' => false,
                'message' => 'City ID is required',
            ], 400);
        }

        try {
            $url = $this->baseUrl() . '/' . $this->endpoint('subdistricts_endpoint', 'regional/indonesia/districts');
            $response = Http::withHeaders($this->getHeaders())
                ->get($url, [
                    'regency_code' => $cityId,
                ]);

            if ($response->successful() && $response->json('is_success', true)) {
                return response()->json([
                    'success' => true,
                    'data' => $this->extractList($response),
                ]);
            }

            Log::error('API.co.id get subdistricts error', [
                'city_id' => $cityId,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kecamatan',
            ], 500);
        } catch (\Throwable $e) {
            Log::error('API.co.id subdistricts exception', [
                'city_id' => $cityId,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data kecamatan',
            ], 500);
        }
    }

    public function getVillages(Request $request)
    {
        $subdistrictId = $request->input('subdistrict_id');

        if (!$subdistrictId) {
            return response()->json([
                'success' => false,
                'message' => 'Subdistrict ID is required',
            ], 400);
        }

        try {
            $url = $this->baseUrl() . '/' . $this->endpoint('villages_endpoint', 'regional/indonesia/villages');
            $response = Http::withHeaders($this->getHeaders())
                ->get($url, [
                    'district_code' => $subdistrictId,
                ]);

            if ($response->successful() && $response->json('is_success', true)) {
                return response()->json([
                    'success' => true,
                    'data' => $this->extractList($response),
                ]);
            }

            Log::error('API.co.id get villages error', [
                'subdistrict_id' => $subdistrictId,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data desa/kelurahan',
            ], 500);
        } catch (\Throwable $e) {
            Log::error('API.co.id villages exception', [
                'subdistrict_id' => $subdistrictId,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data desa/kelurahan',
            ], 500);
        }
    }

    public function calculateCost(Request $request)
    {
        $originVillageCode = (string) ($request->input('origin_village_code') ?: config('services.apicoid.origin_village_code', ''));

        $request->validate([
            'destination_village_code' => 'required|digits:10',
            'weight' => 'required|numeric|gt:0',
            'courier' => 'nullable|string',
        ]);

        if (!preg_match('/^\d{10}$/', $originVillageCode)) {
            return response()->json([
                'success' => false,
                'message' => 'Origin village code tidak valid. Pastikan APICOID_ORIGIN_VILLAGE_CODE berisi 10 digit.',
            ], 422);
        }

        try {
            $url = $this->baseUrl() . '/' . $this->endpoint('cost', 'expedition/shipping-cost');

            $payload = [
                'origin_village_code' => $originVillageCode,
                'destination_village_code' => (string) $request->destination_village_code,
                'weight' => (float) $request->weight,
            ];

            // Only add courier if provided
            if ($request->filled('courier')) {
                $payload['courier'] = $request->courier;
            }

            Log::info('Calling API.co.id shipping cost', [
                'url' => $url,
                'payload' => $payload,
            ]);

            $response = Http::withHeaders($this->getHeaders())
                ->get($url, $payload);

            if ($response->successful() && $response->json('is_success', true)) {
                return response()->json([
                    'success' => true,
                    'data' => $this->extractList($response),
                    'result' => $response->json('result') ?? $this->extractList($response),
                ]);
            }

            Log::error('API.co.id calculate cost error', [
                'destination_village_code' => $request->destination_village_code,
                'courier' => $request->courier,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghitung ongkos kirim',
            ], 500);
        } catch (\Throwable $e) {
            Log::error('API.co.id cost exception', [
                'destination_village_code' => $request->destination_village_code,
                'courier' => $request->courier,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghitung ongkos kirim',
            ], 500);
        }
    }
}
