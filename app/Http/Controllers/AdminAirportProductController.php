<?php namespace App\Http\Controllers;

use Validator;
use Session;
use \App\AdminSBAirports;
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


    /*
     * name:    airportproductstatuschange
     * params:
     * return:
     * desc:    Change the status of the Airport Product admin
     */
    public function  airportproductstatuschange() {
        $inputData  = Input::all();
        $status     =  array('stat'=>'error', 'msg'=>'Something went wrong');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['apstat']) && $inputData['apstat']>= 0) {
            // Applying validation rules.
            $rules = array('apstat'          => 'required', 'apid'  => 'required');
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis
                $status   =  array('stat'=>'error', 'msg'=>$validator);
                return json_encode($status);
            } else {
                $status  = AdminAirportProduct::changeAirportProductStatus($inputData['apstat'], $inputData['apid']);
            }
        }   else {
            $status   =  array('stat'=>'error', 'msg'=>'Details missing to change the status.');
        }
        return json_encode($status);
    }



    /*
         * name:    airportproductadd
         * params:
         * return:
         * desc:    airportproductadd admin
         */
    public function airportproductadd(){
        $inputData  = Input::all();
        $data       = array('mode'=>'add');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['addap'])) {
            // Applying validation rules.
            $rules = array(
                'ap_product_code'                => 'required',
                'ap_priority'                    => 'required',
                'ap_title'                       => 'required',
                'ap_web_desc'                    => 'required',
                'ap_lang'                        => 'required',
                'ap_airport_sales'               => 'required',

            );
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis
                $status   =  array('stat'=>'error', 'msg'=>'Please Enter the Valid Details');
                //return json_encode($status);
                Session::flash('statmsg', $status['msg']);
                Session::flash('status', $status['stat']);
            } else {
                $imagename   = '';
                if(isset($_FILES['ap_image']['name']))
                    if ( 0 < $_FILES['ap_image']['error'] ) {
                        $status   =  array('stat'=>'error', 'msg'=>$_FILES['ap_image']['error']);
                        Session::flash('statmsg', $status['msg']);
                        Session::flash('status', $status['stat']);
                    }
                    else {
                        $imagename   = time().$_FILES['ap_image']['name'];
                        move_uploaded_file($_FILES['ap_image']['tmp_name'], config('constants.adminAPImagePath') . $imagename);
                    }

                $apdata = array(
                    'codice_prodotto'                   => $inputData['ap_product_code'],
                    'priority'                          => $inputData['ap_priority'],
                    'titolo'                            => $inputData['ap_title'],
                    'descrizione_web'                   => $inputData['ap_web_desc'],
                    'stato'                             => (Input::get('ap_status'))? Input::get('ap_status') : '0',
                    'lingua'                            => $inputData['ap_lang'],
                    'aeroporto_di_vendita'              => implode(',', Input::get('ap_airport_sales')),
                    'date_create'                       => date("y-m-d H:i:s"),

                );

                if(!empty($imagename))
                    $apdata['image']       = $imagename;

                $status  = AdminAirportProduct::insertAirportProduct($apdata);
                Session::flash('statmsg', $status['msg']);
                Session::flash('status', $status['stat']);
            }
        }
        $data['airportsList']  = AdminSBAirports::getAirportsList();

        return \View::make('admin.airportproductadd')->with('data', $data);
    }




    /*
     * name:    editairportproduct
     * params:  $apid
     * return:
     * desc:    Change the details of the Airport Product admin
     */
    public function  editairportproduct($apid)  {
        $inputData      = Input::all();
        $data           = array('mode'=>'edit');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['addap'])) {
            // Applying validation rules.
            $rules = array(
                'ap_product_code'                => 'required',
                'ap_priority'                    => 'required',
                'ap_title'                       => 'required',
                'ap_web_desc'                    => 'required',
                'ap_lang'                        => 'required',
                'ap_airport_sales'               => 'required',
            );
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis
                $status   =  array('stat'=>'error', 'msg'=>$validator);
                return json_encode($status);
            } else {
                $imagename   = '';
                if(isset($_FILES['ap_image']['name']))
                    if ( 0 < $_FILES['ap_image']['error'] ) {
                        $status   =  array('stat'=>'error', 'msg'=>$_FILES['ap_image']['error']);
                        Session::flash('statmsg', $status['msg']);
                        Session::flash('status', $status['stat']);
                    }
                    else {
                        $imagename   = time().$_FILES['ap_image']['name'];
                        move_uploaded_file($_FILES['ap_image']['tmp_name'], config('constants.adminAPImagePath') . $imagename);
                    }

                $apdata = array(
                    'codice_prodotto'                   => $inputData['ap_product_code'],
                    'priority'                          => $inputData['ap_priority'],
                    'titolo'                            => $inputData['ap_title'],
                    'descrizione_web'                   => $inputData['ap_web_desc'],
                    'stato'                             => (Input::get('ap_status'))? Input::get('ap_status') : '0',
                    'lingua'                            => $inputData['ap_lang'],
                    'aeroporto_di_vendita'              => implode(',', Input::get('ap_airport_sales')),
                );

                if(!empty($imagename))
                    $apdata['image']       = $imagename;

                $status  = AdminAirportProduct::updateAirportProduct($apdata, $apid);
                //return json_encode($status);
                Session::flash('statmsg', $status['msg']);
                Session::flash('status', $status['stat']);
            }
        }
        $airproductslist                 =   AdminAirportProduct::getAirportProductList(array('apId'=>$apid));
        if($airproductslist)
            $data['apDetails']           = $airproductslist[0];
        else $data['apDetails']          = (object) array();
        $data['airproductsList']         = $airproductslist;
        $data['airportsList']            = AdminSBAirports::getAirportsList();

        return \View::make('admin.airportproductadd')->with('data', $data);
    }



}