<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\Password\ForgotPasswordController;
use App\Http\Controllers\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Auth\Password\SecurityQuestionController;
use App\Http\Controllers\Auth\UnlockUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
  Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login');
});

Route::middleware('auth')->group(function () {
  Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
});

/**
 * User unlock
 */
Route::middleware(['guest'])->group(function () {
  // User unlock
  Route::get('/user-unlock', [UnlockUserController::class, 'index'])
    ->name('user-unlock.request');

  Route::post('/user-unlock', [UnlockUserController::class, 'sendEmail'])
    ->name('user-unlock.email');

  Route::get('/unlock-user', [UnlockUserController::class, 'update'])
    ->name('unlock-user.reset');

  Route::post('/unlock-user', [UnlockUserController::class, 'store'])
    ->name('unlock-user.update');

  // Reset password
  Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])
    ->name('password.request');

  Route::post('/forgot-password', [ForgotPasswordController::class, 'checkEmail'])
    ->name('password.email');

  Route::get('/security-question', [SecurityQuestionController::class, 'show'])
    ->name('security.question');

  Route::post('/security-question', [SecurityQuestionController::class, 'verify'])
    ->name('security-question.verify');

  Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showForm'])
    ->name('password.reset');

  Route::post('/reset-password-update', [ResetPasswordController::class, 'update'])
    ->name('password.update');
});
