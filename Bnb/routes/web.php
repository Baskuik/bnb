<?php

use Illuminate\Support\Facades\Route;

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
