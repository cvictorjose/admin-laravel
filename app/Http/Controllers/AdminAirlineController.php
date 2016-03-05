<?php namespace App\Http\Controllers;

use Validator;
use Session;
use \App\AdminUser;
use \App\AdminAirlines;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;

class AdminAirlineController  extends Controller {

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
     * name:    airlineslist
     * params:
     * return:
     * desc:    airlineslist admin
     */
    public function airlineslist(){
        $data['airlinesList']  = AdminAirlines::getAirlinesList();
        return \View::make('admin.airlineslist')->with('data', $data);
    }



}