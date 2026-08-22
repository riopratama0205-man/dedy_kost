<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $table = 'metode_pembayaran';
    protected $primaryKey = 'kdmetode';
    public $timestamps = false;

    protected $fillable = [
        'namabank',
        'norek',
        'pemilikrek',
        'gambar_qr_code',
        'aktif',
    ];
}
