<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class AdminAirportContent extends Model {

    /*
     * name:    getAirportContentList
     * params:  $qryArray
     * return:
     * desc:    getAirportContentList admin
     */
    public static function getAirportContentList($qryArray=array()){
        $aclist         = array();
        $wheredata      = array();
        $aclist         = DB::table('airports_postazione');
        if(count($qryArray)>0)  {
            if(isset($qryArray['acId']) && $qryArray['acId']>'0'){
                $aclist->where('id_postazione', $qryArray['acId']);
                $aclist->take(1);
            }
        }   else $aclist->orderBy('name_airport', 'asc');
        $aclist         = $aclist->get();
        return $aclist;
    }



}