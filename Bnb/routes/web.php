<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoekingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthController;


Route::post('/boeking', [BoekingController::class, 'store'])->middleware('auth')->name('boeking.store');
Route::get('/bedankt-voor-je-boeking', [BoekingController::class, 'bedankt'])->name('boeking.bedankt');
Route::get('/betaal', [BoekingController::class, 'betaal'])->name('boeking.betaalpagina');
Route::post('/bevestiging', [BoekingController::class, 'bevestiging'])->name('boeking.bevestiging');
Route::get('/geboekte-datums', [BoekingController::class, 'geboekteDatums']);

// Algemene pagina-routes
Route::get('/', function () {
    return view('home');
});

Route::get('/booking', function () {
    return view('booking');
});

Route::get('/reviews', function () {
    return view('reviews');
});

Route::get('/details', function () {
    return view('details');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::get('/profile', function () {
    return view('profile'); // of je profielpagina
})->middleware('auth')->name('profile');

Route::get('/profile', function () {
    $user = Auth::user();
    $boekingen = $user->boekingen()->latest()->get();

    return view('profile', compact('user', 'boekingen'));
})->middleware('auth')->name('profile');

Route::get('/api/geboekte-datums', [BoekingController::class, 'geboekteDatums']);
