<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// Misafir kullanıcılar için rotalar
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register'); // Kayıt formu

    Route::post('register', [RegisteredUserController::class, 'store']); // Kayıt işlemi

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login'); // Giriş formu

    Route::post('login', [AuthenticatedSessionController::class, 'store']); // Giriş işlemi

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request'); // Şifre sıfırlama formu

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email'); // Şifre sıfırlama bağlantısı gönder

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset'); // Yeni şifre formu

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store'); // Yeni şifreyi kaydet
});

// Giriş yapmış kullanıcılar için rotalar
Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice'); // E-posta doğrulama uyarısı

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify'); // E-posta doğrulama işlemi

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send'); // Doğrulama e-postası gönder

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm'); // Şifre onay formu

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']); // Şifre onay işlemi

    Route::put('password', [PasswordController::class, 'update'])->name('password.update'); // Şifre güncelleme

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout'); // Oturum kapatma
});
