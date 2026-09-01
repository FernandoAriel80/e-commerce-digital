<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('pages.home'))->name('home');



Route::middleware('guest')->group(function () {
    // forgot password
    Route::get('/olvide-contraseña', fn() => view('pages.auth.forgot-password'))->name('password.request');
    Route::post('/olvide-contraseña', [AuthController::class, 'forgotPassword'])->name('password.email');

    Route::get('/recuperar-contraseña/{token}', fn(string $token) => view('pages.auth.reset-password', ['token' => $token]))->name('password.reset');

    Route::post('/recuperar-contraseña', [AuthController::class, 'resetPassword'])->name('password.update');

    // end forgot password
});


Route::get('/inicia-sesión', fn() => view('pages.auth.login'))->name('login');
Route::post('/inicia-sesión', [AuthController::class, 'login'])->middleware('throttle:5,5')->name('login.post');

Route::get('/registrar-usuario', fn() => view('pages.auth.register'))->name('register');
Route::post('/registrar-usuario', [AuthController::class, 'register'])->name('register.post');

Route::get('/auth/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/cerrar-sesión', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile-general', [ProfileController::class, 'profileViewGeneral'])->name('profile.general');
    Route::put('/cambiar-contraseña', [ProfileController::class, 'changePassword'])->name('change.password');
    Route::get('/profile-example', fn() => view('pages.profile.profile-example'))->name('profile.example');


    Route::get('/eliminar-cuenta', fn() => view('pages.profile.delete'))->name('delete.view');
    Route::delete('/eliminar-cuenta', [ProfileController::class, 'delete'])->name('delete.account');
    
});


Route::get('/email/verify', fn() => view('pages.auth.verify-email'))->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'emailVerify'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [AuthController::class, 'emailNotification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
/* 
Route::middleware(['auth', 'verified', 'auth.session'])->group(function () {
});
 */