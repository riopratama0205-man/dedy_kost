<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Penyewa;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    /**
     * Send password reset link to user's email
     */
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Check if user exists
        $user = Penyewa::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan dalam sistem.']);
        }

        // Generate token
        $token = Str::random(64);

        // Delete old tokens for this email
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Store new token
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'created_at' => Carbon::now()
        ]);

        // Send email with reset link
        $resetLink = url('/reset-password/' . $token . '?email=' . urlencode($request->email));

        Mail::send('emails.password-reset', ['resetLink' => $resetLink, 'user' => $user], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password - DEDY KOST');
        });

        return back()->with('status', 'Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.');
    }

    /**
     * Show reset password form
     */
    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    /**
     * Reset the password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Check if token exists and is valid (not expired - 60 minutes)
        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$passwordReset) {
            return back()->withErrors(['email' => 'Token reset password tidak valid.']);
        }

        // Check if token expired (60 minutes)
        if (Carbon::parse($passwordReset->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'Token reset password sudah kadaluarsa. Silakan request ulang.']);
        }

        // Verify token
        if (!Hash::check($request->token, $passwordReset->token)) {
            return back()->withErrors(['email' => 'Token reset password tidak valid.']);
        }

        // Update password
        $user = Penyewa::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User tidak ditemukan.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Delete token after successful reset
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Password berhasil direset. Silakan login dengan password baru Anda.');
    }
}

