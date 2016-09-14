<?php namespace App\Http\Controllers;

use Validator;
use Session;
use \App\AdminUser;
use \App\AdminCc;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;

class AdminCCController  extends Controller {

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
    public function cclist(){
        $data['ccList']  = AdminCc::getCCList();
        return \View::make('admin.cclist')->with('data', $data);
    }

    /*
         * name:    filtercclist
         * params:
         * return:
         * desc:    filtercclist admin
        */
    public function filtercclist(){
       $inputData  = Input::all(); //echo "<pre>"; print_r($inputData); exit;
       $filter_stato  = $inputData['filter_stato'];
       $dal_date  = strtotime($inputData['dal_date']);
       $al_date = strtotime($inputData['al_date']);

       $dal_date_filter  = $inputData['dal_date'];
       $al_date_filter  = $inputData['al_date'];



        if (empty($dal_date)){$dal_date=0;}
        if (empty($al_date)){$al_date=0;}
        $data['filter_dal2']    = $dal_date;
        $data['filter_al2']    =  $al_date;


       $data['filter_idairport'] = $filter_stato;
       $data['filter_dal']    = $dal_date_filter;
       $data['filter_al']    =  $al_date_filter;

        $searchdata = array(
            'Id'           => Input::get('filter_stato'),
            'dal_date'     => $dal_date,
            'al_date'      => $al_date,
        );


        $data['ccList']= AdminCc::getCCList2($searchdata);
        $view = \View::make('admin.filtercclist')->with('data', $data);
        if($inputData){
            $sections = $view->renderSections(); // returns an associative array of 'content', 'head' and 'footer'
            return $sections['content']; // this will only return whats in the content section
        }
        // just a regular request so return the whole view
        return $view;
        exit;
    }
}