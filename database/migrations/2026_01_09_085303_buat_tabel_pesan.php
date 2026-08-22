<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesan', function (Blueprint $table) {
            $table->id('kdpesan');

            // Pengirim (Bisa penyewa terdaftar atau tamu)
            $table->unsignedBigInteger('idpenyewa')->nullable();
            $table->string('nama'); // Diisi otomatis jika login, manual jika tamu
            $table->string('email');
            $table->string('telp')->nullable();

            // Isi Pesan
            $table->string('judul');
            $table->text('isi');
            $table->dateTime('tgl'); // Pengganti created_at

            // Status & Balasan
            $table->enum('status', ['pending', 'read', 'replied'])->default('pending');
            $table->text('balasan')->nullable();
            $table->dateTime('tglbalas')->nullable();
            $table->unsignedBigInteger('idadmin')->nullable(); // Siapa yang membalas

            // Foreign Keys
            $table->foreign('idpenyewa')->references('idpenyewa')->on('penyewa')->nullOnDelete();
            $table->foreign('idadmin')->references('idadmin')->on('admin')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan');
    }
};
