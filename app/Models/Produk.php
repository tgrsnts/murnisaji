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
        'gambar'
    ];

    protected $primaryKey = 'produk_id';

    public function transaksiItems()
    {
        return $this->hasMany(TransaksiItem::class, 'id_produk', 'produk_id');
    }

    // Get average rating for this product
    public function getAverageRatingAttribute()
    {
        $ratings = $this->transaksiItems()
            ->whereHas('rating')
            ->with('rating')
            ->get()
            ->pluck('rating.rating')
            ->filter();
        
        return $ratings->count() > 0 ? round($ratings->avg(), 1) : 0;
    }

    // Get total reviews count
    public function getTotalReviewsAttribute()
    {
        return $this->transaksiItems()
            ->whereHas('rating')
            ->count();
    }
}
