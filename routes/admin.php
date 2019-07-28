<?php
Route::group(['middleware' => ['access-dashboard']], function(){
	Route::get('/dashboard', [
		'as'=> 'dashboard',
		'uses'=> 'Admin\DashboardController@index'
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
	
		Route::post('/images/upload/store', [
			'as'=> 'admin_car_image_store',
			'uses'=> 'ImagesController@imageStore'
		]);
	
		Route::post('/images/remove/{name}', [
			'as'=> 'admin_car_image_remove',
			'uses'=> 'ImagesController@imageRemove'
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
	});
	

});
	
