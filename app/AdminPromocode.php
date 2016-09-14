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
        $aclist         = DB::table('sb24_promocode')
        ->join('claims_client', 'sb24_promocode.id_used_by', '=', 'claims_client.idclient')
        ->join('sb24_promotype', 'sb24_promocode.id_type', '=', 'sb24_promotype.id')
         ->select('sb24_promocode.*', 'claims_client.*', 'sb24_promotype.name as type');
        $aclist->where('sb24_promocode.promocode', '!=', 'claims_client.uuid');
        $aclist->orderBy('id', 'desc');
        $aclist         = $aclist->take(100)->get();
        return $aclist;
    }


    public static function getPromocodeList_byregistration($qryArray=array()){
        $aclist         = array();
        $wheredata      = array();
        $aclist         = DB::table('sb24_promocode')
            ->join('claims_client', 'sb24_promocode.id_used_by', '=', 'claims_client.idclient')
            ->select('sb24_promocode.*', 'claims_client.*');
        if(count($qryArray)>0)  {
            if(isset($qryArray['acId']) && $qryArray['acId']>'0'){
                $aclist->where('id_used_by', $qryArray['acId']);
                $aclist->take(1);
            }
        }   else
        $aclist->where('sb24_promocode.promocode', '!=', 'claims_client.uuid');
        $aclist->orderBy('sb24_promocode.date', 'desc');
        $aclist         = $aclist->get();
        return $aclist;
    }




    public static function getPromocodeList_bytracking($qryArray=array()){
        $aclist         = array();
        $wheredata      = array();
        $aclist         = DB::table('sb24_codebagflights')
            ->join('sfb_smartcards', 'sb24_codebagflights.idCode', '=', 'sfb_smartcards.card_id')
            ->join('claims_client', 'sfb_smartcards.idclient', '=', 'claims_client.idclient')
            ->join('sb24_flight', 'sb24_codebagflights.idFlights', '=', 'sb24_flight.idFlights')
            ->join('sb24_promocode', 'claims_client.idclient', '=', 'sb24_promocode.id_used_by')
            ->select('sb24_codebagflights.*', 'sfb_smartcards.*', 'claims_client.*', 'sb24_flight.*','sb24_promocode.*') ;
        $aclist->where('sb24_promocode.promocode', '!=', 'claims_client.uuid');
        $aclist->orderBy('sb24_promocode.date', 'desc');
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
        $aclist = DB::table('sb24_promocode')->where('promocode', '=', $code)->get();
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
        $aclist= DB::table('sb24_promocode')
            ->join('claims_client', 'sb24_promocode.id_used_by', '=', 'claims_client.idclient')
            ->select(DB::raw('count(*) as total, MONTH(sb24_promocode.date) as month'));
        $aclist->where('sb24_promocode.date', 'like', '%'.$y.'-%');
        if ($code>0){

            $aclist->where('sb24_promocode.id_type', "=", "$code");
        }
        $aclist->where('sb24_promocode.promocode', '!=', 'claims_client.uuid');
        $aclist->groupBy('month');
        $aclist         = $aclist->get();
        return $aclist;
    }



    /*
    * name:    get_total_promocode
    * params:  $qryArray
    * return:
    * desc:    Total promocode into market
    */
    public static function get_dashboard_total_promocode(){
        $aclist         = array();
        $aclist= DB::table('sb24_promocode')
            ->join('claims_client', 'sb24_promocode.id_used_by', '=', 'claims_client.idclient')
            ->select(DB::raw('count(*) as total'));
        $aclist->where('sb24_promocode.promocode', '!=', 'claims_client.uuid');
        $aclist = $aclist->get();
        return $aclist;
    }

    /*
    * name:    get_dashboard_total_promocode2
    * params:  $qryArray
    * return:
    * desc:    Total promocode without where
    */
    public static function get_dashboard_total_promocode2(){
        $aclist         = array();
        $aclist= DB::table('sb24_promocode')
            ->select(DB::raw('count(*) as total'));
        $aclist = $aclist->get();
        return $aclist;
    }

    /*
    * name:    get_dashboard_total_promocode_users_bis
    * params:  $qryArray
    * return:
    * desc:    Total promocode user bis, idem promocode and uuid
    */
    public static function get_dashboard_total_promocode_users_bis(){
        $aclist         = array();
        $aclist= DB::table('sb24_promocode')
            ->join('claims_client', 'sb24_promocode.id_used_by', '=', 'claims_client.idclient')
            ->select(DB::raw('count(*) as total'));
        $aclist->where('sb24_promocode.promocode', '=', 'claims_client.uuid');
        $aclist = $aclist->get();
        return $aclist;
    }


    /*
    * name:    get_total_promocode_used
    * params:  $qryArray
    * return:
    * desc:    Total promocode into market
    */
    public static function get_dashboard_total_promocode_used(){
        $aclist         = array();
        $aclist= DB::table('sb24_promocode')
            ->select(DB::raw('count(*) as total'));
        $aclist->where('id_used_by', ">", "0");
        $aclist = $aclist->get();
        return $aclist;
    }


    /*
    * name:    get_dashboard_total_numflights
    * params:  $qryArray
    * return:
    * desc:    Total credits payed
    */
    public static function get_dashboard_total_track_payed(){
        $aclist         = array();
        $aclist= DB::table('sb24_transaction')
            ->select(DB::raw('count(*) as total'));
        $aclist = $aclist->get();
        return $aclist;
    }


    /*
    * name:    get_dashboard_total_numflights
    * params:  $qryArray
    * return:
    * desc:    Total credits payed + used
    */
    public static function get_dashboard_total_track_payed_used(){
        $aclist         = array();
        $wheredata      = array();
        $aclist         = DB::table('sb24_codebagflights')
            ->join('sfb_smartcards', 'sb24_codebagflights.idCode', '=', 'sfb_smartcards.card_id')
            ->join('claims_client', 'sfb_smartcards.idclient', '=', 'claims_client.idclient')
            ->select(DB::raw('count(claims_client.idclient) as total'));

        $aclist->whereIn('claims_client.idclient', function($query)
        {
            $query->select('idclient')
                ->from('sb24_transaction');
        });

        $aclist->where('sb24_codebagflights.idFlights', '>', '0');
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

        $aclist         = DB::table('sb24_codebagflights')
            ->join('sfb_smartcards', 'sb24_codebagflights.idCode', '=', 'sfb_smartcards.card_id')
            ->join('claims_client', 'sfb_smartcards.idclient', '=', 'claims_client.idclient')
            ->join('sb24_flight', 'sb24_codebagflights.idFlights', '=', 'sb24_flight.idFlights')
            ->join('sb24_promocode', 'claims_client.idclient', '=', 'sb24_promocode.id_used_by')
            ->select(DB::raw('count(claims_client.idclient) as totaltracking'));
        $aclist->whereBetween('sb24_codebagflights.date', [$start, $final]);
        $aclist         = $aclist->get();
        return $aclist;
    }





}