<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    use HasFactory;

    protected $table = 'villa';
    protected $primaryKey = 'kdvilla';
    public $timestamps = false;

    public function photo()
    {
        return $this->hasMany(FotoVilla::class, 'kdvilla', 'kdvilla');
    }

    public function fotoVilla()
    {
        return $this->hasMany(FotoVilla::class, 'kdvilla', 'kdvilla');
    }

    public function sewa()
    {
        return $this->hasMany(Sewa::class, 'kdvilla', 'kdvilla');
    }

    protected $fillable = [
        'namavilla',
        'tipevilla',
        'hargasewa',
        'fasilitas',
        'deskripsi',
        'status',
    ];
}
