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
                    $y = date("Y");
                    $m=$qryArray['scId'];
                    $today=$y."-".$m;
                    $start=$today."-01";
                    $final=$today."-31";
                    $aclist->select(DB::raw('count(sfb_transaction.idclient) as totaltrans'));
                    $aclist->whereBetween('sfb_transaction.date', [$start, $final]);
                }
                $aclist= $aclist->get();
                return $aclist;
            }   else
            $aclist->select('sfb_transaction.*', 'claims_client.name', 'claims_client.surname', 'claims_client.email');
            $aclist->orderBy('sfb_transaction.date', 'DESC');
            $aclist = $aclist->get();
         return $aclist;
    }



    /*
     * name:    get_dashboard_total_transactions
     * params:  $qryArray
     * return:
     * desc:    Total transactions registered + total price for month
     */
    public static function get_dashboard_total_transactions(){
        $aclist         = array();
        $wheredata      = array();
        $y = date("Y");
        $aclist= DB::table('sfb_transaction')
            ->select(DB::raw('MONTH(date) as month, sum(price) as total'));
        $aclist->where('date', 'like', '%'.$y.'-%');
        $aclist->groupBy('month');
        $aclist= $aclist->get();
        return $aclist;
    }



    /*
     * name:    get_dashboard_total_transactions_by_numfights
     * params:  $qryArray
     * return:
     * desc:    Total transactions registered + total price for month
     */
    public static function get_dashboard_total_transactions_by_numfights($num_flights){
        $aclist         = array();
        $wheredata      = array();
        $y = date("Y");
        $aclist= DB::table('sfb_transaction')
            ->select(DB::raw('MONTH(date) as month, sum(price) as total, numflights'));
        $aclist->where('date', 'like', '%'.$y.'-%');
        $aclist->where('numflights', ''.$num_flights.'');
        $aclist->groupBy('numflights','month');
        $aclist->orderBy('month', 'ASC');
        $aclist= $aclist->get();
        return $aclist;
    }





}