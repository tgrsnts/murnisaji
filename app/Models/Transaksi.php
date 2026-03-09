<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'id_user',
        'id_alamat',
        'total_harga_produk',
        'ongkir',
        'total_bayar',
        'kurir',
        'layanan_kurir',
        'status',
        'resi',
        'snaptoken',
    ];

    protected $primaryKey = 'transaksi_id';

    public function items()
    {
        return $this->hasMany(TransaksiItem::class, 'id_transaksi', 'transaksi_id');
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'id_alamat', 'alamat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'user_id');
    }
}
