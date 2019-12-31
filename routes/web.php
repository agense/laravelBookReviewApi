<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('landingpage');

Route::get('/endpoints', function () {
    return view('endpoints');
});

