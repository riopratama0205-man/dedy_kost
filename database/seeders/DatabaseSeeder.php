<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Penyewa;
use App\Models\Kamar;
use App\Models\Villa;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin users
        Admin::create([
            'namaadmin' => 'Administrator',
            'email' => 'admin@dedykost.com',
            'password' => Hash::make('admin123'),
        ]);

        Admin::create([
            'namaadmin' => 'Admin Dedy',
            'email' => 'dedy@dedykost.com',
            'password' => Hash::make('dedy123'),
        ]);

        // Create regular tenants (penyewa)
        Penyewa::create([
            'namapenyewa' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'telp' => '081234567890',
            'password' => Hash::make('password123'),
        ]);

        Penyewa::create([
            'namapenyewa' => 'Siti Nurhaliza',
            'email' => 'siti@gmail.com',
            'telp' => '082345678901',
            'password' => Hash::make('password123'),
        ]);

        // Create rooms (kamar)
        Kamar::create([
            'namakamar' => 'Kamar A1',
            'tipekamar' => 'Kost',
            'hargasewa' => 1000000,
            'fasilitas' => 'AC, Kasur, Lemari, Kamar Mandi Dalam',
            'deskripsi' => 'Kamar kost nyaman dengan fasilitas lengkap',
            'status' => 'available',
        ]);

        Kamar::create([
            'namakamar' => 'Kamar B1',
            'tipekamar' => 'Kost',
            'hargasewa' => 1500000,
            'fasilitas' => 'AC, Kasur, Lemari, Kamar Mandi Dalam, TV, WiFi',
            'deskripsi' => 'Kamar kost premium dengan fasilitas mewah',
            'status' => 'available',
        ]);

        // Create villas
        Villa::create([
            'namavilla' => 'Villa Puncak',
            'tipevilla' => 'Villa',
            'hargasewa' => 2500000,
            'fasilitas' => '3 Kamar Tidur, 2 Kamar Mandi, Dapur, Ruang Tamu, Kolam Renang',
            'deskripsi' => 'Villa keluarga dengan pemandangan pegunungan',
            'status' => 'available',
        ]);

        Villa::create([
            'namavilla' => 'Villa Pantai',
            'tipevilla' => 'Villa',
            'hargasewa' => 3000000,
            'fasilitas' => '4 Kamar Tidur, 3 Kamar Mandi, Dapur, Ruang Tamu, Kolam Renang, Akses Pantai',
            'deskripsi' => 'Villa mewah dengan akses langsung ke pantai',
            'status' => 'available',
        ]);
    }
}
