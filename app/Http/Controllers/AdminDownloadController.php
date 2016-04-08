<?php namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Session;
use \App\AdminUser;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Redirect;

class AdminDownloadController extends Controller {

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
	public function download_users_sb(){

        $usersList  = AdminUser::getUserList();

        Excel::create('victorexcel', function($excel) use($usersList) {
            $excel->sheet('Sheetshit', function($sheet) use($usersList) {

                $datax= [];
                $head = array(
                    'User Name',
                    'First Name',
                    'Last Name',
                    'Email',
                    'Designation',
                    'Status'
                );


                $datax = array($head);
                foreach ($usersList as $user){
                    array_push($datax, array($user->username, $user->f_name, $user->l_name, $user->email, '',
                        $user->status));

                }
                $sheet->FromArray($datax, null, 'A1', false, false);
            });
        })->download('xls');


	}



}
