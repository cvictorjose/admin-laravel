<?php namespace App\Http\Controllers;

use App\AdminPromocode;
use App\AdminTracking;
use Validator;
use Auth;
use Session;
use \App\User;
use \App\AdminUser;
use \App\AdminAirports;
use \App\AdminAirlines;
use \App\AdminClient;
use \App\AdminTransaction;

use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;

class AdminController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
        $userObj   = new User();
        //$this->middleware('auth');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function login() {
		$sessionData    = Session::all();
		if(!empty($sessionData) && isset($sessionData['userDetails']) && count($sessionData['userDetails'])>0){
			return Redirect::intended('admin/dashboard');
		}

		$inputData  = Input::all();
		if(!empty($inputData) && count($inputData)> 0 && isset($inputData['signin'])) {
			// Applying validation rules.
			$rules = array(
				'login_email'   => 'required|email',
				'login_pwd'     => 'required|min:6',
			);
			$validator = Validator::make($inputData, $rules);
			if ($validator->fails()){
				// If validation falis redirect back to login.
				return Redirect::to('admin/login')->withInput(Input::except('password'))->withErrors($validator);
			}
			else {
				$userdata = array(
					'email'    => Input::get('login_email'),
					'pass'     => md5(Input::get('login_pwd')),
					'status'   => 1
				);
				$userdata['password'] = md5(Input::get('login_pwd'));
				// doing login.
				$auth = User::where('email', '=', Input::get('login_email'))->where('pass', '=', md5(Input::get('login_pwd')))->first();//exit;
				if($auth){

					Auth::login($auth);
					$userdetails                = array();
					$userdetails['id']          =  $auth->id;
					$userdetails['username']    =  $auth->username;
					$userdetails['access_id']   =  $auth->access_id;
					$userdetails['f_name']      =  $auth->f_name;
					$userdetails['l_name']      =  $auth->l_name;
					$userdetails['email']       =  $auth->email;
					$userdetails['designation'] =  $auth->designation;
					$userdetails['profile_picture']  =  $auth->profile_picture;
					$userdetails['last_login']  =  $auth->last_login;
					$userdetails['status']      =  $auth->status;

					if ($userdetails['designation']==4 || $userdetails['status']==0){
						Session::flash('error', 'Sorry, you can not access here');
						return Redirect::intended('admin/login');
					}

					Session::put('userDetails', $userdetails);
					return Redirect::intended('admin/dashboard');
                    //return "eccoci loggati";
				}   else {
					// if any error send back with message.
					Session::flash('error', 'Invalid Email-ID / Password');
				}
			}
		}
		return view('admin.login');
	}


    /*
     * name:    dashboard
     * params:
     * return:
     * desc:    dashboard admin
     */
    public function dashboard(){
        $this->middleware('auth');

		/* Total Clients */
            $data['total_client_sb24']   = AdminClient::get_dashboard_registration();
        /* Total Clients + PromoCode */
			$code="";
            $data['total_client_with_promocode']   =AdminPromocode::get_dashboard_promocodeList_byregistration($code);

		/* Total Clients + PromoCode VC */
			$code_list =  array('1' => '1','2' => '2','3' => '3','4' => '4','5' => '5',);
			foreach ($code_list as $tc1){
				$data['total_client_with_promocode_'.$tc1]=AdminPromocode::get_dashboard_promocodeList_byregistration
				($tc1);
            }
		/* End */


        /* total_transactions */
		$code="";
        $data['total_transactions']   = AdminTransaction::get_dashboard_total_transactions($code);

		$code_list =  array('CC' => 'credit_card','PP' => 'Paypal');
		foreach ($code_list as $tc1){
			$data['total_transactions_'.$tc1]=AdminTransaction::get_dashboard_total_transactions($tc1);
		}

        $code_list =  array('p1' => '1','p2' => '2','p3' => '3','p4' => '4');
		$code_list2 =  array('CC' => 'credit_card','PP' => 'Paypal');
        foreach ($code_list as $p){
			foreach ($code_list2 as $type){
            	$data['total_money_p'.$p."_".$type]=AdminTransaction::get_dashboard_total_transactions_by_pack($p,$type);
			}
        }
        /* End */


		/* Total credits */
		 $data['total_promocode']   = AdminPromocode::get_dashboard_total_promocode2();
		 $data['total_users_bis']   = AdminPromocode::get_dashboard_total_promocode_users_bis();

		 $data['total_promocode_used']   = AdminPromocode::get_dashboard_total_promocode_used();
		 $data['total_numflights_payed']   = AdminPromocode::get_dashboard_total_track_payed();
		 $data['total_numflights_payed_used']   = AdminPromocode::get_dashboard_total_track_payed_used();
		/* End */


        /* Total PromoCode registered + Tracking */
		/*for($i = 1; $i <= 2; $i++){
			$month = date("m");
			if ($i>1)$month=$month-1;
			$data['totalpromocode_registered_'.$i]   = AdminPromocode::get_dashboard_promocodeList_byregistration(array('scId'=>$month));
			$data['totalpromocode_tracking_'.$i]   = AdminPromocode::get_dashboard_promocodeList_bytracking(array('scId'=>$month));
		}*/
        /* End */


        /* Total Transactions */
		/*for($i = 1; $i <= 2; $i++){
			$month = date("m");
			if ($i>1)$month=$month-1;
			$data['total_transactions_'.$i]= AdminTransaction::getTransactionList(array('scId'=>$month));
		}*/
        /* End */

        /* Total Tracking */
		/*for($i = 1; $i <= 2; $i++){
			$month = date("m");
			if ($i>1)$month=$month-1;
			$data['total_Track_'.$i]= AdminTracking::gettrackingList(array('scId'=>$month));
		}*/
        /* End */

		/* Total Tracking Status S */
		/*$scid="S";
		$data['total_track_scheduled']= AdminTracking::get_top_track_scheduled_dashboard($scid);*/
		/* End */




        /* Top Arrival airport for month */
        /*$month = date("m");
        $data['top_flights_dash']= AdminTracking::get_top_flights_dashboard($month);
        $data['top_departure_dash']= AdminTracking::get_top_departure_dashboard($month);
        $data['top_arrival_dash']= AdminTracking::get_top_arrival_dashboard($month);*/
        /* End */


		/* Top Airlines for month */
        /*$month = date("m");
		$data['top_airlines_dash']= AdminTracking::get_top_airlines_dashboard($month);*/
		/* End */


		/* Top last activities users */
		//$lastactivities        = 1;
		//$data['topUsersList']  = AdminUser::getUserList(array('lastActivities'=>$lastactivities));
		/* End */


		/* Recently Added Airports */
		//$lastairports           = 1;
		//$data['lastAirports']   = AdminAirports::getAirportsList(array('lastAirports'=>$lastairports));
		/* End */

		/* Recently Added Airlines */
		//$lastairlines           = 1;
		//$data['lastAirlines']   = AdminAirlines::getAirlinesList(array('lastAirlines'=>$lastairlines));
		/* End */



		return \View::make('admin.dashboard')->with('data', $data);
    }


	/*
        * name:    logout
        * params:
        * return:
        * desc:    logout admin
        */
	public function logout(){
		//Auth::logout();
		Session::flush();
		return Redirect::intended('admin/login');
	}


}
