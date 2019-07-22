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


	Route::prefix('car')->group(function () {
		Route::get('/{slug}', [
			'as' => 'car.detail',
			'uses' => 'Client\BookingController@carDetail'
		]);
	
		Route::post('/booking', [
			'as' => 'car.booking',
			'uses' => 'Client\BookingController@booking'
		]);
		
		Route::post('/booking/confirm', [
			'as' => 'car.booking.confirm',
			'uses' => 'Client\BookingController@confirmBooking'
		]);
	
		Route::get('/filter', [
			'as' => 'car.filter',
			'uses' => 'Client\FilterController@filter'
		]);
	});	

	Route::group(['middleware' => ['check-auth']], function(){
		Route::prefix('user')->group(function () {
			Route::get('/account', [
				'as'=> 'user.account',
				'uses'=> 'UserController@getAccount'
			]);
		
			Route::get('/account/editinfo', [
				'as'=> 'user.account.editinfo',
				'uses'=> 'UserController@editInfo'
			]);
		
			Route::post('/account/saveinfo', [
				'as'=> 'user.account.saveinfo',
				'uses'=> 'UserController@saveInfo'
			]);
		
			Route::get('/account/editphonenumber', [
				'as'=> 'user.account.editphonenumber',
				'uses'=> 'UserController@editPhoneNumber'
			]);
		
			Route::post('/account/savephonenumber', [
				'as'=> 'user.account.saveinfo',
				'uses'=> 'UserController@savePhoneNumber'
			]);
		
			Route::get('/account/editemail', [
				'as'=> 'user.account.editemail',
				'uses'=> 'UserController@editEmail'
			]);
		
			Route::post('/account/saveemail', [
				'as'=> 'user.account.saveemail',
				'uses'=> 'UserController@saveEmail'
			]);
		
			Route::get('/mytrips', [
				'as'=> 'user.mytrips',
				'uses'=> 'Client\BookingController@getMyTrips'
			]);
		});

		
		
		Route::get('/trip/detail/{tripCode}', [
			'as' => 'trip.detail',
			'uses' => 'Client\BookingController@tripDetail'
		]);

	});
	




