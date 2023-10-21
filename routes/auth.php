<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\MyAccountController;
use Illuminate\Support\Facades\Route;



Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('login_default', [MyAccountController::class, 'loginDefault'])
                ->name('login_default');



    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');


    Route::post('register-email-confirmation', [RegisteredUserController::class, 'storeEmailConfirmation'])
        ->name('register_email_confirmation');

    Route::get('register/personal-information', [RegisteredUserController::class, 'personalInformation'])
        ->name('register_personal_information');
    Route::post('register/personal-information', [RegisteredUserController::class, 'storePersonalInformation']);

    Route::get('register/verification', [RegisteredUserController::class, 'registerVerification'])
                ->name('register_verification');
    Route::post('register/verification', [RegisteredUserController::class, 'storeRegisterVerification']);

    Route::get('register/verification-send-again', [RegisteredUserController::class, 'registerVerificationReSend'])
    ->name('user_register_verification_send_again');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');


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
