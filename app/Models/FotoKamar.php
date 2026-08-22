<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoKamar extends Model
{
    use HasFactory;

    protected $table = 'foto_kamar';
    public $timestamps = false; // No created_at/updated_at in schema

    protected $fillable = [
        'kdkamar',
        'jalur_foto',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kdkamar', 'kdkamar');
    }
}
