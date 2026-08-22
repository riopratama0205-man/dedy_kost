<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'kdpembayaran';
    public $timestamps = false;

    protected $fillable = [
        'kdsewa',
        'jumlahbayar',
        'tglbayar',
        'buktibayar',
        'bulan',
        'tahun',
        'status',
    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class, 'kdsewa', 'kdsewa');
    }
}
