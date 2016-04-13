<?php namespace App;

use DB;
use Session;
use Illuminate\Database\Eloquent\Model;

class AdminClient extends Model
{

    /*
         * name:    getNationalityList
         * params:  $array
         * return:
         * desc:    get the List of Clients Nationality SafeBag
         */
    public static function  getNationalityList()
    {
        $clientlist = array();
        //$clientlist = DB::table('claims_client')->orderBy('idclient', 'desc')->get();
        $clientlist         = DB::table('claims_client')
        ->select(DB::raw('count(nationality) as nat, nationality'))
        ->groupBy('nationality')
        ->orderBy('nat', 'desc');
        $clientlist->take(7);
        $clientlist   = $clientlist->get();

        return $clientlist;
    }


    /*
        * name:    getTotalClientList
        * params:  $array
        * return:
        * desc:    get the List of Clients  SafeBag
        */
    public static function  get_dashboard_registration($qryArray=array()){
    {
        $aclist         = array();
        $wheredata      = array();

        $y = date("Y");
        $m=$qryArray['scId'];
        $today=$y."-".$m;
        $start=$today."-01";
        $final=$today."-31";

        $aclist= DB::table('codebagflights')
            ->join('sfb_smartcards', 'codebagflights.idCode', '=', 'sfb_smartcards.card_id')
            ->join('claims_client', 'sfb_smartcards.idclient', '=', 'claims_client.idclient')
            ->select(DB::raw('count(claims_client.idclient) as total'));
        $aclist->whereBetween('claims_client.usr_signup_date', [$start, $final]);
        $aclist = $aclist->get();
        return $aclist;
    }
   }
}