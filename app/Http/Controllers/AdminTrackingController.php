<?php namespace App\Http\Controllers;

use Validator;
use Session;
use Response;
use View;

use \App\AdminTracking;
use \App\Http\Requests;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;

class AdminTrackingController  extends Controller {

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
     * name:    Traackinglist
     * params:
     * return:
     * desc:    Traackinglist admin
     */
    public function trackinglist(){
        $data['acList']         = AdminTracking::gettrackingList();
       // var_dump($data['acList']);

        return \View::make('admin.trackinglist')->with('data', $data);
    }



}