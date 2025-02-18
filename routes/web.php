<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleAuthController;
use App\Mail\MyTestEmail;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function() {
    return view('home');
});

// Route::post('/register', [UserController::class, 'register'])->name('register');
// Route::post('/logout', [UserController::class, 'logout']);

Route::get('/login', function(){
    return view('login');
});

Route::get('/register',function(){
    return view('register');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redirect to the home page or any other page
})->name('logout');

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/callback', [GoogleAuthController::class,'callbackGoogle']);

// Routes for authenticated users
Route::middleware('auth')->group(function () {
    // User Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

    // Logout Route
    // Email Verification Notice route
    Route::get('/email/verify', [AuthController::class, 'verifyEmailNotice'])->name('verification.notice');

    // Email Verification Handler route
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmailHandler'])->middleware('signed')->name('verification.verify');

    // Resending the Verification Email route
    Route::post('/email/verification-notification', [AuthController::class, 'verifyEmailResend'])->middleware('throttle:6,1')->name('verification.send');
});

Route::get('/testroute',function(){
    $name = 'AULSH';
    Mail::to('khaoulabhaou@gmail.com')->send(new MyTestEmail($name));
});

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
