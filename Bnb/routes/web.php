<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoekingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;

// Boeking routes
Route::post('/boeking', [BoekingController::class, 'store'])->middleware('auth')->name('boeking.store');
Route::get('/bedankt-voor-je-boeking', [BoekingController::class, 'bedankt'])->name('boeking.bedankt');
Route::get('/betaal', [BoekingController::class, 'betaal'])->name('boeking.betaalpagina');
Route::post('/bevestiging', [BoekingController::class, 'bevestiging'])->name('boeking.bevestiging');
Route::get('/geboekte-datums', [BoekingController::class, 'geboekteDatums']);
Route::get('/api/geboekte-datums', [BoekingController::class, 'geboekteDatums']);

// Algemene pagina-routes
Route::view('/', 'home');
Route::view('/booking', 'booking');
Route::view('/reviews', 'reviews');
Route::view('/details', 'details');

// Auth routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profielpagina
Route::get('/profile', function () {
    $user = Auth::user();
    $boekingen = $user->boekingen()->latest()->get();
    return view('profile', compact('user', 'boekingen'));
})->middleware('auth')->name('profile');

// Admin routes (alleen voor ingelogde admins)
Route::get('/admin', [AdminController::class, 'index']);

    // Simpele admin dashboard route (indien je alleen een view toont)
    Route::get('/admin', function () {
        return view('adminpanel');
    })->name('adminpanel');

    // Gebruikersbeheer
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('dashboard');

        Route::get('/users', [UserController::class, 'ind   ex'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });





