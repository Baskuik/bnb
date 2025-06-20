<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoekingController;
use App\Http\Controllers\ReviewController;

Route::post('/boeking', [BoekingController::class, 'store'])->name('boeking.store');
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

Route::get('/', fn() => view('home'));
Route::get('/booking', fn() => view('booking'));
Route::get('/details', fn() => view('details'));