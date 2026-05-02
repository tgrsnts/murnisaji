<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'id_user',
        'id_alamat',
        'nama_penerima',
        'no_telepon',
        'email',
        'label_alamat',
        'detail',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa',
        'village_id',
        'kodepos',
        'catatan_kurir',
        'total_harga_produk',
        'ongkir',
        'total_bayar',
        'kurir',
        'layanan_kurir',
        'status',
        'resi',
    ];

    protected $primaryKey = 'transaksi_id';

    public function firstItem()
{
    return $this->hasOne(TransaksiItem::class, 'id_transaksi')->with('produk');
}

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

    public function payment()
    {
        return $this->hasOne(Payment::class, 'id_transaksi', 'transaksi_id');
    }

    public function trackingResi()
    {
        return $this->belongsTo(TrackingResi::class, 'tracking_id', 'tracking_id');
    }
}
