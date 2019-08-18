<?php
Route::group(['middleware' => ['access-dashboard']], function(){

	Route::get('/users/changepassword', [
		'as'=> 'users.changepassword',
		'uses'=> 'Admin\AdminController@changePassword'
	]);
	
	Route::post('/users/updatepassword', [
		'as'=> 'users.updatepassword',
		'uses'=> 'Admin\AdminController@updatePassword'
	]);
	
	Route::get('/', [
		'as'=> 'dashboard',
		'uses'=> 'Admin\DashboardController@index'
	]);

	Route::get('/dashboard', [
		'as'=> 'dashboard',
		'uses'=> 'Admin\DashboardController@index'
	]);

	Route::post('/images/upload/store', [
		'as'=> 'upload_image_store',
		'uses'=> 'ImagesController@imageStore'
	]);

	Route::post('/images/remove/{name}', [
		'as'=> 'admin_car_image_remove',
		'uses'=> 'ImagesController@imageRemove'
	]);

	Route::prefix('cars')->group(function () {
		Route::get('/', [
			'as'=> 'admin_cars_index',
			'uses'=> 'Admin\CarController@index'
		]);
	
		Route::get('/getdata', [
			'as'=> 'admin_cars_getdata',
			'uses'=> 'Admin\CarController@getAll'
		]);
	
		Route::post('/store', [
			'as'=> 'admin_car_store',
			'uses'=> 'Admin\CarController@store'
		]);
	
		Route::get('/create', [
			'as'=> 'car.create',
			'uses'=> 'Admin\CarController@create'
		]);
	
		Route::get('/edit/{id}', [
			'as' => 'car.edit',
			'uses' => 'Admin\CarController@edit'
		]);
		
		Route::put('/update', [
			'as' => 'car.update',
			'uses' => 'Admin\CarController@update'
		]);
	
		Route::get('/delete/{id}', [
			'as' => 'car.delete',
			'uses' => 'Admin\CarController@delete'
		]);

		Route::prefix('models')->group(function () {
			Route::get('/', [
				'as'=> 'cars.models.list',
				'uses'=> 'Admin\CarModelController@index'
			]);
			Route::get('/getdata', [
				'as'=> 'cars.models.getdata',
				'uses'=> 'Admin\CarModelController@getCarModels'
			]);
			Route::get('/create', [
				'as'=> 'cars.models.create',
				'uses'=> 'Admin\CarModelController@create'
			]);
			Route::post('/store', [
				'as'=> 'cars.models.store',
				'uses'=> 'Admin\CarModelController@store'
			]);
			Route::get('/edit/{id}', [
				'as'=> 'cars.models.edit',
				'uses'=> 'Admin\CarModelController@edit'
			]);
			Route::post('/update', [
				'as'=> 'cars.models.update',
				'uses'=> 'Admin\CarModelController@update'
			]);
			Route::get('/delete/{id}', [
				'as'=> 'cars.models.delete',
				'uses'=> 'Admin\CarModelController@delete'
			]);
		});
	});
	
	Route::prefix('approve/booking')->group(function () {
		Route::get('/', [
			'as'=> 'booking.list',
			'uses'=> 'Admin\TripsController@booking'
		]);
		Route::get('/getdata', [
			'as'=> 'booking.list.getdata',
			'uses'=> 'Admin\TripsController@getBooking'
		]);
		Route::get('/{id}', [
			'as'=> 'approve.booking',
			'uses'=> 'Admin\TripsController@approveBooking'
		]);
		Route::get('/store/{id}', [
			'as'=> 'approve.booking.store',
			'uses'=> 'Admin\TripsController@storeApproveBooking'
		]);
		Route::get('/cancel/{id}', [
			'as'=> 'approve.booking.cancel',
			'uses'=> 'Admin\TripsController@cancelBooking'
		]);
	});

	Route::prefix('approve/return')->group(function () {
		Route::get('/', [
			'as'=> 'return.list',
			'uses'=> 'Admin\TripsController@return'
		]);
		Route::get('/getdata', [
			'as'=> 'return.list.getdata',
			'uses'=> 'Admin\TripsController@getReturn'
		]);
		Route::get('/approve/{id}', [
			'as'=> 'return.approve',
			'uses'=> 'Admin\TripsController@approveReturn'
		]);
	});

	Route::prefix('trips')->group(function () {
		Route::get('/', [
			'as'=> 'trips.list',
			'uses'=> 'Admin\TripsController@getTripsList'
		]);
		Route::get('/getdata', [
			'as'=> 'trips.list.getdata',
			'uses'=> 'Admin\TripsController@getTrips'
		]);
		Route::get('/view/{id}', [
			'as'=> 'trips.view',
			'uses'=> 'Admin\TripsController@view'
		]);
		Route::get('/action/{id}', [
			'as'=> 'trips.action',
			'uses'=> 'Admin\TripsController@tripAction'
		]);
		Route::get('/cancel/{id}', [
			'as'=> 'trips.cancelTrip',
			'uses'=> 'Admin\TripsController@cancelBooking'
		]);
		Route::get('/start/{id}', [
			'as'=> 'trips.startTrip',
			'uses'=> 'Admin\TripsController@startTrip'
		]);
		Route::get('/end/{id}', [
			'as'=> 'trips.endTrip',
			'uses'=> 'Admin\TripsController@endTrip'
		]);
		Route::get('/delete/{id}', [
			'as'=> 'trips.deleteTrip',
			'uses'=> 'Admin\TripsController@deleteTrip'
		])->middleware('check-admin');
	});
	
	Route::prefix('customer')->group(function () {
		Route::get('/', [
			'as'=> 'customer.list',
			'uses'=> 'Admin\CustomerController@index'
		]);
		Route::get('/getdata', [
			'as'=> 'customer.list.getdata',
			'uses'=> 'Admin\CustomerController@getCustomers'
		]);
		Route::get('/delete/{id}', [
			'as'=> 'customer.deleteCustomer',
			'uses'=> 'Admin\CustomerController@deleteCustomer'
		])->middleware('check-admin');

		Route::get('/view/{id}', [
			'as'=> 'customer.viewCustomer',
			'uses'=> 'Admin\CustomerController@viewCustomer'
		]);
	});

	Route::prefix('coupons')->group(function () {
		Route::get('/', [
			'as'=> 'coupons.list',
			'uses'=> 'Admin\CouponController@index'
		]);
		Route::get('/getdata', [
			'as'=> 'coupons.list.getdata',
			'uses'=> 'Admin\CouponController@getCoupons'
		]);
		Route::get('/create', [
			'as'=> 'coupons.create',
			'uses'=> 'Admin\CouponController@create'
		]);
		Route::get('/edit/{id}', [
			'as'=> 'coupons.edit',
			'uses'=> 'Admin\CouponController@edit'
		]);
		
		Route::post('/store', [
			'as'=> 'coupons.store',
			'uses'=> 'Admin\CouponController@store'
		]);
		Route::put('/update', [
			'as'=> 'coupons.store',
			'uses'=> 'Admin\CouponController@update'
		]);
		Route::get('/delete/{id}', [
			'as'=> 'coupons.delete',
			'uses'=> 'Admin\CouponController@delete'
		]);
	});

	Route::group(['middleware' => ['check-admin']], function(){
		Route::prefix('users')->group(function () {
			Route::get('/', [
				'as'=> 'users.list',
				'uses'=> 'Admin\AdminController@index'
			]);
			Route::get('/getdata', [
				'as'=> 'users.list.getdata',
				'uses'=> 'Admin\AdminController@getUsers'
			]);
			Route::get('/createmod', [
				'as'=> 'users.createmod',
				'uses'=> 'Admin\AdminController@createMod'
			]);
			
			Route::post('/storemod', [
				'as'=> 'users.storemod',
				'uses'=> 'Admin\AdminController@storeMod'
			]);
			
			Route::get('/editmod/{id}', [
				'as'=> 'users.editmod',
				'uses'=> 'Admin\AdminController@editMod'
			]);
			Route::put('/updatemod', [
				'as'=> 'users.updatemod',
				'uses'=> 'Admin\AdminController@updateMod'
			]);
			Route::get('/deletemod/{id}', [
				'as'=> 'users.deletemod',
				'uses'=> 'Admin\AdminController@deleteMod'
			]);
	
		});
		Route::prefix('configs')->group(function () {
			Route::get('/', [
				'as'=> 'admin.configs',
				'uses'=> 'Admin\AdminController@configs'
			]);
			Route::post('/update', [
				'as'=> 'admin.configs.update',
				'uses'=> 'Admin\AdminController@updateConfigs'
			]);
		});
	});
	

});
	
