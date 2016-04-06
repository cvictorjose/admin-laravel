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
        $aclist         = $aclist->get();
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
        $aclist         = DB::table('codebagflights')
            ->join('sfb_smartcards', 'codebagflights.idCode', '=', 'sfb_smartcards.card_id')
            ->join('claims_client', 'sfb_smartcards.idclient', '=', 'claims_client.idclient')
            ->join('flight', 'codebagflights.idFlights', '=', 'flight.idFlights')
            ->join('sfb_promocode', 'claims_client.idclient', '=', 'sfb_promocode.id_used_by')
            ->select('codebagflights.*', 'sfb_smartcards.*', 'claims_client.*', 'flight.*','sfb_promocode.*') ;
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
    public static function get_dashboard_promocodeList_byregistration($qryArray=array()){
        $aclist         = array();
        $wheredata      = array();
        $aclist         = DB::table('sfb_promocode')
            ->join('claims_client', 'sfb_promocode.id_used_by', '=', 'claims_client.idclient')
            ->select(DB::raw('count(claims_client.idclient) as totalclient'));
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
        $aclist         = DB::table('codebagflights')
            ->join('sfb_smartcards', 'codebagflights.idCode', '=', 'sfb_smartcards.card_id')
            ->join('claims_client', 'sfb_smartcards.idclient', '=', 'claims_client.idclient')
            ->join('flight', 'codebagflights.idFlights', '=', 'flight.idFlights')
            ->join('sfb_promocode', 'claims_client.idclient', '=', 'sfb_promocode.id_used_by')
            ->select(DB::raw('count(claims_client.idclient) as totaltracking'));
        $aclist         = $aclist->get();
        return $aclist;
    }

}