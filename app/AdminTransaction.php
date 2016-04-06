<?php namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
class AdminTransaction extends Model {
    /*
     * name:    getTransactionList
     * params:  $qryArray
     * return:
     * desc:    List All transaction SB24 admin
     */

    public static function getTransactionList($qryArray=array()){
        $aclist         = array();
        $wheredata      = array();
        $aclist         = DB::table('sfb_transaction')
            ->join('claims_client', 'sfb_transaction.idclient', '=', 'claims_client.idclient');
            if(count($qryArray)>0)  {
                if(isset($qryArray['scId']) && $qryArray['scId']>'0'){
                    $aclist->select(DB::raw('count(sfb_transaction.idclient) as totaltrans'));
                }
                $aclist= $aclist->get();
                return $aclist;
            }   else
            $aclist->select('sfb_transaction.*', 'claims_client.name', 'claims_client.surname');
            $aclist->orderBy('sfb_transaction.date', 'DESC');
            $aclist = $aclist->get();
         return $aclist;
    }


}