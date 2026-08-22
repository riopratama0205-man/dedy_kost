<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Penyewa;
use App\Models\Kamar;
use App\Models\Villa;
use App\Models\Sewa;
use App\Models\Pengunjung;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Password Reset Routes
Route::get('forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('forgot-password', [App\Http\Controllers\Auth\PasswordResetController::class, 'sendResetLink'])
    ->middleware('guest')
    ->name('password.email');

Route::get('reset-password/{token}', [App\Http\Controllers\Auth\PasswordResetController::class, 'showResetForm'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('reset-password', [App\Http\Controllers\Auth\PasswordResetController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');

Route::get('/', function () {
    $totalKamar = Kamar::count();
    $totalVilla = Villa::count();
    return view('home', compact('totalKamar', 'totalVilla'));
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/admin/login', function () {
    return view('auth.login-admin');
})->name('admin.login');

// Auth Routes
Route::post('/login', function (\Illuminate\Http\Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    $user = Penyewa::where('email', $email)->first();

    if (!$user || !Hash::check($password, $user->password)) {
        return back()->with('error', 'Email atau password salah.');
    }

    Auth::guard('web')->login($user);
    return redirect('/dashboard');
});

Route::post('/register', [App\Http\Controllers\PengunjungController::class, 'pendaftaran'])->name('register.submit');

Route::post('/admin/login', function (\Illuminate\Http\Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    $user = Admin::where('email', $email)->first();

    if (!$user || !Hash::check($password, $user->password)) {
        return back()->with('error', 'Email atau password admin salah.');
    }

    Auth::guard('admin')->login($user);
    return redirect('/admin/dashboard');
});

Route::post('/admin/register', function (\Illuminate\Http\Request $request) {
    $user = Admin::create([
        'namaadmin' => $request->input('name') ?? 'Admin Baru',
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password') ?? 'password'),
    ]);

    Auth::guard('admin')->login($user);
    return redirect('/admin/dashboard');
});

// Public Routes
Route::get('/panduan', function () {
    return view('panduan');
});

Route::get('/kost', function () {
    $rooms = Kamar::with('fotoKamar')->get();
    return view('kost', compact('rooms'));
});

Route::get('/villa', function () {
    $villas = Villa::with('fotoVilla')->get();
    return view('villa', compact('villas'));
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::post('/kontak', [App\Http\Controllers\GuestMessageController::class, 'store'])->name('guest.messages.store');

Route::post('/logout', function () {
    Auth::guard('web')->logout();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::post('/admin/logout', function () {
    Auth::guard('admin')->logout();
    request()->session()->regenerateToken();
    return redirect('/admin/login');
})->name('admin.logout');

// Authenticated Routes (Admin)
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        try {
            $totalMessages = Penyewa::count();
            $totalRooms = Kamar::count() + Villa::count();

            $occupiedKamarIds = Sewa::where('status', 'disetujui')
                ->where('kdkamar', '!=', null)
                ->whereDate('tglmulai', '<=', now())
                ->whereDate('tglselesai', '>=', now())
                ->pluck('kdkamar');

            $occupiedVillaIds = Sewa::where('status', 'disetujui')
                ->where('kdvilla', '!=', null)
                ->whereDate('tglmulai', '<=', now())
                ->whereDate('tglselesai', '>=', now())
                ->pluck('kdvilla');

            $emptyRooms = $totalRooms - ($occupiedKamarIds->count() + $occupiedVillaIds->count());

            $activeTenants = Sewa::where('status', 'disetujui')
                ->whereDate('tglselesai', '>=', now())
                ->distinct('idpenyewa')
                ->count('idpenyewa');

            $monthlyRevenue = Sewa::where('status', 'disetujui')
                ->whereMonth('tglmulai', now()->month)
                ->whereYear('tglmulai', now()->year)
                ->sum('totalharga');

            $recentTenants = Sewa::with(['penyewa', 'kamar', 'villa'])
                ->where('status', 'disetujui')
                ->orderBy('kdsewa', 'desc')
                ->take(8)
                ->get();

            $bookingsToday = Sewa::whereDate('tglmulai', today())->count();
            $pendingBookings = Sewa::where('status', 'menunggu')->count();
            $totalKamar = Kamar::count();
            $totalVilla = Villa::count();

            return view('admin.dashboard', compact(
                'totalRooms',
                'totalKamar',
                'totalVilla',
                'emptyRooms',
                'activeTenants',
                'monthlyRevenue',
                'recentTenants',
                'pendingBookings',
                'totalMessages',
                'bookingsToday'
            ));

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Dashboard Error: ' . $e->getMessage());
            return view('admin.dashboard', [
                'totalRooms' => 0,
                'totalKamar' => 0,
                'totalVilla' => 0,
                'emptyRooms' => 0,
                'activeTenants' => 0,
                'monthlyRevenue' => 0,
                'recentTenants' => [],
                'pendingBookings' => 0,
                'totalMessages' => 0,
                'bookingsToday' => 0
            ]);
        }
    })->name('admin.dashboard');


    // Admin Message Routes
    Route::get('/admin/messages', [App\Http\Controllers\Admin\MessageController::class, 'index'])->name('admin.messages.index');
    Route::get('/admin/messages/{id}', [App\Http\Controllers\Admin\MessageController::class, 'show'])->name('admin.messages.show');
    Route::post('/admin/messages/{id}/reply', [App\Http\Controllers\Admin\MessageController::class, 'reply'])->name('admin.messages.reply');
    Route::delete('/admin/messages/{id}', [App\Http\Controllers\Admin\MessageController::class, 'destroy'])->name('admin.messages.destroy');

    // Room Management
    Route::get('/admin/rooms', [App\Http\Controllers\Admin\RoomController::class, 'index'])->name('admin.rooms.index');
    Route::get('/admin/rooms/create', [App\Http\Controllers\Admin\RoomController::class, 'create'])->name('admin.rooms.create');
    Route::post('/admin/rooms', [App\Http\Controllers\Admin\RoomController::class, 'store'])->name('admin.rooms.store');
    Route::get('/admin/rooms/{id}/edit', [App\Http\Controllers\Admin\RoomController::class, 'edit'])->name('admin.rooms.edit');
    Route::get('/admin/rooms/{id}', [App\Http\Controllers\Admin\RoomController::class, 'show'])->name('admin.rooms.show');
    Route::put('/admin/rooms/{id}', [App\Http\Controllers\Admin\RoomController::class, 'update'])->name('admin.rooms.update');
    Route::delete('/admin/rooms/{id}', [App\Http\Controllers\Admin\RoomController::class, 'destroy'])->name('admin.rooms.destroy');

    // Booking Management
    Route::get('/admin/bookings', [App\Http\Controllers\Admin\BookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('/admin/bookings/create', [App\Http\Controllers\Admin\BookingController::class, 'create'])->name('admin.bookings.create');
    Route::post('/admin/bookings', [App\Http\Controllers\Admin\BookingController::class, 'store'])->name('admin.bookings.store');
    Route::get('/admin/bookings/{id}/edit', [App\Http\Controllers\Admin\BookingController::class, 'edit'])->name('admin.bookings.edit');
    Route::put('/admin/bookings/{id}', [App\Http\Controllers\Admin\BookingController::class, 'update'])->name('admin.bookings.update');
    Route::delete('/admin/bookings/{id}', [App\Http\Controllers\Admin\BookingController::class, 'destroy'])->name('admin.bookings.destroy');
    Route::patch('/admin/bookings/{id}/status', [App\Http\Controllers\Admin\BookingController::class, 'updateStatus'])->name('admin.bookings.update-status');

    Route::get('/admin/tenants', [App\Http\Controllers\Admin\TenantController::class, 'index'])->name('admin.tenants.index');
    Route::get('/admin/tenants/{id}', [App\Http\Controllers\Admin\TenantController::class, 'show'])->name('admin.tenants.show');
    Route::delete('/admin/tenants/{id}', [App\Http\Controllers\Admin\TenantController::class, 'destroy'])->name('admin.tenants.destroy');

    // Financial Report
    Route::get('/admin/reports/financial', [App\Http\Controllers\Admin\FinancialReportController::class, 'index'])->name('admin.reports.financial');
    Route::get('/admin/reports/financial/print', [App\Http\Controllers\Admin\FinancialReportController::class, 'print'])->name('admin.reports.financial.print');

    Route::get('/admin/finance', [App\Http\Controllers\Admin\FinanceController::class, 'index'])->name('admin.finance.index');
    Route::get('/admin/finance/print', [App\Http\Controllers\Admin\FinanceController::class, 'print'])->name('admin.finance.print');

    // Payment Methods (Single Resource)
    Route::get('/admin/payment-methods', [App\Http\Controllers\Admin\PaymentMethodController::class, 'index'])->name('admin.payment-methods.index');
    Route::put('/admin/payment-methods', [App\Http\Controllers\Admin\PaymentMethodController::class, 'update'])->name('admin.payment-methods.update');

    Route::get('/admin/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.settings.index');
    Route::put('/admin/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.update');
});

// Authenticated Routes (User)
Route::middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/profile/edit', [App\Http\Controllers\User\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [App\Http\Controllers\User\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/rooms', [App\Http\Controllers\User\BookingController::class, 'index'])->name('user.rooms.index');
    Route::get('/rooms/type/{type}', [App\Http\Controllers\User\BookingController::class, 'list'])->name('user.rooms.list');
    Route::get('/rooms/{id}', [App\Http\Controllers\User\BookingController::class, 'show'])->name('user.rooms.show');
    // User message routes
    Route::get('/messages', [App\Http\Controllers\User\MessageController::class, 'index'])->name('user.messages.index');
    Route::post('/messages', [App\Http\Controllers\User\MessageController::class, 'store'])->name('user.messages.store');

    Route::get('/bookings/create/{id}', [App\Http\Controllers\User\BookingController::class, 'create'])->name('user.bookings.create');
    Route::post('/bookings', [App\Http\Controllers\User\BookingController::class, 'store'])->name('user.bookings.store');
    Route::delete('/bookings/{id}', [App\Http\Controllers\User\BookingController::class, 'destroy'])->name('user.bookings.destroy');
    Route::get('/bookings/{id}/ticket', [App\Http\Controllers\User\BookingController::class, 'ticket'])->name('user.bookings.ticket');
});
