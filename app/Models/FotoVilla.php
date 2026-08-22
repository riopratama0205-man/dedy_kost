<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoVilla extends Model
{
    use HasFactory;

    protected $table = 'foto_villa';
    public $timestamps = false;

    protected $fillable = [
        'kdvilla',
        'jalur_foto',
    ];

    public function villa()
    {
        return $this->belongsTo(Villa::class, 'kdvilla', 'kdvilla');
    }
}
