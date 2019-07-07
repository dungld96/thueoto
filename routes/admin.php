<?php
Route::group(['middleware' => ['auth', 'check-admin']], function(){
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

	Route::get('/cars/add', [
		'as'=> 'admin_car_add',
		'uses'=> 'Admin\CarController@add'
	]);

	Route::get('/cars/images/upload/store', [
		'as'=> 'admin_car_image_store',
		'uses'=> 'Admin\CarController@imageStore'
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
	
