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
/*Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});*/

Route::get('/', 'AdminController@login');

// Authentication routes...
Route::get('auth/login', 'AdminController@login');

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
    Route::get('sbeditairport/{id}',              'AdminSBAirportController@editairport');
    Route::post('sbeditairport/{id}',             'AdminSBAirportController@editairport');

    /* Content Service Functionalities */
    Route::get('servicecontentlist',            'AdminServiceContentController@servicecontentlist');
    Route::post('filterservicecontentlist',     'AdminServiceContentController@filterservicecontentlist');
    Route::get('servicecontentadd',             'AdminServiceContentController@servicecontentadd');
    Route::post('servicecontentadd',            'AdminServiceContentController@servicecontentadd');
    Route::post('servicecontenttitlecheck',     'AdminServiceContentController@servicecontenttitlecheck');
    Route::get('editservicecontent/{id}',       'AdminServiceContentController@editservicecontent');
    Route::post('editservicecontent/{id}',      'AdminServiceContentController@editservicecontent');


    /* Content Airports Functionalities */
    Route::get('airportcontentlist',            'AdminAirportContentController@airportcontentlist');
    Route::post('filterairportcontentlist',     'AdminAirportContentController@filterairportcontentlist');
    Route::get('airportcontentadd',             'AdminAirportContentController@airportcontentadd');
    Route::post('airportcontentadd',            'AdminAirportContentController@airportcontentadd');
    Route::post('airportcontentstatuschange',   'AdminAirportContentController@airportcontentstatuschange');
    Route::get('editairportcontent/{id}',       'AdminAirportContentController@editairportcontent');
    Route::post('editairportcontent/{id}',      'AdminAirportContentController@editairportcontent');


    /* Price x Airports */
    Route::get('pricexairportlist',            'AdminPriceAirportController@pricexairportlist');
    Route::post('pricexairportstatuschange',   'AdminPriceAirportController@pricexairportstatuschange');
    Route::get('pricexairportadd',             'AdminPriceAirportController@pricexairportadd');
    Route::post('pricexairportadd',            'AdminPriceAirportController@pricexairportadd');
    Route::get('editpricexairport/{id}',       'AdminPriceAirportController@editpricexairport');
    Route::post('editpricexairport/{id}',      'AdminPriceAirportController@editpricexairport');



    /* Terms and Conditions Functionalities*/
    Route::get('termslist',            'AdminTermsController@termslist');
    Route::get('termsadd',             'AdminTermsController@termsadd');
    Route::post('termsadd',            'AdminTermsController@termsadd');
    Route::get('editterms/{id}',       'AdminTermsController@editterms');
    Route::post('editterms/{id}',      'AdminTermsController@editterms');


    /* PromoCode Functionalities*/
    Route::get('promocodelist',            'AdminPromocodeController@promocodelist');
    Route::get('promocoderegistrationlist', 'AdminPromocodeController@promocoderegistrationlist');
    Route::get('promocodetrackinglist',     'AdminPromocodeController@promocodetrackinglist');
    Route::post('search_promocode',            'AdminPromocodeController@search_promocode');


    /* Tracking Functionalities*/
    Route::get('trackinglist',            'AdminTrackingController@trackinglist');

    /* Transactions Functionalities*/
    Route::get('transactionlist',            'AdminTransactionController@transactionlist');


    /* Download Functionalities*/
    Route::get('download_users_sb',                 'AdminDownloadController@download_users_sb');
    Route::get('download_code_registration',        'AdminDownloadController@download_code_registration');
    Route::get('download_code_registration_track',  'AdminDownloadController@download_code_registration_track');
    Route::get('download_all_track',                'AdminDownloadController@download_all_track');
    Route::get('download_all_transactions',         'AdminDownloadController@download_all_transactions');


});



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
