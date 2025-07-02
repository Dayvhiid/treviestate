<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PasswordResetController;


Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');


Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

