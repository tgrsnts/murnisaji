<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $fillable = [
        'id_user',
        'nama_penerima',
        'no_telepon',
        'label_alamat',
        'detail',
        'provinsi',
        'province_id',
        'kabupaten',
        'city_id',
        'kecamatan',
        'desa',
        'kodepos',
        'isPrimary',
        'catatan_kurir',
    ];

    protected $primaryKey = 'alamat_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'user_id');
    }

    // Accessor untuk alamat lengkap
    public function getAlamatLengkapAttribute()
    {
        return $this->attributes['detail'] . ', ' . 
               $this->attributes['kecamatan'] . ', ' . 
               $this->attributes['kabupaten'] . ', ' . 
               $this->attributes['provinsi'];
    }

    // Accessor untuk no_telp (alias dari no_telepon)
    public function getNoTelpAttribute()
    {
        return $this->attributes['no_telepon'] ?? null;
    }

    // Accessor untuk kota (alias dari kabupaten)
    public function getKotaAttribute()
    {
        return $this->attributes['kabupaten'] ?? null;
    }

    // Accessor untuk kode_pos (alias dari kodepos)
    public function getKodePosAttribute()
    {
        return $this->attributes['kodepos'] ?? null;
    }
}
