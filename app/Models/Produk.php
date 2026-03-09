<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'nama_produk',
        'kategori',
        'deskripsi',
        'harga',
        'stok',
        'berat_gram',
        'gambar',
    ];

    protected $primaryKey = 'produk_id';
}
