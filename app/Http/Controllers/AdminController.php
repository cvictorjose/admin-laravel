<?php namespace App\Http\Controllers;

use App\AdminPromocode;
use Validator;
use Auth;
use Session;
use \App\User;
use \App\AdminUser;
use \App\AdminAirports;
use \App\AdminAirlines;
use \App\AdminClient;
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

        /* Top last activities users */
        $lastactivities        = 1;
        $data['topUsersList']  = AdminUser::getUserList(array('lastActivities'=>$lastactivities));
        /* End */


		/* Recently Added Airports */
		$lastairports           = 1;
		$data['lastAirports']   = AdminAirports::getAirportsList(array('lastAirports'=>$lastairports));
		/* End */

		/* Recently Added Airlines */
		$lastairlines           = 1;
		$data['lastAirlines']   = AdminAirlines::getAirlinesList(array('lastAirlines'=>$lastairlines));
		/* End */


		/* Total Clients + Nationality */
		$totalclient           = 1;
		$data['totalclient']   = AdminClient::getNationalityList();
        $data['totalclientsb']   = AdminClient::getTotalClientList();
		/* End */


        /* Total PromoCode registered + Tracking */
        $totalclient           = 1;
        $data['totalpromocode_registered']   = AdminPromocode::get_dashboard_promocodeList_byregistration();
        $data['totalpromocode_tracking']   = AdminPromocode::get_dashboard_promocodeList_bytracking();
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
