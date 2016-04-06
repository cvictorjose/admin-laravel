<?php namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
class AdminTransaction extends Model {
    /*
     * name:    getAirportContentList
     * params:  $qryArray
     * return:
     * desc:    getAirportContentList admin
     */

    public static function getTransactionList($qryArray=array()){
        $aclist         = array();
        $wheredata      = array();
        $aclist         = DB::table('sfb_transaction')
            ->join('claims_client', 'sfb_transaction.idclient', '=', 'claims_client.idclient')
            ->select('sfb_transaction.*', 'claims_client.name', 'claims_client.surname');

        $aclist->orderBy('date', 'desc');
        $aclist         = $aclist->get();
        return $aclist;
    }


}