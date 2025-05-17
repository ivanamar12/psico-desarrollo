<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\Password\ForgotPasswordController;
use App\Http\Controllers\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Auth\Password\SecurityQuestionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\UnlockUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
  Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register');

  Route::post('register', [RegisteredUserController::class, 'store']);

  Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

  Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
  Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
    ->name('verification.notice');

  Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

  Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('verification.send');

  Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->name('password.confirm');

  Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

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

  Route::get('/reset-password/{user}', [ResetPasswordController::class, 'showForm'])
    ->name('password.reset');
  Route::post('/reset-password', [ResetPasswordController::class, 'update'])
    ->name('password.update');
});
