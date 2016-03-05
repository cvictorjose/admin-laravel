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


    Route::post('airlinestatuschange',          'AdminAirlineController@airlinestatuschange');



});



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
