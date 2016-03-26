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

    /*
     * name:    airportcontentadd
     * params:
     * return:
     * desc:    airportcontentadd admin
     */
    public function airportcontentadd(){
        $inputData  = Input::all();
        $data       = array('mode'=>'add');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['addac'])) {
            // Applying validation rules.
            $rules = array(
                'ac_airport'                => 'required',
                'ac_name'                   => 'required',
                'ac_intro.en'               => 'required',
                'ac_descrizione.en'         => 'required',
                'ac_time.en'                => 'required',
                'ac_opentimestart.lun'      => 'required',
                'ac_opentimestart.mar'      => 'required',
                'ac_opentimestart.mer'      => 'required',
                'ac_opentimestart.gio'      => 'required',
                'ac_opentimestart.ven'      => 'required',
                'ac_opentimestart.sab'      => 'required',
                'ac_opentimestart.dom'      => 'required',
                'ac_opentimeend.lun'        => 'required',
                'ac_opentimeend.mar'        => 'required',
                'ac_opentimeend.mer'        => 'required',
                'ac_opentimeend.gio'        => 'required',
                'ac_opentimeend.ven'        => 'required',
                'ac_opentimeend.sab'        => 'required',
                'ac_opentimeend.dom'        => 'required',
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
                if(isset($_FILES['ac_image']['name']))
                    if ( 0 < $_FILES['ac_image']['error'] ) {
                        $status   =  array('stat'=>'error', 'msg'=>$_FILES['ac_image']['error']);
                        Session::flash('statmsg', $status['msg']);
                        Session::flash('status', $status['stat']);
                    }
                    else {
                        $imagename   = time().$_FILES['ac_image']['name'];
                        move_uploaded_file($_FILES['ac_image']['tmp_name'], config('constants.adminACImagePath') . $imagename);
                    }

                if(empty($inputData['ac_intro']['fr'])) {$inputData['ac_intro']['fr']=$inputData['ac_intro']['en'];}
                if(empty($inputData['ac_intro']['it'])) {$inputData['ac_intro']['it']=$inputData['ac_intro']['en'];}

                $acdata = array(
                    'id_airport'                => $inputData['ac_airport'],
                    'id_responsabile'           => '1',
                    'id_foto_postazione'        => '1',
                    'name_airport'              => $inputData['ac_name'],
                    'testo_intro_it'            => strtoupper($inputData['ac_intro']['it']),
                    'testo_intro_en'            => strtoupper($inputData['ac_intro']['en']),
                    'testo_intro_fr'            => strtoupper($inputData['ac_intro']['fr']),
                    'descrizione_it'            => $inputData['ac_descrizione']['it'],
                    'descrizione_en'            => $inputData['ac_descrizione']['en'],
                    'descrizione_fr'            => $inputData['ac_descrizione']['fr'],
                    'orario_it'                 => $inputData['ac_time']['it'],
                    'orario_en'                 => $inputData['ac_time']['en'],
                    'orario_fr'                 => $inputData['ac_time']['fr'],
                    'status'                    => (Input::get('ac_status'))? Input::get('ac_status') : '0',
                    'date_create'               => date("Y-m-d H:i:s"),
                    'lun'                       => $inputData['ac_opentimestart']['lun']. " - ". $inputData['ac_opentimeend']['lun'],
                    'mar'                       => $inputData['ac_opentimestart']['mar']. " - ". $inputData['ac_opentimeend']['mar'],
                    'mer'                       => $inputData['ac_opentimestart']['mer']. " - ". $inputData['ac_opentimeend']['mer'],
                    'gio'                       => $inputData['ac_opentimestart']['gio']. " - ". $inputData['ac_opentimeend']['gio'],
                    'ven'                       => $inputData['ac_opentimestart']['ven']. " - ". $inputData['ac_opentimeend']['ven'],
                    'sab'                       => $inputData['ac_opentimestart']['sab']. " - ". $inputData['ac_opentimeend']['sab'],
                    'dom'                       => $inputData['ac_opentimestart']['dom']. " - ". $inputData['ac_opentimeend']['dom'],
                );

                if(!empty($imagename))
                    $acdata['image']       = $imagename;

                $status  = AdminAirportContent::insertAirportContent($acdata);
                Session::flash('statmsg', $status['msg']);
                Session::flash('status', $status['stat']);
            }
        }

        $data['airportsList']  = AdminSBAirports::getAirportsList();
        return \View::make('admin.airportcontentadd')->with('data', $data);
    }
}