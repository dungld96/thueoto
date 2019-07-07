<?php


Route::get('/', [
		'as'=> 'home-client',
		'uses'=> 'Client\HomeController@index'
	]);

	Route::get('/car-list', [
		'as'=> 'auth_car_list',
		'uses'=> 'AuthController@auth_car_list'
	]);

	Route::get('/contact', [
		'as'=> 'auth_contact',
		'uses'=> 'AuthController@auth_contact'
	]);

	Route::get('/about', [
		'as'=> 'auth_about',
		'uses'=> 'AuthController@auth_about'
	]);

	Route::get('/account', [
		'as'=> 'auth_account',
		'uses'=> 'AuthController@auth_account'
	]);

	Route::post('/loginCheck', [
		'as'=> 'auth_logincheck',
		'uses'=> 'Auth\LoginController@login'
	]);

	Route::get('/login', [
		'as'=> 'login',
		'uses'=> 'AuthController@auth_account'
	]);	

	Route::post('/registerCheck', [
		'as'=> 'auth_register',
		'uses'=> 'AuthController@auth_register'
	]);


Route::group(['prefix'=> 'user'], function(){

	Route::get('/reservation', [
		'as'=> 'user_reservation',
		'uses'=> 'UserController@user_reservation'
	]);

	Route::get('/activity-list', [
		'as'=> 'user_activity',
		'uses'=> 'UserController@user_activity'
	]);

	Route::get('/account-details', [
		'as'=> 'user_account',
		'uses'=> 'UserController@user_account'
	]);

	Route::get('/logout', [
		'as'=>'user_logout',
		'uses'=> 'UserController@user_logout'
	]);

});


