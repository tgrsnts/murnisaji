<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public function items()
    {
        return $this->hasMany(TransaksiItem::class, 'id_transaksi', 'transaksi_id');
    }
    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'id_alamat', 'alamat_id');
    }
}
