<?php namespace App\Http\Controllers;

use Validator;
use Session;
use Response;
use View;
use \App\AdminAirports;
use \App\AdminPromocode;
use \App\AdminAirportContent;
use \App\Http\Requests;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;

class AdminPromocodeController  extends Controller {

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
     * name:    promocodelist
     * params:
     * return:
     * desc:    All promocode List admin
     */
    public function promocodelist(){
        $data['acList']         = AdminPromocode::getPromocodeList();
        return \View::make('admin.promocodelist')->with('data', $data);
    }


    /*
     * name:    promocoderegistrationlist
     * params:
     * return:
     * desc:    All promocode registered List admin
     */
    public function promocoderegistrationlist(){
        $data['acList']         = AdminPromocode::getPromocodeList_byregistration();
        return \View::make('admin.promocoderegistrationlist')->with('data', $data);
    }

    /*
     * name:    promocodetrackinglist
     * params:
     * return:
     * desc:    All promocode registered with tracking List admin
     */
    public function promocodetrackinglist(){
        $data['acList']         = AdminPromocode::getPromocodeList_bytracking();
        return \View::make('admin.promocodetrackinglist')->with('data', $data);
    }

    /*
     * name:    search_promocode
     * params:
     * return:
     * desc:    Search a promocode into db admin
     */
    public function search_promocode(){

        $inputData  = Input::all();
        $filter_code            = $inputData['filter_promocode'];
        if(!empty($inputData) && count($inputData)> 0 && isset($filter_code)) {
            $data['acList'] = AdminPromocode::search_promocode($filter_code);
            $view = \View::make('admin.promocode_search')->with('data', $data);

            if($inputData){
                $sections = $view->renderSections(); // returns an associative array of 'content', 'head' and 'footer'
                return $sections['content']; // this will only return whats in the content section
            }

        }else{
            $data['acList']          = (object) array();
        }
        return $view;
    }


}