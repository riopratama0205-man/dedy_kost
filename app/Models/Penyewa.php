<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Penyewa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'penyewa';
    protected $primaryKey = 'idpenyewa';
    public $timestamps = false;

    protected $fillable = [
        'namapenyewa',
        'email',
        'telp',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function sewa()
    {
        return $this->hasMany(Sewa::class, 'idpenyewa', 'idpenyewa');
    }
}
