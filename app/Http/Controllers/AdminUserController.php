<?php namespace App\Http\Controllers;

use Validator;
use Session;
use \App\AdminUser;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;

class AdminUserController extends Controller {

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
        $this->middleware('auth');
	}

	/*
     * name:    userlist
     * params:
     * return:
     * desc:    userlist admin
     */
	public function userlist(){
		$data['usersList']  = AdminUser::getUserList();
		return \View::make('admin.userlist')->with('data', $data);
	}


	/*
     * name:    useradd
     * params:
     * return:
     * desc:    useradd admin
     */
	public function useradd(){
		$inputData  = Input::all();
		$data       = array('mode'=>'add');
		if(!empty($inputData) && count($inputData)> 0 && isset($inputData['adduser'])) {
			// Applying validation rules.
			$rules = array(
				'ad_username'       => array('required', 'min:6', 'alpha_num'),
				'ad_firstname'      => 'required',
				'ad_lastname'       => 'required',
				'ad_email'          => array( 'required', 'email' ),
				'ad_pwd'            => 'required',
				'ad_cpwd'           => 'required',
				'ad_designation'    => 'required',
				'ad_access_level'   => 'required',
			);
			$validator = Validator::make($inputData, $rules);
			if ($validator->fails()) {
				// If validation falis
				$status   =  array('stat'=>'error', 'msg'=>$validator);
				Session::flash('statmsg', $status['msg']);
				Session::flash('status', $status['stat']);
				//return json_encode($status);
			} else {
				$filename   = '';
				if ( 0 < $_FILES['ad_profileimg']['error'] ) {
					$status   =  array('stat'=>'error', 'msg'=>$_FILES['ad_profileimg']['error']);
					Session::flash('statmsg', $status['msg']);
					Session::flash('status', $status['stat']);
					//return json_encode($status);
				}
				else {
					$filename   = time().$_FILES['ad_profileimg']['name'];
					move_uploaded_file($_FILES['ad_profileimg']['tmp_name'], config('constants.adminUserFotoPath') . $filename);
				}
				$userdata = array(
					'username'           => Input::get('ad_username'),
					'pass'               => sha1(Input::get('ad_pwd')),
					'access_id'          => Input::get('ad_access_level'),
					'f_name'             => Input::get('ad_firstname'),
					'l_name'             => Input::get('ad_lastname'),
					'email'              => Input::get('ad_email'),
					'designation'        => Input::get('ad_designation'),
					'profile_picture'    => $filename,
					'status'             => (Input::get('ad_status'))? Input::get('ad_status') : '0',
					'last_login'         => date('Y-m-d H:i:s'),
				);
				$status  = AdminUser::insertAdminUser($userdata);
				//return json_encode($status);
				Session::flash('statmsg', $status['msg']);
				Session::flash('status', $status['stat']);
			}
		}
		return \View::make('admin.useradd')->with('data', $data);
	}

    /*
     * name:    edituser
     * params:
     * return:
     * desc:    Change the details of the User admin
     */
    public function  edituser($userid)  {
        $inputData      = Input::all();
        $data           = array('mode'=>'edit');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['adduser'])) {
            // Applying validation rules.
            $rules = array(
                'ad_userid'         => 'required',
                'ad_username'       => array('required', 'min:6', 'alpha_num'),
                'ad_firstname'      => 'required',
                'ad_lastname'       => 'required',
                'ad_email'          => array( 'required', 'email' ),
                'ad_pwd'            => 'required',
                'ad_cpwd'           => 'required',
                'ad_designation'    => 'required',
                'ad_access_level'   => 'required',
            );
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis
                $status   =  array('stat'=>'error', 'msg'=>$validator);
                //return json_encode($status);
                Session::flash('statmsg', $status['msg']);
                Session::flash('status', $status['stat']);
            } else {
                $filename   = '';
                if ( 0 < $_FILES['ad_profileimg']['error'] ) {
                    $status   =  array('stat'=>'error', 'msg'=>$_FILES['ad_profileimg']['error']);
                    //return json_encode($status);
                    Session::flash('statmsg', $status['msg']);
                    Session::flash('status', $status['stat']);
                }
                else {
                    $filename   = time().$_FILES['ad_profileimg']['name'];
                    move_uploaded_file($_FILES['ad_profileimg']['tmp_name'], config('constants.adminUserFotoPath') . $filename);
                }

                $userdata = array(
                    'username'           => Input::get('ad_username'),
                    'pass'               => sha1(Input::get('ad_pwd')),
                    'access_id'          => Input::get('ad_access_level'),
                    'f_name'             => Input::get('ad_firstname'),
                    'l_name'             => Input::get('ad_lastname'),
                    'email'              => Input::get('ad_email'),
                    'designation'        => Input::get('ad_designation'),
                    'status'             => (Input::get('ad_status'))? Input::get('ad_status') : '0',
                    'last_login'         => date('Y-m-d H:i:s'),
                );
                if(!empty($filename))
                    $userdata['profile_picture']    = $filename;

                $status  = AdminUser::updateAdminUser($userdata, Input::get('ad_userid'));
                Session::flash('statmsg', $status['msg']);
                Session::flash('status', $status['stat']);
            }
        }
        $userdetails    = AdminUser::getUserList(array('userId'=>$userid));
        if($userdetails)
            $data['userDetails']   = $userdetails[0];
        else $data['userDetails']   = (object) array();
        return \View::make('admin.useradd')->with('data', $data);
    }



    /*
        * name:    useremailcheck
        * params:
        * return:
        * desc:    Check Duplication for Admin User Email admin
        */
    public function  useremailcheck() {
        $inputData  = Input::all();
        $status     =  array('stat'=>'error', 'msg'=>'Something went wrong');
        if(!empty($inputData) && count($inputData)> 0 && isset($inputData['useremail']) && !empty($inputData['useremail'])) {
            // Applying validation rules.
            $rules = array('useremail'          => 'required|email');
            $validator = Validator::make($inputData, $rules);
            if ($validator->fails()) {
                // If validation falis
                $status   =  array('stat'=>'error', 'msg'=>$validator);
                return json_encode($status);
            } else {
                $status  = AdminUser::checkUserEmail($inputData['useremail'], $inputData['userid']);
            }
        }   else {
            $status   =  array('stat'=>'error', 'msg'=>'Please enter the valid Email Address');
        }
        return json_encode($status);
    }


    /*
     * name:    userstatuschange
     * params:
     * return:
     * desc:    Change the status of the User admin
     */
	public function  userstatuschange() {
		$inputData  = Input::all();
		$status     =  array('stat'=>'error', 'msg'=>'Something went wrong');
		if(!empty($inputData) && count($inputData)> 0 && isset($inputData['ustat']) && $inputData['ustat']>= 0) {
			// Applying validation rules.
			$rules = array('ustat'=> 'required', 'userid'  => 'required');
			$validator = Validator::make($inputData, $rules);
			if ($validator->fails()) {
				// If validation falis
				$status   =  array('stat'=>'error', 'msg'=>$validator);
				return json_encode($status);
			} else {
				$status  = AdminUser::changeUserStatus($inputData['ustat'], $inputData['userid']);
			}
		}   else {
			$status   =  array('stat'=>'error', 'msg'=>'Details missing to change the status.');
		}
		return json_encode($status);
	}


}
