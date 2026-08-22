<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $table = 'pesan';
    protected $primaryKey = 'kdpesan';
    public $timestamps = false; // Nonaktifkan timestamp default (created_at, updated_at)

    protected $fillable = [
        'idpenyewa',
        'nama',
        'email',
        'telp',
        'judul',
        'isi',
        'tgl',
        'status',
        'balasan',
        'tglbalas',
        'idadmin',
    ];

    protected $casts = [
        'tgl' => 'datetime',
        'tglbalas' => 'datetime',
    ];

    // Relasi ke Penyewa
    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class, 'idpenyewa', 'idpenyewa');
    }

    // Relasi ke Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'idadmin', 'idadmin');
    }
}
