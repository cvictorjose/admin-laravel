<?php namespace App\Http\Controllers;

use Validator;
use Session;
use Response;
use View;
use \App\AdminAirports;
use \App\AdminAirportContent;
use \App\Http\Requests;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;

class AdminAirportContentController  extends Controller {

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
     * name:    airportcontentlist
     * params:
     * return:
     * desc:    airportcontentlist admin
     */
    public function airportcontentlist(){
        $data['acList']         = AdminAirportContent::getAirportContentList();
        $data['filter']         = '';
        $data['filter_lang']    = '';
        return \View::make('admin.airportcontentlist')->with('data', $data);
    }



}