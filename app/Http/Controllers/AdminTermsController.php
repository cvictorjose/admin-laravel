<?php namespace App\Http\Controllers;

use Validator;
use Session;
use \App\AdminSBAirports;
use \App\AdminPriceAirport;
use \App\AdminTerms;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;


class AdminTermsController  extends Controller {

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
     * name:    Termslist
     * params:
     * return:
     * desc:    Termslist admin
     */
    public function termslist(){
        $data['apList']         = AdminTerms::getTermsList();
        return \View::make('admin.termslist')->with('data', $data);
    }



    /*
     * name:    Termsadd
     * params:
     * return:
     * desc:    Termsadd admin
     */
    public function termsadd(){
        $inputData  = Input::all();
        $data       = array('mode'=>'add');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['addap'])) {
            // Applying validation rules.
            $rules = array(
                'ap_title'                       => 'required',
                'ap_web_desc'                    => 'required',

            );
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis
                $status   =  array('stat'=>'error', 'msg'=>'Please Enter the Valid Details');
                //return json_encode($status);
                Session::flash('statmsg', $status['msg']);
                Session::flash('status', $status['stat']);
            } else {

                $apdata = array(
                    'title'                            => $inputData['ap_title'],
                    'description'                   => $inputData['ap_web_desc'],
                );



                $status  = AdminTerms::insertTerms($apdata);
                Session::flash('statmsg', $status['msg']);
                Session::flash('status', $status['stat']);
            }
        }

        $data['termsList']  = AdminTerms::getTermsList();
        return \View::make('admin.termsadd')->with('data', $data);
    }


    /*
         * name:    editTerms
         * params:  $apid
         * return:
         * desc:    Change the details of the Airport Product admin
         */
    public function  editterms($apid)  {
        $inputData      = Input::all();
        $data           = array('mode'=>'edit');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['addap'])) {
            // Applying validation rules.
            $rules = array(
                'ap_title'                       => 'required',
                'ap_web_desc'                    => 'required',
            );
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis
                $status   =  array('stat'=>'error', 'msg'=>$validator);
                return json_encode($status);
            } else {

                $apdata = array(
                    'title'                            => $inputData['ap_title'],
                    'description'                   => $inputData['ap_web_desc'],
                );

                $status  = AdminTerms::updateTerms($apdata, $apid);
                //return json_encode($status);
                Session::flash('statmsg', $status['msg']);
                Session::flash('status', $status['stat']);
            }
        }
        $airproductslist                 =   AdminTerms::getTermsList(array('apId'=>$apid));

        if($airproductslist)
            $data['apDetails']           = $airproductslist[0];
        else $data['apDetails']          = (object) array();
            $data['airproductsList']         = $airproductslist;

        $data['termsList']  = AdminTerms::getTermsList();
        return \View::make('admin.termsadd')->with('data', $data);
    }


}