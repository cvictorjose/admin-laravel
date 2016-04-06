<?php namespace App;

use DB;
use Session;
use Illuminate\Database\Eloquent\Model;

class AdminClient extends Model
{

    /*
         * name:    getClientList
         * params:  $array
         * return:
         * desc:    get the List of Clients SafeBag
         */
    public static function  getClientList()
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

}