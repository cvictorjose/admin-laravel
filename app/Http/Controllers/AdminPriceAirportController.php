<?php namespace App\Http\Controllers;

use Validator;
use Session;
use \App\AdminSBAirports;
use \App\AdminPriceAirport;

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






}