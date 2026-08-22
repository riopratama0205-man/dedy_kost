<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kamar', function (Blueprint $table) {
            $table->id('kdkamar');
            $table->string('namakamar');
            $table->string('tipekamar');
            $table->decimal('hargasewa', 12, 2);
            $table->text('fasilitas')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('status')->default('available');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};
