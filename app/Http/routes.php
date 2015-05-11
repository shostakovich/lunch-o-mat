<?php

Route::get('/', 'MarketingController@welcome');


Route::group(['middleware' => 'auth'], function() {
	Route::resource('/lunches', 'LunchesController');
	Route::post('/lunches/{id}/signup', 'LunchesController@signup')->where('id', '[0-9]+');;
	Route::post('/lunches/{id}/cancel', 'LunchesController@cancel')->where('id', '[0-9]+');;

	Route::resource('/circles', 'CirclesController');
	Route::get('/home', 'PagesController@home');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
