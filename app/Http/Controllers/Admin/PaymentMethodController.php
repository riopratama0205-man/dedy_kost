<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    public function index()
    {
        // Fetch the first/primary payment method. Create one if it doesn't exist.
        $paymentMethod = MetodePembayaran::firstOrCreate(
            ['kdmetode' => 1],
            [
                'namabank' => 'BCA',
                'norek' => '1234567890',
                'pemilikrek' => 'Dedy Kost',
                'aktif' => true,
            ]
        );

        return view('admin.payment_methods.index', compact('paymentMethod'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'namabank' => 'required|string|max:255',
            'norek' => 'required|string|max:255',
            'pemilikrek' => 'required|string|max:255',
            'gambar_qr_code' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $paymentMethod = MetodePembayaran::first();

        $data = [
            'namabank' => $request->namabank,
            'norek' => $request->norek,
            'pemilikrek' => $request->pemilikrek,
        ];

        if ($request->hasFile('gambar_qr_code')) {
            // Delete old image if exists
            if ($paymentMethod->gambar_qr_code) {
                Storage::delete('public/' . $paymentMethod->gambar_qr_code);
            }

            $path = $request->file('gambar_qr_code')->store('payment_methods', 'public');
            $data['gambar_qr_code'] = $path;
        }

        $paymentMethod->update($data);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Metode pembayaran berhasil diperbarui.');
    }
}



