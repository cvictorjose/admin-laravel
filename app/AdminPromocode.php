<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class AdminPromocode extends Model {

    /*
     * name:    getAirportContentList
     * params:  $qryArray
     * return:
     * desc:    getAirportContentList admin
     */

    public static function getPromocodeList($qryArray=array()){
        $aclist         = array();
        $wheredata      = array();
        $aclist         = DB::table('sfb_promocode');
        $aclist->orderBy('id', 'desc');
        $aclist         = $aclist->take(100)->get();
        return $aclist;
    }


    public static function getPromocodeList_byregistration($qryArray=array()){
        $aclist         = array();
        $wheredata      = array();
        $aclist         = DB::table('sfb_promocode')
            ->join('claims_client', 'sfb_promocode.id_used_by', '=', 'claims_client.idclient')
            ->select('sfb_promocode.*', 'claims_client.*');

        if(count($qryArray)>0)  {
            if(isset($qryArray['acId']) && $qryArray['acId']>'0'){
                $aclist->where('id_used_by', $qryArray['acId']);
                $aclist->take(1);
            }
        }   else $aclist->orderBy('date', 'desc');
        $aclist         = $aclist->get();
        return $aclist;
    }




    public static function getPromocodeList_bytracking($qryArray=array()){
        $aclist         = array();
        $wheredata      = array();
        $aclist         = DB::table('CodeBagFlights')
            ->join('sfb_smartcards', 'CodeBagFlights.idCode', '=', 'sfb_smartcards.card_id')
            ->join('claims_client', 'sfb_smartcards.idclient', '=', 'claims_client.idclient')
            ->join('Flight', 'CodeBagFlights.idFlights', '=', 'Flight.idFlights')
            ->join('sfb_promocode', 'claims_client.idclient', '=', 'sfb_promocode.id_used_by')
            ->select('CodeBagFlights.*', 'sfb_smartcards.*', 'claims_client.*', 'Flight.*','sfb_promocode.*') ;
        $aclist->orderBy('sfb_promocode.date', 'desc');
        $aclist         = $aclist->get();
        return $aclist;
    }

    /*
     * name:    get_dashboard_promocodeList_byregistration
     * params:  $qryArray
     * return:
     * desc:    Total clients - registered code admin
     */
    public static function get_dashboard_promocodeList_byregistration($code){
        $aclist         = array();
        $wheredata      = array();
        $y = date("Y");
        $aclist= DB::table('sfb_promocode')
            ->join('claims_client', 'sfb_promocode.id_used_by', '=', 'claims_client.idclient')
            ->select(DB::raw('count(*) as total, MONTH(sfb_promocode.date) as month'));
        $aclist->where('sfb_promocode.date', 'like', '%'.$y.'-%');
        $aclist->where('sfb_promocode.promocode', 'like', '%'.$code.'%');

        $aclist->groupBy('month');
        $aclist         = $aclist->get();
        return $aclist;
    }


    /*
     * name:    get_dashboard_promocodeList_byregistration
     * params:  $qryArray
     * return:
     * desc:    Total clients - registered code admin
     */
    public static function get_dashboard_promocodeList_bytracking($qryArray=array()){
        $aclist         = array();
        $wheredata      = array();

        $y = date("Y");
        $m=$qryArray['scId'];
        $today=$y."-".$m;
        $start=$today."-01";
        $final=$today."-31";

        $aclist         = DB::table('CodeBagFlights')
            ->join('sfb_smartcards', 'CodeBagFlights.idCode', '=', 'sfb_smartcards.card_id')
            ->join('claims_client', 'sfb_smartcards.idclient', '=', 'claims_client.idclient')
            ->join('Flight', 'CodeBagFlights.idFlights', '=', 'Flight.idFlights')
            ->join('sfb_promocode', 'claims_client.idclient', '=', 'sfb_promocode.id_used_by')
            ->select(DB::raw('count(claims_client.idclient) as totaltracking'));
        $aclist->whereBetween('CodeBagFlights.date', [$start, $final]);
        $aclist         = $aclist->get();
        return $aclist;
    }



    /*
     * name:    search_promocode
     * params:  $code
     * return:
     * desc:    Search a promocode into Db
     */
    public static function search_promocode($code){
        $aclist       = array();
        $aclist = DB::table('sfb_promocode')->where('promocode', 'like', '%' .$code.'%')->get();
        return $aclist;
    }

}