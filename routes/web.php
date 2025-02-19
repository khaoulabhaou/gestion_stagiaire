<?php

use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\PasswordController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function() {
    return view('home');
});

Route::get('/login', function(){
    return view('login');
});

Route::get('/register',function(){
    return view('register');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Redirect to the home page or any other page
})->name('logout');

Route::get('/demande', function(){
    return view('demande');
});
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');

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

// Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});


// Route::get('/forgot-password', 'auth.forgot-password')->name('password.request');

//Resetting password
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
->name('password.email');
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])
->name('password.store');