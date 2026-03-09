<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function createSnap(Transaksi $transaksi)
    {
        if (!$this->isMidtransConfigured()) {
            return redirect()
                ->route('transaksi.show', $transaksi->transaksi_id)
                ->with('error', 'Midtrans belum dikonfigurasi. Isi MIDTRANS_CLIENT_KEY dan MIDTRANS_SERVER_KEY terlebih dahulu.');
        }

        $payment = Payment::where('id_transaksi', $transaksi->transaksi_id)->first();
        if ($payment && $payment->snap_token && in_array($payment->transaction_status, ['pending', 'challenge'], true)) {
            return redirect()
                ->route('transaksi.show', $transaksi->transaksi_id)
                ->with('open_snap', true);
        }

        $orderId = $payment?->order_id ?? 'TRX-' . $transaksi->transaksi_id . '-' . now()->timestamp;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $transaksi->total_bayar,
            ],
            'customer_details' => [
                'first_name' => $transaksi->nama_penerima,
                'email' => $transaksi->email,
                'phone' => $transaksi->no_telepon,
            ],
        ];

        try {
            /** @var \Illuminate\Http\Client\Response $snapResponse */
            $snapResponse = Http::withBasicAuth(config('services.midtrans.server_key'), '')
                ->acceptJson()
                ->post($this->snapTransactionUrl(), $params);

            if (!$snapResponse->successful() || !$snapResponse->json('token')) {
                Log::error('Midtrans snap API error', [
                    'transaksi_id' => $transaksi->transaksi_id,
                    'status' => $snapResponse->status(),
                    'body' => $snapResponse->body(),
                ]);

                return redirect()
                    ->route('transaksi.show', $transaksi->transaksi_id)
                    ->with('error', 'Gagal membuat SnapToken dari Midtrans. Periksa Server Key atau konfigurasi akun.');
            }

            $snapToken = $snapResponse->json('token');

            Payment::updateOrCreate(
                ['id_transaksi' => $transaksi->transaksi_id],
                [
                    'provider' => 'midtrans',
                    'order_id' => $orderId,
                    'snap_token' => $snapToken,
                    'gross_amount' => (int) $transaksi->total_bayar,
                    'transaction_status' => 'pending',
                    'expired_at' => now()->addDay(),
                    'raw_response' => json_encode($snapResponse->json()),
                ]
            );

            return redirect()
                ->route('transaksi.show', $transaksi->transaksi_id)
                ->with('open_snap', true);
        } catch (\Throwable $e) {
            Log::error('Midtrans snap token error', [
                'transaksi_id' => $transaksi->transaksi_id,
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->route('transaksi.show', $transaksi->transaksi_id)
                ->with('error', 'Gagal membuat pembayaran Midtrans. Cek konfigurasi atau coba lagi.');
        }
    }

    public function callback(Request $request)
    {
        if (!$this->isMidtransConfigured()) {
            return response()->json(['message' => 'Midtrans not configured'], 500);
        }

        $payload = $request->all();
        $signatureKey = $payload['signature_key'] ?? null;
        $orderId = $payload['order_id'] ?? null;
        $statusCode = (string) ($payload['status_code'] ?? '');
        $grossAmount = (string) ($payload['gross_amount'] ?? '');
        $transactionStatus = $payload['transaction_status'] ?? 'pending';

        if (!$signatureKey || !$orderId) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . config('services.midtrans.server_key'));
        if (!hash_equals($expectedSignature, $signatureKey)) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $payment = Payment::where('order_id', $orderId)->first();
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->update([
            'payment_type' => $payload['payment_type'] ?? $payment->payment_type,
            'transaction_status' => $transactionStatus,
            'midtrans_transaction_id' => $payload['transaction_id'] ?? $payment->midtrans_transaction_id,
            'fraud_status' => $payload['fraud_status'] ?? $payment->fraud_status,
            'status_code' => $statusCode,
            'status_message' => $payload['status_message'] ?? $payment->status_message,
            'raw_response' => json_encode($payload),
            'paid_at' => in_array($transactionStatus, ['settlement', 'capture'], true) ? Carbon::now() : $payment->paid_at,
        ]);

        $transaksi = $payment->transaksi;
        if ($transaksi) {
            $transaksi->status = $this->mapMidtransStatusToOrderStatus($transactionStatus, $payload['fraud_status'] ?? null);
            $transaksi->save();
        }

        return response()->json(['message' => 'ok']);
    }

    private function isMidtransConfigured(): bool
    {
        return (bool) config('services.midtrans.client_key')
            && (bool) config('services.midtrans.server_key');
    }

    private function snapTransactionUrl(): string
    {
        return (bool) config('services.midtrans.is_production', false)
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';
    }

    private function mapMidtransStatusToOrderStatus(string $transactionStatus, ?string $fraudStatus): string
    {
        if ($transactionStatus === 'settlement') {
            return 'PAID';
        }

        if ($transactionStatus === 'capture') {
            return $fraudStatus === 'challenge' ? 'PENDING' : 'PAID';
        }

        if ($transactionStatus === 'pending') {
            return 'PENDING';
        }

        if (in_array($transactionStatus, ['deny', 'cancel', 'expire', 'failure'], true)) {
            return 'CANCEL';
        }

        return 'PENDING';
    }
}
