<?php namespace App\Http\Controllers;

use Validator;
use Session;
use \App\AdminPartners;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;

class AdminPartnersController extends Controller {

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
        * name:    partnerslist
        * params:
        * return:
        * desc:    partnerslist admin
        */
    public function partnerslist(){
        $data['partnersList']  = AdminPartners::getPartnersList();
        return \View::make('admin.partnersList')->with('data', $data);
    }

    /*
     * name:    useradd
     * params:
     * return:
     * desc:    useradd admin
     */
    public function  partnersadd(){

        $inputData  = Input::all();// echo "<pre>"; print_r($inputData); exit;
        $data       = array('mode'=>'add');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['addpartner'])) {
            // Applying validation rules.
            $rules = array(
                'ap_partner' => 'required',
                'ap_code' => 'required'
            );
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis redirect back to login.
                $status   =  array('stat'=>'error', 'msg'=>$validator);
                return json_encode($status);
            } else {
                $portdata = array(
                    'name'       => strtoupper(Input::get('ap_partner')),
                    'code'       => strtoupper(Input::get('ap_code')),
                    'commission'       => strtoupper(Input::get('ap_commission')),
                    'status'     => (Input::get('ap_status'))? Input::get('ap_status') : '0',
                );
                $status  = AdminPartners::insertPartner($portdata);
                return json_encode($status);

            }
        }
        return \View::make('admin.partnersadd')->with('data', $data);
    }


    /*
         * name:    airportiatacheck
         * params:
         * return:
         * desc:    Check Duplication for Airport IATA admin
         */
    public function  partnercodecheck() {
        $inputData  = Input::all();
        $status     =  array('stat'=>'error', 'msg'=>'Something went wrong');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['code']) && !empty($inputData['code'])) {
            // Applying validation rules.
            $rules = array('code' => 'required');
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis
                $status   =  array('stat'=>'error', 'msg'=>$validator);
                return json_encode($status);
            } else {
                $status  = AdminPartners::checkPartnerCode($inputData['code']);
            }
        }   else {
            $status   =  array('stat'=>'error', 'msg'=>'Please enter the valid Partner Code');
        }
        return json_encode($status);
    }


    /*
   * name:    airportstatuschange
   * params:
   * return:
   * desc:    Change the status of the Airport admin
   */
    public function  partnerschangetatus() {
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
                $status  = AdminPartners::changePartnerStatus($inputData['alstat'], $inputData['airlineid']);
            }
        }   else {
            $status   =  array('stat'=>'error', 'msg'=>'Details missing to change the status.');
        }
        return json_encode($status);
    }


    /*
     * name:    editairport
     * params:
     * return:
     * desc:    Change the details of the Airport admin
     */
    public function  editpartner($id)  {
        $inputData      = Input::all();
        $data           = array('mode'=>'edit');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['addpartner'])) {
            // Applying validation rules.
            $rules = array(
                'ap_partner' => 'required',
                'ap_code' => 'required'
            );
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis redirect back to login.
                $status   =  array('stat'=>'error', 'msg'=>$validator);
                return json_encode($status);
            } else {

                $portdata = array(
                    'name'       => strtoupper(Input::get('ap_partner')),
                    'code'       => strtoupper(Input::get('ap_code')),
                    'commission'       => strtoupper(Input::get('ap_commission')),
                    'status'     => (Input::get('ap_status'))? Input::get('ap_status') : '0',
                );

                $status  = AdminPartners::updatePartner($portdata, Input::get('ap_id'));
                return json_encode($status);
            }
        }
        $portdetails    = AdminPartners::getPartnersList(array('portId'=>$id));
        if($portdetails)
            $data['portDetails']   = $portdetails[0];
        else $data['portDetails']   = (object) array();
        return \View::make('admin.partnersadd')->with('data', $data);
    }

}

