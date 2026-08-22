<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    use HasFactory;

    protected $table = 'sewa';
    protected $primaryKey = 'kdsewa';
    public $timestamps = false;

    protected $fillable = [
        'idpenyewa',
        'kdkamar',
        'kdvilla',
        'kode_booking',
        'tglmulai',
        'tglselesai',
        'status',
        'totalharga',
        'buktibayar',
        'catatan',
        'disembunyikan_dari_penyewa',
    ];

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class, 'idpenyewa', 'idpenyewa');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kdkamar', 'kdkamar');
    }

    public function villa()
    {
        return $this->belongsTo(Villa::class, 'kdvilla', 'kdvilla');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'kdsewa', 'kdsewa');
    }

    public function getStatusIndonesiaAttribute()
    {
        $statusMap = [
            'menunggu' => 'Menunggu',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak',
            'dibatalkan' => 'Dibatalkan',
        ];

        return $statusMap[strtolower($this->status)] ?? ucfirst($this->status);
    }
}
