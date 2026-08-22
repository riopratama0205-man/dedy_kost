<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing status values from English to Indonesian
        DB::table('sewa')->where('status', 'pending')->update(['status' => 'menunggu']);
        DB::table('sewa')->where('status', 'approved')->update(['status' => 'disetujui']);
        DB::table('sewa')->where('status', 'rejected')->update(['status' => 'ditolak']);
        DB::table('sewa')->where('status', 'cancelled')->update(['status' => 'dibatalkan']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to English
        DB::table('sewa')->where('status', 'menunggu')->update(['status' => 'pending']);
        DB::table('sewa')->where('status', 'disetujui')->update(['status' => 'approved']);
        DB::table('sewa')->where('status', 'ditolak')->update(['status' => 'rejected']);
        DB::table('sewa')->where('status', 'dibatalkan')->update(['status' => 'cancelled']);
    }
};
