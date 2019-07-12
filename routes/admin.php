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

	Route::post('/cars/images/remove/{name}', [
		'as'=> 'admin_car_image_remove',
		'uses'=> 'ImagesController@imageRemove'
	]);

	Route::get('/cars/create', [
		'as'=> 'car.create',
		'uses'=> 'Admin\CarController@create'
	]);

	Route::get('/cars/edit/{id}', [
        'as' => 'car.edit',
        'uses' => 'Admin\CarController@edit'
	]);
	
	Route::put('/cars/update', [
        'as' => 'car.update',
        'uses' => 'Admin\CarController@update'
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
	Route::get('/booking/view/{id}', [
		'as'=> 'booking.view',
		'uses'=> 'Admin\BookingController@view'
	]);

});
	
