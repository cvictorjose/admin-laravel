<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class AdminTracking extends Model {

    /*
     * name:    getAirportContentList
     * params:  $qryArray
     * return:
     * desc:    getAirportContentList admin
     */

    public static function gettrackingList($qryArray=array()){
        $aclist         = array();
        $wheredata      = array();
        $aclist         = DB::table('codebagflights')
            ->join('sfb_smartcards', 'codebagflights.idCode', '=', 'sfb_smartcards.card_id')
            ->join('claims_client', 'sfb_smartcards.idclient', '=', 'claims_client.idclient')
            ->join('flight', 'codebagflights.idFlights', '=', 'flight.idFlights')
            ->select('codebagflights.*', 'sfb_smartcards.*', 'claims_client.*', 'flight.*') ;
        if(count($qryArray)>0)  {
            if(isset($qryArray['acId']) && $qryArray['acId']>'0'){
                $aclist->where('idCode', $qryArray['acId']);
                $aclist->take(1);
            }
        }   else $aclist->orderBy('date', 'desc');
        $aclist         = $aclist->get();
        return $aclist;
    }





}