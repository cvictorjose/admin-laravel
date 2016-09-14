<?php namespace App\Http\Controllers;

use App\AdminTransaction;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Session;
use \App\AdminUser;
use \App\AdminPromocode;
use \App\AdminTracking;
use \App\AdminCc;

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
                $status_flight    =  config('constants.fStatus');
                foreach ($usersList as $user){
                    $client=$user->name." ". $user->surname;
                    $flight=$user->company." ".$user->number;
                    array_push($datax, array($user->card_number, $client, $user->email, $flight,
                        $user->fromAirport,$user->toAirport,$status_flight[$user->status],$user->date));
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
                $status_flight    =  config('constants.fStatus');
                foreach ($usersList as $user){
                    $client=$user->name." ". $user->surname;
                    $flight=$user->company." ".$user->number;
                    array_push($datax, array($user->card_number, $client, $user->email, $flight,
                        $user->fromAirport,$user->toAirport,$status_flight[$user->status],$user->date));
                }
                $sheet->FromArray($datax, null, 'A1', false, false);
            });
        })->download('xls');
    }



    /*
    * name:    download_all_transactions
    * params:
    * return:
    * desc:    Download  ALL transactions list admin
    */
    public function download_all_transactions(){
        $usersList  = AdminTransaction::getTransactionList();

        Excel::create('SB_All Transactions', function($excel) use($usersList) {
            $excel->sheet('All Transactions List', function($sheet) use($usersList) {
                $sheet->cells('A1:I1', function($cells) {
                    // call cell manipulation methods
                    $cells->setBackground('#f2f2f2');
                    $cells->setFontWeight('bold');
                });

                $datax= [];
                $head = array(
                    'Client',
                    'Email',
                    'Payment',
                    'Price',
                    'Currency',
                    'Id Transaction',
                    'Auth',
                    'Date',
                    'Status'


                );
                $datax = array($head);
                foreach ($usersList as $user){
                    $client=$user->name." ". $user->surname;
                    array_push($datax, array($client, $user->email,
                        $user->type,$user->amount,$user->currency,$user->idtransaction,$user->processorauth,$user->created_at,$user->status));
                }
                $sheet->FromArray($datax, null, 'A1', false, false);
            });
        })->download('xls');
    }



    /*
    * name:    download_all_refund
    * params:
    * return:
    * desc:    Download  ALL refund list admin
    */
    public function download_all_refund($id, $dal, $al){
        //$inputData  = Input::all(); echo "<pre>"; print_r($inputData);
        $searchdata = array(
            'Id'           => $id,
            'dal_date'     => "$dal",
            'al_date'      => "$al",
        );
        $usersList  = AdminCc::getCCList2($searchdata);

        Excel::create('SB_All Refund Request', function($excel) use($usersList) {
            $excel->sheet('All Refund Request List', function($sheet) use($usersList) {
                $sheet->cells('A1:O1', function($cells) {
                    // call cell manipulation methods
                    $cells->setBackground('#f2f2f2');
                    $cells->setFontWeight('bold');
                });

                $datax= [];
                $head = array(
                    'Id',
                    'Codice Sinistro',
                    'Cliente',
                    'Nazione',
                    'Servizio',
                    'Scalo partenza',
                    'Tipo sinistro',
                    'Stato Pratica',
                    'Data Partenza',
                    'Apertura Pratica',
                    'Conferma Quietanza',
                    'Data pagamento',
                    'Rimborso Richiesto',
                    'Rimborso Airline',
                    'Rimborso SafeBag'

                );

                $datax = array($head);
                foreach ($usersList as $user){
                    $stato_pratica   =  config('constants.stato_pratica');
                    $client=$user->name." ". $user->surname;

                    if($user->flight_reg_via==4){$type_service="SafeBag24";}else{
                        if($user->smartcardcode != ''){ $type_service="Smart Track"; }else{$type_service="Wrapping";}
                    }
                    $data_partenza=date('Y-m-d', $user->depdate);
                    $data_apertura=date('Y-m-d', $user->sigdate);
                    $invio_quietanza="";
                    if ($user->date_conferma_quietanza > 0)   $invio_quietanza=date('Y-m-d', $user->date_conferma_quietanza);
                    $data_pagamento="";
                    if ($user->payed > 0)   $data_pagamento=date('Y-m-d', $user->closuredate);

                    $ctype = "";
                    $total_ritardatac=0;$total_ritardatacd=0;$total_ritardatacf=0;
                    $total_damaged=0;$total_damagedf=0;
                    $total_lost=0;
                    $total_nsop=0;
                    $total_nsop_d=0;$total_nsop_df=0;
                    $total_nsop_l=0;
                    $total_nsop_r=0;$total_nsop_rd=0;$total_nsop_rf=0;


                    $total_ritardatac=$user->rt;
                    $total_ritardatacd=$user->rt_d;
                    $total_ritardatacf=$user->rt_f;
                    $total_damaged=$user->damaged;
                    $total_damagedf=$user->damaged_f;
                    $total_lost=$user->lost;
                    $total_nsop=$user->nsop;
                    $total_nsop_d=$user->op_damaged;
                    $total_nsop_df=$user->op_damaged_f;
                    $total_nsop_l=$user->op_lost;
                    $total_nsop_r=$user->op_rt;
                    $total_nsop_rd=$user->op_rt_d;
                    $total_nsop_rf=$user->op_rt_f;

                    if($total_ritardatac>0) $ctype .= "Rit.Consegna($total_ritardatac) " ;
                    if($total_ritardatacd>0) $ctype .= "Rit.Consegna+Danno($total_ritardatacd) ";
                    if($total_ritardatacf>0) $ctype .= "Rit.Consegna+Furto($total_ritardatacf) ";
                    if($total_damaged>0) $ctype .= "Danno($total_damaged) ";
                    if($total_damagedf>0) $ctype .= "Danno+Furto($total_damagedf) ";
                    if($total_lost>0) $ctype .= "Smarrimento($total_lost) ";
                    if($total_nsop>0) $ctype .= "Operatore($total_nsop) ";
                    if($total_nsop_d>0) $ctype .= "Operatore + Danno($total_nsop_d) ";
                    if($total_nsop_df>0) $ctype .= "Operatore + Danno + Furto($total_nsop_df) ";
                    if($total_nsop_l>0) $ctype .= "Operatore + Smarrimento($total_nsop_l) ";
                    if($total_nsop_r>0) $ctype .= "Operatore + Rit.Consegna($total_nsop_r) ";
                    if($total_nsop_rd>0) $ctype .= "Operatore + Rit.Consegna + Danno($total_nsop_rd) ";
                    if($total_nsop_rf>0) $ctype .= "Operatore + Rit.Consegna + Furto($total_nsop_rf) ";


                    array_push($datax, array(
                        $user->idclaim,
                        $user->claimcode,
                        $client,
                        $user->nationality,
                        $type_service,
                        $user->depport,
                        $ctype,
                        $stato_pratica[$user->stato_sinistro],
                        $data_partenza,
                        $data_apertura,
                        $invio_quietanza,
                        $data_pagamento,
                        $user->importo_richiesto,
                        $user->paidbycom,
                        $user->paidbyus
                    ));
                }
                $sheet->FromArray($datax, null, 'A1', false, false);
            });
        })->download('xls');
    }



}
