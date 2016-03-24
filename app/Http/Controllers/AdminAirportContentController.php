<?php namespace App\Http\Controllers;

use Validator;
use Session;
use Response;
use View;
use \App\AdminAirports;
use \App\AdminSBAirports;
use \App\AdminAirportContent;
use \App\Http\Requests;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;

class AdminAirportContentController  extends Controller {

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
     * name:    airportcontentlist
     * params:
     * return:
     * desc:    airportcontentlist admin
     */
    public function airportcontentlist(){
        $data['acList']         = AdminAirportContent::getAirportContentList();
        $data['filter']         = '';
        $data['filter_lang']    = '';
        $data['airportsList']  = AdminSBAirports::getAirportsList();
        return \View::make('admin.airportcontentlist')->with('data', $data);
    }


    /*
     * name:    filterairportcontentlist
     * params:
     * return:
     * desc:    filterairportcontentlist admin
    */
    public function filterairportcontentlist(){
        $inputData              = Input::all();
        $filter_lang            = $inputData['filter_lang'];

        if(empty($inputData['idairport'])){$filter_idairport=0;}else{$filter_idairport       = $inputData['idairport'];}

        $data['filter']         = 1;
        $data['filter_lang']    = $filter_lang;
        $data['filter_idairport']    = $filter_idairport;
        $data['acList']         = AdminAirportContent::getAirportContentList2(array('Id'=>$filter_idairport));
        $data['airportsList']  = AdminSBAirports::getAirportsList();
        $view = \View::make('admin.filteracontentlist')->with('data', $data);

        if($inputData){
            $sections = $view->renderSections(); // returns an associative array of 'content', 'head' and 'footer'
            return $sections['content']; // this will only return whats in the content section
        }

        // just a regular request so return the whole view
        return $view;
        exit;
    }

}