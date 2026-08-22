<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar';
    protected $primaryKey = 'kdkamar';
    public $timestamps = false;

    protected $fillable = [
        'namakamar',
        'tipekamar',
        'hargasewa',
        'fasilitas',
        'deskripsi',
        'status',
    ];

    public function sewa()
    {
        return $this->hasMany(Sewa::class, 'kdkamar', 'kdkamar');
    }

    public function fotoKamar()
    {
        return $this->hasMany(FotoKamar::class, 'kdkamar', 'kdkamar');
    }
}
