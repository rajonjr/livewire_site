<?php

use App\Livewire\Auth\ConfirmPassword;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\TwoFactorChallenge;
use App\Livewire\Auth\VerifyEmail;
use App\Livewire\Billing;
use App\Livewire\BookingManager;
use App\Livewire\Welcome;
use App\Models\Booking;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', Welcome::class)->name('home');

Route::get('/booking', BookingManager::class)->name('booking')->middleware(['auth', 'verified']);
Route::get('/booking/success', function (Request $request) {
    Booking::create([
        'user_id' => Auth::id(),
        'desk_id' => $request->desk_id,
        'start_time' => $request->start,
        'end_time' => $request->end,
        'total_price' => $request->price,
        'status' => 'paid',
        'payment_id' => $request->session_id,
    ]);

    Invoice::create([
        'user_id' => Auth::id(),
        'invoice_number' => 'INV-'.date('Y').'-'.strtoupper(Str::random(6)),
        'amount' => $request->price,
        'status' => 'paid',
        'due_date' => now(),
    ]);

    return redirect()->route('dashboard')->with('success', 'Paiement réussi et réservation confirmée !');
})->name('booking.success');

Route::get('/booking/cancel', function () {
    return redirect()->route('booking.index')->with('error', 'Le paiement a été annulé.');
})->name('booking.cancel');

Route::get('/billing', Billing::class)->name('billing')->middleware(['auth']);

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/forgot-password', ForgotPassword::class)
    ->middleware('guest')
    ->name('password.request');
Route::get('/reset-password/{token}', ResetPassword::class)
    ->middleware('guest')
    ->name('password.reset');
Route::get('/user/confirm-password', ConfirmPassword::class)
    ->middleware('auth')
    ->name('password.confirm');
Route::get('/email/verify', VerifyEmail::class)
    ->middleware('auth')
    ->name('verification.notice');
Route::get('/two-factor-challenge', TwoFactorChallenge::class)
    ->middleware('guest')
    ->name('two-factor.login');
