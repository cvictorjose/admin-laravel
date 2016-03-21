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


}