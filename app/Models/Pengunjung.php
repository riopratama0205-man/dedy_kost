<?php

namespace App\Models;

use App\Models\Penyewa;

class Pengunjung
{
    /**
     * Fungsi pendaftaran sesuai diagram UML.
     * Pengunjung bertanggung jawab untuk memicu pendaftaran Penyewa.
     */
    public function pendaftaran($data)
    {
        return Penyewa::create([
            'namapenyewa' => $data['namapenyewa'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'telp' => $data['telp'] ?? null,
        ]);
    }
}
