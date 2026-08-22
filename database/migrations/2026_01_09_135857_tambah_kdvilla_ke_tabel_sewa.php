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
        Schema::table('sewa', function (Blueprint $table) {
            $table->foreignId('kdvilla')->nullable()->after('kdkamar')->constrained('villa', 'kdvilla')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sewa', function (Blueprint $table) {
            $table->dropForeign(['kdvilla']);
            $table->dropColumn('kdvilla');
        });
    }
};
