<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tim',
        'rfid_uid',
    ];
}
