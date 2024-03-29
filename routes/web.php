<?php

	Route::get('/', [
		'as'=> 'home-client',
		'uses'=> 'Client\HomeController@index'
	]);

	Route::get('/logout', [
		'as'=> 'user.logout',
		'uses'=> 'Auth\LoginController@logout'
	]);

	Route::group(['middleware' => ['check-no-auth']], function(){
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
	
		Route::get('/login/facebook', [
			'as'=> 'login.facebook',
			'uses'=> 'Auth\FaceBookAuthController@redirectToProvider'
		]);
	
		Route::get('/login/facebook/callback', [
			'as'=> 'login.facebook.callback',
			'uses'=> 'Auth\FaceBookAuthController@handleProviderCallback'
		]);
	
		Route::get('/login/google', [
			'as'=> 'login.google',
			'uses'=> 'Auth\GoogleAuthController@redirectToProvider'
		]);
	
		Route::get('/login/google/callback', [
			'as'=> 'login.google.callback',
			'uses'=> 'Auth\GoogleAuthController@handleProviderCallback'
		]);
	});


	Route::prefix('car')->group(function () {
		Route::get('/filter', [
			'as' => 'car.filter',
			'uses' => 'Client\FilterController@filter'
		]);

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

		Route::get('car-spec/{id}', [
			'as' => 'car.car-spec',
			'uses' => 'Client\BookingController@viewCarSpec'
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

			Route::get('/password', [
				'as'=> 'user.changepassword',
				'uses'=> 'UserController@changePassword'
			]);

			Route::post('/password/update', [
				'as'=> 'user.updatepassword',
				'uses'=> 'UserController@updatePassword'
			]);
		
			Route::get('/mytrips', [
				'as'=> 'user.mytrips',
				'uses'=> 'Client\BookingController@getMyTrips'
			]);


		});

		Route::prefix('trip')->group(function () {
			Route::get('/detail/{tripCode}', [
				'as' => 'trip.detail',
				'uses' => 'Client\BookingController@tripDetail'
			]);
			
			Route::get('/cancel/{tripCode}', [
				'as' => 'trip.cancel',
				'uses' => 'Client\BookingController@tripCancel'
			]);

			Route::get('/return/{tripCode}', [
				'as' => 'trip.return',
				'uses' => 'Client\BookingController@tripReturn'
			]);

		});		
		

	});
	
	Route::get('/getModels/{makeId}', [
		'as' => 'get.models.by.make',
		'uses' => 'SharedController@getModels'
	]);

	Route::prefix('coupon')->group(function () {
		Route::get('/my-coupons', [
			'as' => 'coupon.my-coupons',
			'uses' => 'Client\BookingController@getMyCoupons'
		]);

		Route::get('/check-coupon/{id}', [
			'as' => 'coupon.check-coupon',
			'uses' => 'Client\BookingController@checkCoupon'
		]);

		Route::get('/search', [
			'as' => 'coupon.search',
			'uses' => 'Client\BookingController@searchCoupon'
		]);
	});		


