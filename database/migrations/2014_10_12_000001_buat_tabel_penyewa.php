<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penyewa', function (Blueprint $table) {
            $table->id('idpenyewa');
            $table->string('namapenyewa');
            $table->string('email')->unique();
            $table->string('telp')->nullable();
            $table->string('password');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyewa');
    }
};
