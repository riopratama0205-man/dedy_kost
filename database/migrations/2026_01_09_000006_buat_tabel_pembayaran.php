<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('kdpembayaran');
            $table->foreignId('kdsewa')->constrained('sewa', 'kdsewa')->onDelete('cascade');
            $table->decimal('jumlahbayar', 12, 2);
            $table->date('tglbayar');
            $table->string('buktibayar')->nullable();
            $table->string('bulan');
            $table->string('tahun');
            $table->string('status')->default('pending');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
