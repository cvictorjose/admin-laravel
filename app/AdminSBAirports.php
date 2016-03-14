<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class AdminSBAirports extends Model {

    /*
     * name:    getUserList
     * params:
     * return:
     * desc:    getUserList admin
     */
    public static function getAirportsList($qryArray=array()){
        $airportslist   = array();
        $wheredata      = array();
        $airportslist   = DB::table('airports');
        if(count($qryArray)>0)  {
            if(isset($qryArray['lastAirports']) && $qryArray['lastAirports']=='1'){
                $airportslist->orderBy('city', 'desc');
                $airportslist->take(10);
            }
            if(isset($qryArray['portId']) && $qryArray['portId']>'0'){
                $airportslist->where('iddepport', $qryArray['portId']);
                $airportslist->take(1);
            }
        }
        $airportslist->where('stato', '1');
        $airportslist->orderBy('city', 'asc');
        $airportslist   = $airportslist->get();
        return $airportslist;
    }






}