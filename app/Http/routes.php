<?php

Route::get('/', 'PagesController@homepage');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
