<?php


	Route::get('/', [
		'as'=> 'home-client',
		'uses'=> 'Client\HomeController@index'
	]);

	Route::get('/signup', [
		'as'=> 'user.signup',
		'uses'=> 'Auth\RegisterController@register'
	]);
	Route::post('/signup/create', [
		'as'=> 'user.signup.create',
		'uses'=> 'Auth\RegisterController@create'
	]);
	Route::get('/login/view', [
		'as'=> 'user.login.view',
		'uses'=> 'Auth\LoginController@loginView'
	]);
	Route::post('/login/check', [
		'as'=> 'user.login.check',
		'uses'=> 'Auth\LoginController@login'
	]);
	Route::get('/logout', [
		'as'=> 'user.logout',
		'uses'=> 'Auth\LoginController@logout'
	]);


