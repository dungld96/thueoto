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

	Route::prefix('booking')->group(function () {
		Route::get('/', [
			'as'=> 'booking.list',
			'uses'=> 'Admin\TripsController@booking'
		]);
		Route::get('/getdata', [
			'as'=> 'booking.list.getdata',
			'uses'=> 'Admin\TripsController@getBooking'
		]);
		Route::get('/approve/{id}', [
			'as'=> 'booking.approve',
			'uses'=> 'Admin\TripsController@approveBooking'
		]);
		Route::get('/storeapprove/{id}', [
			'as'=> 'booking.storeapprove',
			'uses'=> 'Admin\TripsController@storeApprove'
		]);
		Route::get('/cancel/{id}', [
			'as'=> 'booking.apprcancelove',
			'uses'=> 'Admin\TripsController@cancelBooking'
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
	});
	

});
	
