<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoekingController;
use App\Http\Controllers\ReviewController;

Route::post('/boeking', [BoekingController::class, 'store'])->name('boeking.store');
Route::get('/bedankt-voor-je-boeking', [BoekingController::class, 'bedankt'])->name('boeking.bedankt');
Route::get('/betaal', [BoekingController::class, 'betaalpagina'])->name('boeking.betaalpagina');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');




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
