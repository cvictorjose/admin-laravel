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
        $aclist         = DB::table('sb24_transaction')
            ->join('claims_client', 'sb24_transaction.idclient', '=', 'claims_client.idclient');
            if(count($qryArray)>0)  {
                if(isset($qryArray['scId']) && $qryArray['scId']>'0'){
                    $y = date("Y");
                    $m=$qryArray['scId'];
                    $today=$y."-".$m;
                    $start=$today."-01";
                    $final=$today."-31";
                    $aclist->select(DB::raw('count(sb24_transaction.idclient) as totaltrans'));
                    $aclist->whereBetween('sb24_transaction.date', [$start, $final]);
                }
                $aclist= $aclist->get();
                return $aclist;
            }   else
            $aclist->select('sb24_transaction.*', 'claims_client.name', 'claims_client.surname', 'claims_client.email');
            $aclist->orderBy('sb24_transaction.created_at', 'DESC');
            $aclist = $aclist->get();
         return $aclist;
    }



    /*
     * name:    get_dashboard_total_transactions
     * params:  $qryArray
     * return:
     * desc:    Total transactions registered + total price for month
     */
    public static function get_dashboard_total_transactions($code){
        $aclist         = array();
        $wheredata      = array();
        $y = date("Y");
        $aclist= DB::table('sb24_transaction')
            ->select(DB::raw('MONTH(created_at) as month, sum(amount) as total'));
        $aclist->where('created_at', 'like', '%'.$y.'-%');
        if ($code!=""){
            $aclist->where('sb24_transaction.type', "=", "$code");
        }
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
    public static function get_dashboard_total_transactions_by_pack($num_pack,$type){
        $aclist         = array();
        $wheredata      = array();
        $y = date("Y");
        $aclist= DB::table('sb24_transaction')
            ->select(DB::raw('MONTH(created_at) as month, sum(amount) as total, idpack'));
        $aclist->where('created_at', 'like', '%'.$y.'-%');
        $aclist->where('idpack', "=", "$num_pack");
        if ($type!=""){
            $aclist->where('sb24_transaction.type', "=", "$type");
        }
        $aclist->groupBy('month');

        $aclist= $aclist->get();
        return $aclist;
    }





}