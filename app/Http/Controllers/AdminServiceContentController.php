<?php namespace App\Http\Controllers;

use Validator;
use Session;
use Response;
use View;
use \App\AdminServiceContent;
use \App\Http\Requests;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;

class AdminServiceContentController  extends Controller {

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
     * name:    servicecontentlist
     * params:
     * return:
     * desc:    servicecontentlist admin
     */
    public function servicecontentlist(){
        $data['scList']         = AdminServiceContent::getServiceContentList();
        $data['filter']         = '';
        $data['filter_lang']    = '';
        return \View::make('admin.servicecontentlist')->with('data', $data);
    }


    /*
     * name:    filterservicecontentlist
     * params:
     * return:
     * desc:    filterservicecontentlist admin
    */
    public function filterservicecontentlist(){
        $inputData              = Input::all();
        $filter_lang            = $inputData['filter_lang'];
        $data['filter']         = 1;
        $data['filter_lang']    = $filter_lang;
        $data['scList']       = AdminServiceContent::getServiceContentList();
        //return \View::make('admin.filterscontentlist')->with('data', $data);
        $view = \View::make('admin.filterscontentlist')->with('data', $data);

        //if(Request::ajax()) {
        if($inputData){
            $sections = $view->renderSections(); // returns an associative array of 'content', 'head' and 'footer'

            return $sections['content']; // this will only return whats in the content section

        }

        // just a regular request so return the whole view

        return $view;
        exit;
    }


}