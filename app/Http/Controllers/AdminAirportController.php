<?php namespace App\Http\Controllers;

use Validator;
use Session;
use \App\AdminAirports;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;

class AdminAirportController extends Controller {

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
     * name:    airportslist
     * params:
     * return:
     * desc:    airportslist admin
     */
    public function airportslist(){
        $data['airportsList']  = AdminAirports::getAirportsList();
        return \View::make('admin.airportslist')->with('data', $data);
    }
}

