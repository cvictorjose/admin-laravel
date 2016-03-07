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

    /*
    * name:    airportstatuschange
    * params:
    * return:
    * desc:    Change the status of the Airport admin
    */
    public function  airportstatuschange() {
        $inputData  = Input::all();
        $status     =  array('stat'=>'error', 'msg'=>'Something went wrong');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['apstat']) && $inputData['apstat']>= 0) {
            // Applying validation rules.
            $rules = array('apstat'          => 'required', 'airportid'  => 'required');
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis
                $status   =  array('stat'=>'error', 'msg'=>$validator);
                return json_encode($status);
            } else {
                $status  = AdminAirports::changeAirportStatus($inputData['apstat'], $inputData['airportid']);
            }
        }   else {
            $status   =  array('stat'=>'error', 'msg'=>'Details missing to change the status.');
        }
        return json_encode($status);
    }

}

