<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    protected $fillable = [
        'id_transaksi',
        'id_produk',
        'quantity',
        'harga_saat_beli',
        'israted',
    ];

    protected $primaryKey = 'transaksi_item_id';

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'produk_id');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'transaksi_id');
    }

    public function rating()
    {
        return $this->hasOne(Rating::class, 'id_transaksi_item', 'transaksi_item_id');
    }
}
