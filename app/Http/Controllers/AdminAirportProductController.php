<?php namespace App\Http\Controllers;

use Validator;
use Session;
use \App\AdminAirportProduct;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;


class AdminAirportProductController  extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * name:    airportproductlist
     * params:
     * return:
     * desc:    airportproductlist admin
     */
    public function airportproductlist(){
        $data['apList']         = AdminAirportProduct::getAirportProductList();
        return \View::make('admin.airportproductlist')->with('data', $data);
    }



}