<?php

namespace App\Console\Commands;

use App\Models\Kamar;
use App\Models\Villa;
use App\Models\Sewa;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateExpiredBookings extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'bookings:update-expired';

    /**
     * The console command description.
     */
    protected $description = 'Mengubah status kamar/villa menjadi tersedia apabila semua booking yang disetujui sudah melewati tanggal selesai';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();
        $kamarUpdated = 0;
        $villaUpdated = 0;

        // --- Cek Kamar ---
        $kamarTerisi = Kamar::where('status', 'terisi')->get();

        foreach ($kamarTerisi as $kamar) {
            // Cek apakah masih ada booking aktif (disetujui & belum lewat tglselesai)
            $activeBooking = Sewa::where('kdkamar', $kamar->kdkamar)
                ->where('status', 'disetujui')
                ->whereDate('tglselesai', '>=', $today)
                ->exists();

            if (!$activeBooking) {
                $kamar->update(['status' => 'tersedia']);
                $kamarUpdated++;
                $this->line("  Kamar [{$kamar->namakamar}] → tersedia");
            }
        }

        // --- Cek Villa ---
        $villaTerisi = Villa::where('status', 'terisi')->get();

        foreach ($villaTerisi as $villa) {
            // Cek apakah masih ada booking aktif (disetujui & belum lewat tglselesai)
            $activeBooking = Sewa::where('kdvilla', $villa->kdvilla)
                ->where('status', 'disetujui')
                ->whereDate('tglselesai', '>=', $today)
                ->exists();

            if (!$activeBooking) {
                $villa->update(['status' => 'tersedia']);
                $villaUpdated++;
                $this->line("  Villa [{$villa->namavilla}] → tersedia");
            }
        }

        $this->info("Selesai. {$kamarUpdated} kamar dan {$villaUpdated} villa diperbarui ke status tersedia.");

        return Command::SUCCESS;
    }
}
