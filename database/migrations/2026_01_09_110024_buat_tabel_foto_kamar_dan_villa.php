<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('foto_kamar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kdkamar');
            $table->string('foto_path');
            $table->foreign('kdkamar')->references('kdkamar')->on('kamar')->onDelete('cascade');
        });

        Schema::create('foto_villa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kdvilla');
            $table->string('foto_path');
            $table->foreign('kdvilla')->references('kdvilla')->on('villa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foto_villa');
        Schema::dropIfExists('foto_kamar');
    }
};
