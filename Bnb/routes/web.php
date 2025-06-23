<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoekingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;



// Boeking routes
//gebruiker plaats boeking via de post /boeking. is alleen toegankelijk wnr je ingelogd bent door (middleware('auth')).
Route::post('/boeking', [BoekingController::class, 'store'])->middleware('auth')->name('boeking.store');
Route::get('/bedankt-voor-je-boeking', [BoekingController::class, 'bedankt'])->name('boeking.bedankt');
Route::get('/betaal', [BoekingController::class, 'betaal'])->name('boeking.betaalpagina');
Route::post('/bevestiging', [BoekingController::class, 'bevestiging'])->name('boeking.bevestiging');
Route::get('/geboekte-datums', [BoekingController::class, 'geboekteDatums']);
Route::get('/api/geboekte-datums', [BoekingController::class, 'geboekteDatums']);

// laat gwn de pagina's zien door view
Route::view('/', 'home');
Route::view('/booking', 'booking');
Route::view('/reviews', 'reviews');
Route::view('/details', 'details');

// Auth routes
//logout sluit de sessie af en redirect je naar de login page
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//profielpagina
//alleen bereikbaar voor ingelogd users (middleware). laat hun gegevens en boekingen zien.
Route::get('/profile', function () {
    $user = Auth::user();
    $boekingen = $user->boekingen()->latest()->get();
    return view('profile', compact('user', 'boekingen'));
})->middleware('auth')->name('profile');

//prefix zorg ervoor dat de urls beginnen met admin
Route::prefix('admin')->middleware(['auth', IsAdmin::class])->name('admin.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/users/{user}/boekingen', [UserController::class, 'boekingen'])->name('users.boekingen');
    Route::get('/users/{user}/boekingen/{boeking}/edit', [UserController::class, 'editBoeking'])->name('users.boekingen.edit');
    Route::put('/users/{user}/boekingen/{boeking}', [UserController::class, 'updateBoeking'])->name('users.boekingen.update');
    Route::delete('/users/{user}/boekingen/{boeking}', [UserController::class, 'destroyBoeking'])->name('users.boekingen.destroy');
});

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');







