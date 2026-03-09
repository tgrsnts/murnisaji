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
            $response = Http::withHeaders($this->getHeaders())->get($url);

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
            ], 500);
        } catch (\Throwable $e) {
            Log::error('API.co.id provinces exception', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data provinsi',
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

    public function calculateCost(Request $request)
    {
        $request->validate([
            'destination' => 'required|integer',
            'weight' => 'required|integer|min:1',
            'courier' => 'required|string|in:jne,pos,tiki',
        ]);

        try {
            $url = $this->baseUrl() . '/' . $this->endpoint('cost_endpoint', 'expedition/shipping-cost');

            $payload = [
                'origin' => (int) config('services.apicoid.origin_city_id', 501),
                'destination' => (int) $request->destination,
                'weight' => (int) $request->weight,
                'courier' => $request->courier,
            ];

            $response = Http::withHeaders($this->getHeaders())
                ->asForm()
                ->post($url, $payload);

            if ($response->successful() && $response->json('is_success', true)) {
                return response()->json([
                    'success' => true,
                    'data' => $this->extractList($response),
                ]);
            }

            Log::error('API.co.id calculate cost error', [
                'destination' => $request->destination,
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
                'destination' => $request->destination,
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
