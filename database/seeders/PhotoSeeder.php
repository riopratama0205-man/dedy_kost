<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Kamar;
use App\Models\Villa;
use App\Models\FotoKamar;
use App\Models\FotoVilla;

class PhotoSeeder extends Seeder
{
    public function run()
    {
        // 1. Clean tables by truncating (resets IDs)
        // Disable foreign key checks to allow truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('foto_kamar')->truncate();
        DB::table('foto_villa')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('Tables truncated.');

        // 2. Prepare Storage
        Storage::disk('public')->makeDirectory('photos/kamar');
        Storage::disk('public')->makeDirectory('photos/villa');

        // 3. Get Source Images
        $kamarImages = glob(public_path('images/kamar/*.{jpg,jpeg,png,webp}'), GLOB_BRACE);
        $villaImages = glob(public_path('images/villas/*.{jpg,jpeg,png,webp}'), GLOB_BRACE);

        // Fallback or explicit check
        if (empty($kamarImages)) {
            $kamarImages = glob(public_path('images/kamar/*'));
        }
        if (empty($villaImages)) {
            $villaImages = glob(public_path('images/villas/*'));
        }

        if (empty($kamarImages)) {
            $this->command->warn("No images found in public/images/kamar");
        } else {
            $this->command->info('Found ' . count($kamarImages) . ' kamar images.');
        }

        if (empty($villaImages)) {
            $this->command->warn("No images found in public/images/villas");
        } else {
            $this->command->info('Found ' . count($villaImages) . ' villa images.');
        }

        // 4. Seed Kamar
        $kamars = Kamar::all();
        foreach ($kamars as $kamar) {
            if (empty($kamarImages))
                continue;

            // Assign ALL images to every unit as requested
            foreach ($kamarImages as $file) {
                if (is_dir($file))
                    continue;

                $filename = basename($file);
                // Create unique path in storage
                $targetPath = 'photos/kamar/' . $kamar->kdkamar . '_' . uniqid() . '_' . $filename;

                // Copy file content
                Storage::disk('public')->put($targetPath, File::get($file));

                FotoKamar::create([
                    'kdkamar' => $kamar->kdkamar,
                    'foto_path' => $targetPath
                ]);
            }
        }
        $this->command->info('Seeded Kamar photos (ALL images per unit).');

        // 5. Seed Villa
        $villas = Villa::all();
        foreach ($villas as $villa) {
            if (empty($villaImages))
                continue;

            // Assign ALL images
            foreach ($villaImages as $file) {
                if (is_dir($file))
                    continue;

                $filename = basename($file);
                $targetPath = 'photos/villa/' . $villa->kdvilla . '_' . uniqid() . '_' . $filename;

                Storage::disk('public')->put($targetPath, File::get($file));

                FotoVilla::create([
                    'kdvilla' => $villa->kdvilla,
                    'foto_path' => $targetPath
                ]);
            }
        }
        $this->command->info('Seeded Villa photos (ALL images per unit).');
    }
}
