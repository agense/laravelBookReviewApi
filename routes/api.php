<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

//Authentication routes
Route::post('/register', 'API\Auth\AuthController@register');
Route::post('/login', 'API\Auth\AuthController@login');
Route::post('/forgot-password', 'Api\Auth\ForgotPasswordController@sendResetLinkEmail')->name('api.forgot-password');
Route::post('/reset-password', 'Api\Auth\ResetPasswordController@reset')->name('api.reset-password');

//Users
Route::get('/users/profile/', 'API\UsersController@profile');
Route::put('/users/profile/', 'API\UsersController@updateProfile');
Route::put('/users/resetPassword/', 'API\UsersController@resetPassword');
Route::apiResource('users', 'API\UsersController', ['except' => ['store', 'update']]);

//Genres
Route::apiResource('genres', 'API\GenresController');

//Authors
Route::apiResource('authors', 'API\AuthorsController');

//Books
Route::apiResource('books', 'API\BooksController');

//Reviews
Route::apiResource('reviews', 'API\ReviewsController');

//Statictics
Route::get('/statistics', 'API\ApiStatisticsController@index');