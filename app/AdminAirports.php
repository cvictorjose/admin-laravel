<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class AdminAirports extends Model {

    /*
     * name:    getUserList
     * params:
     * return:
     * desc:    getUserList admin
     */
    public static function getAirportsList($qryArray=array()){
        $airportslist   = array();
        $wheredata      = array();
        $airportslist   = DB::table('airports_all');
        if(count($qryArray)>0)  {
            if(isset($qryArray['lastAirports']) && $qryArray['lastAirports']=='1'){
                $airportslist->orderBy('id', 'desc');
                $airportslist->take(10);
            }
            if(isset($qryArray['portId']) && $qryArray['portId']>'0'){
                $airportslist->where('id', $qryArray['portId']);
                $airportslist->take(1);
            }
        }
        $airportslist   = $airportslist->get();
        return $airportslist;
    }


    /*
    * name:    changeAirportStatus
    * params:  $stat, $airportid
    * return:
    * desc:    change the status of the Airport
    */
    public static function changeAirportStatus($stat, $airportid)   {
        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        DB::table('airports_all')->where('id', $airportid)->update(array('stato' => $stat));
        $status     = array('stat'=>'ok', 'msg'=>'');
        return $status;

    }



}