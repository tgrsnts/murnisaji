<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingHistory extends Model
{
    protected $table = 'tracking_history';
    protected $fillable = [
        'tracking_id',
        'status',
        'deskripsi',
        'lokasi',
        'waktu',
    ];
    protected $casts = [
        'waktu' => 'datetime',
    ];

    public function trackingResi()
    {
        return $this->belongsTo(TrackingResi::class, 'tracking_id', 'tracking_id');
    }
}
