<?php

use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\EncadrantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\HomController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function() {
    return view('home');
});

Route::get('/index', function () {
    return view('index'); 
})->name('index');


Route::get('/sidebar',function (){
    return view('layouts.sidebar');
});

Route::get('/login', function(){
    return view('login');
});

Route::get('/register',function(){
    return view('register');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/demande', function(){
    return view('demande');
});
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');

//authontification routes
Route::middleware('auth')->group(function () {
    // User Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('verified')->name('dashboard');
    
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

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});

//Resetting password
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
->name('password.email');
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])
->name('password.store');

//Stage routes
Route::get('/stages/create', [StageController::class, 'create'])->name('stages.create');
Route::post('/stages/store', [StageController::class, 'store'])->name('stages.store');
Route::get('/ajouter', function(){
    return view('stages.ajouter');
});
Route::get('/stagiaires/{serviceId}', [StageController::class, 'getStagiairesByService'])->name('stagiaires.byService');
Route::get('/stages', [StageController::class, 'index'])->name('stages.index');
Route::get('/stages/{id}/edit', [StageController::class, 'edit'])->name('stages.edit');
Route::put('/stages/{id}', [StageController::class, 'update'])->name('stages.update');
Route::delete('/stages/{id}', [StageController::class, 'destroy'])->name('stages.destroy');


//Stagiaire routes
Route::get('/stagiaires', [HomController::class, 'create'])->name('stagiaires.create');
Route::post('/stagiaires/store', [HomController::class, 'store'])->name('stagiaires.store');
Route::post('/stagiaires', [HomController::class, 'index'])->name('index');
Route::get('/list', [HomController::class, 'index'])->name('list');
Route::get('/stagiaires/{id}/edit', [HomController::class, 'edit'])->name('stagiaires.edit');
Route::put('/stagiaires/{id}/update', [HomController::class, 'update'])->name('stagiaires.update');
Route::delete('/stagiaires/{id}', [HomController::class, 'destroy'])->name('stagiaires.destroy');

//Archive routes
Route::get('/archive', [HomController::class, 'archive'])->name('archive');
Route::get('/archives/edit/{id}', [HomController::class, 'editArchive'])->name('archives.edit');
Route::put('/archives/update/{id}', [HomController::class, 'updateArchive'])->name('archives.update');
Route::delete('/archives/delete/{id}', [HomController::class, 'destroyArchive'])->name('archives.destroy');

// Encadrant Routes
Route::get('/encadrants', [EncadrantController::class, 'index'])->name('encadrants.list');
Route::get('/encadrants/create', [EncadrantController::class, 'create'])->name('encadrants.create');
Route::post('/encadrants/store', [EncadrantController::class, 'store'])->name('encadrants.store');
Route::get('/encadrants/{id}/edit', [EncadrantController::class, 'edit'])->name('encadrants.edit');
Route::put('/encadrants/{id}/update', [EncadrantController::class, 'update'])->name('encadrants.update');
Route::delete('/encadrants/{id}', [EncadrantController::class, 'destroy'])->name('encadrants.destroy');