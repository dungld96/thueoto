<?php
Route::group(['middleware' => ['check-admin']], function(){
	Route::get('/dashboard', [
		'as'=> 'dashboard',
		'uses'=> 'Admin\DashboardController@index'
	]);
	
	Route::get('/cars', [
		'as'=> 'admin_cars_index',
		'uses'=> 'Admin\CarController@index'
	]);

	Route::get('/cars/getdata', [
		'as'=> 'admin_cars_getdata',
		'uses'=> 'Admin\CarController@getAll'
	]);

	Route::post('/cars/store', [
		'as'=> 'admin_car_store',
		'uses'=> 'Admin\CarController@store'
	]);

	Route::post('/cars/images/upload/store', [
		'as'=> 'admin_car_image_store',
		'uses'=> 'ImagesController@imageStore'
	]);

	Route::get('/cars/create', [
		'as'=> 'car.create',
		'uses'=> 'Admin\CarController@create'
	]);
	Route::get('/cars/delete/{id}', [
        'as' => 'car.delete',
        'uses' => 'Admin\CarController@delete'
    ]);

	Route::get('/booking', [
		'as'=> 'booking.list',
		'uses'=> 'Admin\BookingController@index'
	]);
	Route::get('/booking/getdata', [
		'as'=> 'booking.list.getdata',
		'uses'=> 'Admin\BookingController@getAll'
	]);











	Route::get('/reservation-list', [
		'as'=> 'admin_reservation',
		'uses'=> 'AdminController@admin_reservation'
	]);

	Route::get('/logout', [
		'as'=> 'admin_logout',
		'uses'=> 'AdminController@admin_logout'
	]);


	Route::get('/customer-list', [
		'as'=> 'admin_custoemr',
		'uses'=> 'AdminController@admin_custoemr'
	]);

	Route::get('/messages', [
		'as'=> 'admin_message',
		'uses'=> 'AdminController@admin_message'
	]);

	Route::get('/gwapoko2', [
		'as'=> 'gwapo2',
		'uses'=> 'AdminController@gwapo2'
	]);	
});
	
