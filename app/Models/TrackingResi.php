<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingResi extends Model
{
    protected $table = 'tracking_resi';
    protected $primaryKey = 'tracking_id';
    protected $fillable = [
        'no_resi',
        'kurir',
        'status_terakhir',
        'last_checked_at',
        'delivered_at',
        'raw_response',
    ];
    protected $casts = [
        'last_checked_at' => 'datetime',
        'delivered_at' => 'datetime',
        'raw_response' => 'array',
    ];

    public function histories()
    {
        return $this->hasMany(TrackingHistory::class, 'tracking_id', 'tracking_id');
    }
}
