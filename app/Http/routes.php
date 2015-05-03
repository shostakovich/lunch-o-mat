<?php

Route::get('/', 'PagesController@homepage');

Route::get('/lunches', 'LunchesController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
