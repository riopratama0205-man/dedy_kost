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
        Schema::table('penyewa', function (Blueprint $table) {
            $table->renameColumn('is_new', 'penyewa_baru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyewa', function (Blueprint $table) {
            $table->renameColumn('penyewa_baru', 'is_new');
        });
    }
};
