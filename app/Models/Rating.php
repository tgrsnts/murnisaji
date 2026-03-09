<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'id_transaksi_item',
        'rating',
        'comment',
        'gambar',
    ];

    protected $primaryKey = 'rating_id';

    public function transaksiItem()
    {
        return $this->belongsTo(TransaksiItem::class, 'id_transaksi_item', 'transaksi_item_id');
    }
}
