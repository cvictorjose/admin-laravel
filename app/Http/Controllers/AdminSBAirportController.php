<?php namespace App\Http\Controllers;

use Validator;
use Session;
use \App\AdminSBAirports;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;

class AdminSBAirportController extends Controller {

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
    * desc:    airportslist backend
    */
    public function airportslist2(){
        $data['airportsList']  = AdminSBAirports::getAirportsList2();
        return \View::make('admin.sbairportslist')->with('data', $data);
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
                $status  = AdminSBAirports::changeAirportStatus($inputData['apstat'], $inputData['airportid']);
            }
        }   else {
            $status   =  array('stat'=>'error', 'msg'=>'Details missing to change the status.');
        }
        return json_encode($status);
    }

    /*
     * name:    useradd
     * params:
     * return:
     * desc:    useradd admin
     */
    public function airportadd(){
        $data       = array('mode'=>'add');
        $inputData  = Input::all();// echo "<pre>"; print_r($inputData); exit;
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['addairport'])) {
            // Applying validation rules.
            $rules = array(
                'ap_iata' => 'required',
                'ap_city' => 'required'
            );
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis redirect back to login.
                $status   =  array('stat'=>'errorv', 'msg'=>$validator);
                return json_encode($status);
            } else {
                $portdata = array(
                    'depport'          => strtoupper(Input::get('ap_iata')),
                    'city'          => strtoupper(Input::get('ap_city')).'-'.strtoupper(Input::get('ap_iata')),
                    'stato'                 => (Input::get('ap_status'))? Input::get('ap_status') : '0',
                );
                $status  = AdminSBAirports::insertAirport($portdata);
                return json_encode($status);
            }
        }
        return \View::make('admin.sbairportadd')->with('data', $data);
    }


    /*
         * name:    airportiatacheck
         * params:
         * return:
         * desc:    Check Duplication for Airport IATA admin
         */
    public function  airportiatacheck() {
        $inputData  = Input::all();
        $status     =  array('stat'=>'error', 'msg'=>'Something went wrong');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['iata']) && !empty($inputData['iata'])) {
            // Applying validation rules.
            $rules = array('iata'          => 'required');
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis
                $status   =  array('stat'=>'error', 'msg'=>$validator);
                return json_encode($status);
            } else {
                $status  = AdminSBAirports::checkAirportIata($inputData['iata']);
            }
        }   else {
            $status   =  array('stat'=>'error', 'msg'=>'Please enter the valid Iata');
        }
        return json_encode($status);
    }


    /*
     * name:    editairport
     * params:
     * return:
     * desc:    Change the details of the Airport admin
     */
    public function  editairport($airportid)  {
        $inputData      = Input::all();
        $data           = array('mode'=>'edit');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['addairport'])) {
            // Applying validation rules.
            $rules = array(
                'ap_iata' => 'required',
                'ap_city' => 'required'
            );
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis redirect back to login.
                $status   =  array('stat'=>'errorv', 'msg'=>$validator);
                return json_encode($status);
            } else {

                $portdata = array(
                    'depport'          => strtoupper(Input::get('ap_iata')),
                    'city'          => strtoupper(Input::get('ap_city')).'-'.strtoupper(Input::get('ap_iata')),
                    'stato'         => Input::get('ap_status'),
                );

                $status  = AdminSBAirports::updateAdminAirport($portdata, Input::get('ap_id'));
                return json_encode($status);
            }
        }
        $portdetails    = AdminSBAirports::getAirportsList2(array('portId'=>$airportid));
        if($portdetails)
            $data['portDetails']   = $portdetails[0];
        else $data['portDetails']   = (object) array();
        return \View::make('admin.sbairportadd')->with('data', $data);
    }

}

