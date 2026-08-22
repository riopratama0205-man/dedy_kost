<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sewa', function (Blueprint $table) {
            $table->string('kode_booking', 20)->nullable()->unique()->after('kdsewa');
        });

        // Generate kode untuk booking yang sudah ada
        \App\Models\Sewa::whereNull('kode_booking')->each(function ($sewa) {
            $sewa->update(['kode_booking' => 'DK-' . strtoupper(Str::random(6))]);
        });
    }

    public function down(): void
    {
        Schema::table('sewa', function (Blueprint $table) {
            $table->dropColumn('kode_booking');
        });
    }
};
