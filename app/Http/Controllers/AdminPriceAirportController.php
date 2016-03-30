<?php namespace App\Http\Controllers;

use Validator;
use Session;
use \App\AdminSBAirports;
use \App\AdminPriceAirport;
use \App\AdminTerms;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;


class AdminPriceAirportController  extends Controller {

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
    public function pricexairportlist(){
        $data['apList']         = AdminPriceAirport::getAirportProductList();
        return \View::make('admin.priceairportlist')->with('data', $data);
    }


    /*
     * name:    airportproductstatuschange
     * params:
     * return:
     * desc:    Change the status of the Airport Product admin
     */
    public function  pricexairportstatuschange() {
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
                $status  = AdminPriceAirport::changePriceAirportStatus($inputData['apstat'], $inputData['apid']);
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
    public function pricexairportadd(){
        $inputData  = Input::all();
        $data       = array('mode'=>'add');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['addap'])) {
            // Applying validation rules.
            $rules = array(
                'ap_product_code'                => 'required',
                'ap_title'                       => 'required',
                'ap_web_desc'                    => 'required',
                'ap_web_desc_full'               => 'required',
                'ap_app_desc'                    => 'required',
                'ap_price_web_app'               => 'required',
                'ap_price_airport'               => 'required',
                'ap_lang'                        => 'required',
                'ap_airport_sales'               => 'required|array',
                'ap_expiry_date'                 => 'required',
                'ap_start_date'                  => 'required',
                'ap_end_date'                    => 'required',
                'ap_currency'                    => 'required',
                'ap_terms'                       => 'required',
                'ap_scontrino_wrap'              => 'required',
                'ap_scontrino_smartracking'      => 'required',
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
                    'codice_item'                       => strtoupper($inputData['ap_lang']."-".$inputData['ap_currency']."-".$inputData['ap_price_airport']."-".$inputData['ap_price_web_app']),
                    'titolo'                            => $inputData['ap_title'],
                    'descrizione_web'                   => $inputData['ap_web_desc'],
                    'descrizione_web_full'              => $inputData['ap_web_desc_full'],
                    'descrizione_app'                   => $inputData['ap_app_desc'],
                    'prezzo_web_app'                    => $inputData['ap_price_web_app'],
                    'prezzo_aeroporto'                  => $inputData['ap_price_airport'],
                    'stato'                             => (Input::get('ap_status'))? Input::get('ap_status') : '0',
                    'lingua'                            => $inputData['ap_lang'],
                    'aeroporto_di_vendita'              => implode(',', Input::get('ap_airport_sales')),
                    'data_di_scandenza'                 => date("Y-m-d", strtotime($inputData['ap_expiry_date'])),
                    'start_date'                        => strtotime($inputData['ap_start_date']),
                    'end_date'                          => strtotime($inputData['ap_end_date']),
                    'currency'                          => $inputData['ap_currency'],
                    'date_create'                       => date("y-m-d H:i:s"),
                    'terms'                             => $inputData['ap_terms'],
                    'scontrino_wrap'                    => $inputData['ap_scontrino_wrap'],
                    'scontrino_smartracking'            => $inputData['ap_scontrino_smartracking'],
                );

                if(!empty($imagename))
                    $apdata['image']       = $imagename;

                $status  = AdminPriceAirport::insertAirportProduct($apdata);
                Session::flash('statmsg', $status['msg']);
                Session::flash('status', $status['stat']);
            }
        }
        $data['airportsList']  = AdminSBAirports::getAirportsList();
        $data['termsList']  = AdminTerms::getTermsList();
        return \View::make('admin.priceairportadd')->with('data', $data);
    }


    /*
         * name:    editairportproduct
         * params:  $apid
         * return:
         * desc:    Change the details of the Airport Product admin
         */
    public function  editpricexairport($apid)  {
        $inputData      = Input::all();
        $data           = array('mode'=>'edit');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['addap'])) {
            // Applying validation rules.
            $rules = array(
                'ap_product_code'                => 'required',
                'ap_title'                       => 'required',
                'ap_web_desc'                    => 'required',
                'ap_web_desc_full'               => 'required',
                'ap_app_desc'                    => 'required',
                'ap_price_web_app'               => 'required',
                'ap_price_airport'               => 'required',
                'ap_lang'                        => 'required',
                'ap_airport_sales'               => 'required',
                'ap_expiry_date'                 => 'required',
                'ap_start_date'                  => 'required',
                'ap_end_date'                    => 'required',
                'ap_currency'                    => 'required',
                'ap_terms'                       => 'required',
                'ap_scontrino_wrap'              => 'required',
                'ap_scontrino_smartracking'      => 'required',

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
                    'codice_item'                       => strtoupper($inputData['ap_lang']."-".$inputData['ap_currency']."-".$inputData['ap_price_airport']."-".$inputData['ap_price_web_app']),
                    'titolo'                            => $inputData['ap_title'],
                    'descrizione_web'                   => $inputData['ap_web_desc'],
                    'descrizione_web_full'              => $inputData['ap_web_desc_full'],
                    'descrizione_app'                   => $inputData['ap_app_desc'],
                    'prezzo_web_app'                    => $inputData['ap_price_web_app'],
                    'prezzo_aeroporto'                  => $inputData['ap_price_airport'],
                    'stato'                             => (Input::get('ap_status'))? Input::get('ap_status') : '0',
                    'lingua'                            => $inputData['ap_lang'],
                    'aeroporto_di_vendita'              => implode(',', $inputData['ap_airport_sales']),
                    'data_di_scandenza'                 => date("Y-m-d", strtotime($inputData['ap_expiry_date'])),
                    'start_date'                        => strtotime($inputData['ap_start_date']),
                    'end_date'                          => strtotime($inputData['ap_end_date']),
                    'currency'                          => $inputData['ap_currency'],
                    'terms'                             => $inputData['ap_terms'],
                    'scontrino_wrap'                    => $inputData['ap_scontrino_wrap'],
                    'scontrino_smartracking'            => $inputData['ap_scontrino_smartracking'],
                );

                if(!empty($imagename))
                    $apdata['image']       = $imagename;

                $status  = AdminPriceAirport::updateAirportProduct($apdata, $apid);
                //return json_encode($status);
                Session::flash('statmsg', $status['msg']);
                Session::flash('status', $status['stat']);
            }
        }
        $airproductslist                 =   AdminPriceAirport::getAirportProductList(array('apId'=>$apid));

        if($airproductslist)
            $data['apDetails']           = $airproductslist[0];
        else $data['apDetails']          = (object) array();
        $data['airproductsList']         = $airproductslist;

        $data['airportsList']  = AdminSBAirports::getAirportsList();
        $data['termsList']  = AdminTerms::getTermsList();
        return \View::make('admin.priceairportadd')->with('data', $data);
    }


}