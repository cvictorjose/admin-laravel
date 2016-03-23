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


    /*
     * name:    servicecontentadd
     * params:
     * return:
     * desc:    servicecontentadd admin
     */
    public function servicecontentadd(){
        $inputData  = Input::all();
        $data       = array('mode'=>'add');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['addsc'])) {
            // Applying validation rules.
            $rules = array(
                'sc_title.en'       => 'required',
                'sc_content.en'     => 'required',
            );
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis
                $status   =  array('stat'=>'error', 'msg'=>'Please Enter the Valid Details');
                //return json_encode($status);
                Session::flash('statmsg', $status['msg']);
                Session::flash('status', $status['stat']);
            } else {
                /*$imagename   = '';
                if(isset($_FILES['sc_image']['name']))
                if ( 0 < $_FILES['sc_image']['error'] ) {
                      $status   =  array('stat'=>'error', 'msg'=>$_FILES['sc_image']['error']);
                      Session::flash('statmsg', $status['msg']);
                      Session::flash('status', $status['stat']);
                  }
                  else {
                      $imagename   = time().$_FILES['sc_image']['name'];
                      move_uploaded_file($_FILES['sc_image']['tmp_name'], config('constants.adminSCImagePath') . $imagename);
                  }*/

                if(empty($inputData['sc_title']['fr'])) {$inputData['sc_title']['fr']=$inputData['sc_title']['en'];}
                if(empty($inputData['sc_title']['it'])) {$inputData['sc_title']['it']=$inputData['sc_title']['en'];}

                $scdata = array(
                    'cont_title_en'         => $inputData['sc_title']['en'],
                    'cont_title_fr'         => $inputData['sc_title']['fr'],
                    'cont_title_it'         => $inputData['sc_title']['it'],
                    'contents_en'           => $inputData['sc_content']['en'],
                    'contents_fr'           => $inputData['sc_content']['fr'],
                    'contents_it'           => $inputData['sc_content']['it'],
                    'status'                   => '1',

                );
                $status  = AdminServiceContent::insertServiceContent($scdata);
                Session::flash('statmsg', $status['msg']);
                Session::flash('status', $status['stat']);

            }
        }
        return \View::make('admin.servicecontentadd')->with('data', $data);
    }



    /*
     * name:    servicecontenttitlecheck
     * params:
     * return:
     * desc:    Check Duplication for Service Content Title admin
     */
    public function  servicecontenttitlecheck() {
        $inputData  = Input::all();
        $status     =  array('stat'=>'error', 'msg'=>'Something went wrong');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['titleen']) && !empty($inputData['titleen'])) {
            // Applying validation rules.
            $rules = array('titleen'          => 'required');
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis
                $status   =  array('stat'=>'error', 'msg'=>$validator);
                return json_encode($status);
            } else {
                $status  = AdminServiceContent::checkServiceContentTitle($inputData['titleen'], $inputData['scid']);
            }
        }   else {
            $status   =  array('stat'=>'error', 'msg'=>'Please enter the valid Title in English');
        }
        return json_encode($status);
    }


    /*
     * name:    editservicecontent
     * params:  $scid
     * return:
     * desc:    Change the details of the Service Content admin
     */
    public function  editservicecontent($scid)  {
        $inputData      = Input::all();
        $data           = array('mode'=>'edit');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['addsc'])) {
            // Applying validation rules.
            $rules = array(
                'sc_title.en'       => 'required',
                'sc_content.en'     => 'required',
            );
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis
                $status   =  array('stat'=>'error', 'msg'=>$validator);
                return json_encode($status);
            } else {
                /*$imagename   = '';
                if(isset($_FILES['sc_image']['name']))
                    if ( 0 < $_FILES['sc_image']['error'] ) {
                        $status   =  array('stat'=>'error', 'msg'=>$_FILES['sc_image']['error']);
                        Session::flash('statmsg', $status['msg']);
                        Session::flash('status', $status['stat']);
                    }
                    else {
                        $imagename   = time().$_FILES['sc_image']['name'];
                        move_uploaded_file($_FILES['sc_image']['tmp_name'], config('constants.adminSCImagePath') . $imagename);
                    }*/

                $scdata = array(
                    'cont_title_en'         => $inputData['sc_title']['en'],
                    'cont_title_fr'         => $inputData['sc_title']['fr'],
                    'cont_title_it'         => $inputData['sc_title']['it'],
                    'contents_en'           => $inputData['sc_content']['en'],
                    'contents_fr'           => $inputData['sc_content']['fr'],
                    'contents_it'           => $inputData['sc_content']['it'],
                    'status'                   => '1',
                );

                /*if(!empty($imagename))
                    $scdata['image']       = $imagename;*/

                $status  = AdminServiceContent::updateServiceContent($scdata, $scid);
                //return json_encode($status);
                Session::flash('statmsg', $status['msg']);
                Session::flash('status', $status['stat']);
            }
        }
        $scontentdetails    = AdminServiceContent::getServiceContentList(array('scId'=>$scid));
        if($scontentdetails)
            $data['scDetails']    = $scontentdetails[0];
        else $data['scDetails']   = (object) array();
        return \View::make('admin.servicecontentadd')->with('data', $data);
    }


}