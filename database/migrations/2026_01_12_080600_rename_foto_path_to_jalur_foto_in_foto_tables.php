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
        // Rename column in foto_kamar table
        Schema::table('foto_kamar', function (Blueprint $table) {
            $table->renameColumn('foto_path', 'jalur_foto');
        });

        // Rename column in foto_villa table
        Schema::table('foto_villa', function (Blueprint $table) {
            $table->renameColumn('foto_path', 'jalur_foto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse rename in foto_kamar table
        Schema::table('foto_kamar', function (Blueprint $table) {
            $table->renameColumn('jalur_foto', 'foto_path');
        });

        // Reverse rename in foto_villa table
        Schema::table('foto_villa', function (Blueprint $table) {
            $table->renameColumn('jalur_foto', 'foto_path');
        });
    }
};
