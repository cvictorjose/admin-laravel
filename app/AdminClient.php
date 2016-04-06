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
    public static function  getTotalClientList()
    {
        $totalclientsb = array();
        $totalclientsb = DB::table('claims_client')
            ->select(DB::raw('count(idclient) as total'));
        $totalclientsb   = $totalclientsb->get();
        return $totalclientsb;
    }

}