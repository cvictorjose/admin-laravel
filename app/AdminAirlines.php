<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class AdminAirlines  extends Model {

    /*
     * name:    getAirlinesList
     * params:
     * return:
     * desc:    getAirlinesList admin
     */
    public static function getAirlinesList($qryArray=array()){
        $airlineslist   = array();
        $wheredata  = array();
        $airlineslist   = DB::table('airlines');
        if(count($qryArray)>0)  {
            if(isset($qryArray['lastAirlines']) && $qryArray['lastAirlines']=='1'){
                $airlineslist->orderBy('idairline', 'desc');
                $airlineslist->take(5);
            }
            if(isset($qryArray['alId']) && $qryArray['alId']>'0'){
                $airlineslist->where('idairline', $qryArray['alId']);
                $airlineslist->take(1);
            }
        }
        $airlineslist   = $airlineslist->get();
        return $airlineslist;
    }



}