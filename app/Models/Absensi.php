<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'relawan_id',
        'tanggal_masuk',
        'tanggal_keluar',
    ];

    protected $casts = [
        'tanggal_masuk' => 'datetime',
        'tanggal_keluar' => 'datetime',
    ];

    public function relawan()
    {
        return $this->belongsTo(Relawan::class);
    }
}