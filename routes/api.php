<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PropertyController;
use App\Http\Controllers\API\SocialAuthController;
use App\Http\Controllers\API\PasswordResetController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
// use Illuminate\Http\Request;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


//Google OAuth Login and stuff
Route::get('/auth/google/redirect', [SocialAuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/properties', [PropertyController::class, 'store']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/my-properties', [PropertyController::class, 'myProperties']);
});


Route::get('/properties', [PropertyController::class, 'index']);

//Email Verification


// Send verification email (must be authenticated)
Route::middleware(['auth:sanctum'])->get('/email/verify', function (Request $request) {
    if ($request->user()->hasVerifiedEmail()) {
        return response()->json(['message' => 'Already verified']);
    }

    $request->user()->sendEmailVerificationNotification();
    return response()->json(['message' => 'Verification link sent']);
});

// Verify the email with signed URL
Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    $user = \App\Models\User::find($id);

    if (! $user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        return response()->json(['error' => 'Invalid hash'], 403);
    }

    if ($user->hasVerifiedEmail()) {
        return response()->json(['message' => 'Email already verified']);
    }

    $user->markEmailAsVerified();

    return response()->json(['message' => 'Email verified successfully']);
})->middleware('signed')->name('verification.verify');


// Check if email is verified
Route::middleware('auth:sanctum')->get('/email/check', function (Request $request) {
    return response()->json(['verified' => $request->user()->hasVerifiedEmail()]);
});

//Update Password
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [PasswordResetController::class, 'reset']);


