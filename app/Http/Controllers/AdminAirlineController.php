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


    /*
     * name:    airlinestatuschange
     * params:
     * return:
     * desc:    Change the status of the Airline admin
     */
    public function  airlinestatuschange() {
        $inputData  = Input::all();
        $status     =  array('stat'=>'error', 'msg'=>'Something went wrong');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['alstat']) && $inputData['alstat']>= 0) {
            // Applying validation rules.
            $rules = array('alstat'          => 'required', 'airlineid'  => 'required');
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis
                $status   =  array('stat'=>'error', 'msg'=>$validator);
                return json_encode($status);
            } else {
                $status  = AdminAirlines::changeAirlineStatus($inputData['alstat'], $inputData['airlineid']);
            }
        }   else {
            $status   =  array('stat'=>'error', 'msg'=>'Details missing to change the status.');
        }
        return json_encode($status);
    }

    /*
     * name:    airlineadd
     * params:
     * return:
     * desc:    airlineadd admin
     */
    public function airlineadd(){
        $inputData  = Input::all();
        $data       = array('mode'=>'add');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['addairline'])) {
            // Applying validation rules.
            $rules = array(
                'al_name'           => array('required', 'min:3'),
                'al_code'           => array('required', 'alpha_num'),
                'al_country'        => 'required',
            );
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis
                $status   =  array('stat'=>'error', 'msg'=>$validator);
                return json_encode($status);
            } else {
                $airlinedata = array(
                    'name_airline'           => Input::get('al_name'),
                    'code_airline'           => Input::get('al_code'),
                    'country_airline'        => Input::get('al_country'),
                    'stato'                 => (Input::get('al_status'))? Input::get('al_status') : '0',
                );
                $status  = AdminAirlines::insertAdminAirlines($airlinedata);
                return json_encode($status);
            }
        }
        $countrylist                 =   AdminUser::getCountriesList();
        $data['countriesList']       =   $countrylist;
        return \View::make('admin.airlineadd')->with('data', $data);
    }



}