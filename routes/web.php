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

	Route::get('/user/account', [
		'as'=> 'user.account',
		'uses'=> 'UserController@getAccount'
	]);

	Route::get('/user/account/editinfo', [
		'as'=> 'user.account.editinfo',
		'uses'=> 'UserController@editInfo'
	]);

	Route::post('/user/account/saveinfo', [
		'as'=> 'user.account.saveinfo',
		'uses'=> 'UserController@saveInfo'
	]);

	Route::get('/user/account/editphonenumber', [
		'as'=> 'user.account.editphonenumber',
		'uses'=> 'UserController@editPhoneNumber'
	]);

	Route::post('/user/account/savephonenumber', [
		'as'=> 'user.account.saveinfo',
		'uses'=> 'UserController@savePhoneNumber'
	]);

	Route::get('/user/account/editemail', [
		'as'=> 'user.account.editemail',
		'uses'=> 'UserController@editEmail'
	]);

	Route::post('/user/account/saveemail', [
		'as'=> 'user.account.saveemail',
		'uses'=> 'UserController@saveEmail'
	]);




	Route::get('/car/{id}', [
        'as' => 'car.detail',
        'uses' => 'Client\BookingController@getDetail'
    ]);

	Route::post('/car/booking', [
        'as' => 'car.booking',
        'uses' => 'Client\BookingController@booking'
	]);
	
	Route::post('/car/booking/confirm', [
        'as' => 'car.booking.confirm',
        'uses' => 'Client\BookingController@confirmBooking'
    ]);

	Route::get('/cars/filter', [
        'as' => 'car.filter',
        'uses' => 'Client\FilterController@filter'
    ]);



