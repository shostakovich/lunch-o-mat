<?php

Route::get('/', 'PagesController@homepage');

Route::get('/lunches', ['middleware' => 'auth', 'uses' => 'LunchesController@index']);
Route::post('/lunches/{id}/signup', ['middleware' => 'auth', 'uses' => 'LunchesController@signup'])->where('id', '[0-9]+');;

Route::resource('/circles', 'CirclesController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
