<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments')->insert([
            [
                'id_transaksi' => 1,
                'provider' => 'midtrans',
                'order_id' => 'ORDER-' . time() . '-1',
                'snap_token' => 'sample-snap-token-abc123',
                'payment_type' => 'bank_transfer',
                'transaction_status' => 'settlement',
                'midtrans_transaction_id' => 'mt-' . uniqid(),
                'gross_amount' => 165000,
                'fraud_status' => 'accept',
                'status_code' => '200',
                'status_message' => 'Success',
                'paid_at' => Carbon::now()->subHours(2),
                'expired_at' => Carbon::now()->addDay(),
                'raw_response' => json_encode([
                    'status_code' => '200',
                    'status_message' => 'Success',
                    'transaction_id' => 'mt-' . uniqid(),
                ]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_transaksi' => 2,
                'provider' => 'midtrans',
                'order_id' => 'ORDER-' . (time() + 1) . '-2',
                'snap_token' => 'sample-snap-token-xyz789',
                'payment_type' => 'qris',
                'transaction_status' => 'pending',
                'midtrans_transaction_id' => null,
                'gross_amount' => 270000,
                'fraud_status' => null,
                'status_code' => '201',
                'status_message' => 'Pending',
                'paid_at' => null,
                'expired_at' => Carbon::now()->addDay(),
                'raw_response' => json_encode([
                    'status_code' => '201',
                    'status_message' => 'Pending',
                ]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}