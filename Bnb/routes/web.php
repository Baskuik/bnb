<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoekingController;

Route::post('/boeking', [BoekingController::class, 'store'])->name('boeking.store');



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


