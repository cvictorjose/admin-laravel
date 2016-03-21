<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'AdminController@login');

Route::group(['prefix' => 'admin'], function() {
	Route::get('/',                             'AdminController@login');
	Route::post('/',                            'AdminController@login');
	Route::get('/login',                        'AdminController@login');
	Route::post('/login',                       'AdminController@login');
	Route::get('dashboard',                     'AdminController@dashboard');
	Route::get('logout',                        'AdminController@logout');

	/* Admin User Functionalities */
	Route::get('userlist',                      'AdminUserController@userlist');

	Route::get('useradd',                       'AdminUserController@useradd');
	Route::post('useradd',                      'AdminUserController@useradd');
	Route::get('edituser/{id}',                 'AdminUserController@edituser');
	Route::post('edituser/{id}',                'AdminUserController@edituser');
	Route::post('useremailcheck',               'AdminUserController@useremailcheck');
	Route::post('userstatuschange',             'AdminUserController@userstatuschange');

    /* Airlines Functionalities */
    Route::get('airlineslist',                  'AdminAirlineController@airlineslist');
    Route::get('airlineadd',                    'AdminAirlineController@airlineadd');
    Route::post('airlineadd',                   'AdminAirlineController@airlineadd');
    Route::get('editairline/{id}',              'AdminAirlineController@editairline')->where('id', '[0-9]+');
    Route::post('editairline/{id}',             'AdminAirlineController@editairline')->where('id', '[0-9]+');
    Route::post('airlinestatuschange',          'AdminAirlineController@airlinestatuschange');

    /* Airports Functionalities */
    Route::get('airportslist',                  'AdminAirportController@airportslist');
    Route::get('airportadd',                    'AdminAirportController@airportadd');
    Route::post('airportadd',                   'AdminAirportController@airportadd');
    Route::get('editairport/{id}',              'AdminAirportController@editairport');
    Route::post('editairport/{id}',             'AdminAirportController@editairport');
    Route::post('airportstatuschange',          'AdminAirportController@airportstatuschange');
    Route::post('airportiatacheck',             'AdminAirportController@airportiatacheck');

	/* Product Airports Functionalities */
	Route::get('airportproductlist',            'AdminAirportProductController@airportproductlist');
	Route::post('airportproductstatuschange',   'AdminAirportProductController@airportproductstatuschange');
    Route::get('airportproductadd',             'AdminAirportProductController@airportproductadd');
    Route::post('airportproductadd',            'AdminAirportProductController@airportproductadd');
    Route::get('editairportproduct/{id}',       'AdminAirportProductController@editairportproduct');
    Route::post('editairportproduct/{id}',      'AdminAirportProductController@editairportproduct');


    /* SAfe bag Airports Functionalities */
    Route::get('sbairportslist',                  'AdminSBAirportController@airportslist2');
    Route::post('sbairportstatuschange',          'AdminSBAirportController@airportstatuschange');
    Route::get('sbairportadd',                    'AdminSBAirportController@airportadd');
    Route::post('sbairportadd',                   'AdminSBAirportController@airportadd');
    Route::post('sbairportiatacheck',             'AdminSBAirportController@airportiatacheck');

});



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
