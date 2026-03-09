<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'id_transaksi',
        'provider',
        'order_id',
        'snap_token',
        'payment_type',
        'transaction_status',
        'midtrans_transaction_id',
        'gross_amount',
        'fraud_status',
        'status_code',
        'status_message',
        'paid_at',
        'expired_at',
        'raw_response',
    ];

    protected function casts(): array
    {
        return [
            'paid_at' => 'datetime',
            'expired_at' => 'datetime',
        ];
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'transaksi_id');
    }
}
