<?php namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Session;
use \App\AdminUser;
use \App\AdminPromocode;
use \App\AdminTracking;
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
     * name:    download_users_sb
     * params:
     * return:
     * desc:    Download User SafeBag list admin
     */
	public function download_users_sb(){
        $usersList  = AdminUser::getUserList();

        Excel::create('SB_UserSafeBag_List', function($excel) use($usersList) {
            $excel->sheet('UserSafeBag_List', function($sheet) use($usersList) {
                $sheet->cells('A1:G1', function($cells) {
                    // call cell manipulation methods
                    $cells->setBackground('#f2f2f2');
                    $cells->setFontWeight('bold');
                });

                $datax= [];
                $head = array(
                    'User Name',
                    'First Name',
                    'Last Name',
                    'Email',
                    'Designation',
                    'Status',
                    'Last_login'
                );

                $userDesignations    =  config('constants.userDesignations');
                $datax = array($head);
                foreach ($usersList as $user){
                    if ($user->status == 1) {$new_status="Active";}else{$new_status="Disabled";} ;
                    array_push($datax, array($user->username, $user->f_name, $user->l_name, $user->email, $userDesignations[$user->designation],
                        $new_status,$user->last_login));
                }
                $sheet->FromArray($datax, null, 'A1', false, false);
            });
        })->download('xls');
	}


    /*
     * name:    download_users_sb
     * params:
     * return:
     * desc:    Download  code registration list admin
     */
    public function download_code_registration(){
        $usersList  = AdminPromocode::getPromocodeList_byregistration();

        Excel::create('SB_PromocodeList_byregistration', function($excel) use($usersList) {
            $excel->sheet('PromocodeList_byregistration', function($sheet) use($usersList) {
                $sheet->cells('A1:H1', function($cells) {
                    // call cell manipulation methods
                    $cells->setBackground('#f2f2f2');
                    $cells->setFontWeight('bold');
                });

                $datax= [];
                $head = array(
                    'Promocode',
                    'Client',
                    'Email',
                    'Platform',
                    'Mobile',
                    'Country',
                    'Credits',
                    'Date'
                );
                $datax = array($head);
                foreach ($usersList as $user){
                    $client=$user->name." ". $user->surname;
                    array_push($datax, array($user->promocode, $client, $user->email, $user->os,
                        $user->mobile,$user->nationality,$user->credits,$user->date));
                }
                $sheet->FromArray($datax, null, 'A1', false, false);
            });
        })->download('xls');
    }




    /*
     * name:    download_code_registration_track
     * params:
     * return:
     * desc:    Download  code registration + tracking list admin
     */
    public function download_code_registration_track(){
        $usersList  = AdminPromocode::getPromocodeList_bytracking();

        Excel::create('SB_PromocodeList_byregistration-tracking', function($excel) use($usersList) {
            $excel->sheet('code registered + tracking', function($sheet) use($usersList) {
                $sheet->cells('A1:H1', function($cells) {
                    // call cell manipulation methods
                    $cells->setBackground('#f2f2f2');
                    $cells->setFontWeight('bold');
                });

                $datax= [];
                $head = array(
                    'Code',
                    'Client',
                    'Email',
                    'Flight',
                    'From',
                    'To',
                    'Status',
                    'Date'
                );
                $datax = array($head);
                foreach ($usersList as $user){
                    $client=$user->name." ". $user->surname;
                    $flight=$user->company." ".$user->number;
                    array_push($datax, array($user->card_number, $client, $user->email, $flight,
                        $user->fromAirport,$user->toAirport,$user->status,$user->date));
                }
                $sheet->FromArray($datax, null, 'A1', false, false);
            });
        })->download('xls');
    }




    /*
     * name:    download_code_registration_track
     * params:
     * return:
     * desc:    Download  ALL tracking list admin
     */
    public function download_all_track(){
        $usersList  = AdminTracking::gettrackingList();

        Excel::create('SB_All Tracking', function($excel) use($usersList) {
            $excel->sheet('All Tracking List', function($sheet) use($usersList) {
                $sheet->cells('A1:H1', function($cells) {
                    // call cell manipulation methods
                    $cells->setBackground('#f2f2f2');
                    $cells->setFontWeight('bold');
                });

                $datax= [];
                $head = array(
                    'Code',
                    'Client',
                    'Email',
                    'Flight',
                    'From',
                    'To',
                    'Status',
                    'Date'
                );
                $datax = array($head);
                foreach ($usersList as $user){
                    $client=$user->name." ". $user->surname;
                    $flight=$user->company." ".$user->number;
                    array_push($datax, array($user->card_number, $client, $user->email, $flight,
                        $user->fromAirport,$user->toAirport,$user->status,$user->date));
                }
                $sheet->FromArray($datax, null, 'A1', false, false);
            });
        })->download('xls');
    }



}
