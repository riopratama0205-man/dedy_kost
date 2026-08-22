<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sewa', function (Blueprint $table) {
            $table->id('kdsewa');
            $table->foreignId('idpenyewa')->constrained('penyewa', 'idpenyewa')->onDelete('cascade');
            $table->foreignId('kdkamar')->nullable()->constrained('kamar', 'kdkamar')->onDelete('cascade');
            $table->date('tglmulai');
            $table->date('tglselesai');
            $table->string('status')->default('pending');
            $table->decimal('totalharga', 12, 2);
            $table->string('buktibayar')->nullable();
            $table->text('catatan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sewa');
    }
};
