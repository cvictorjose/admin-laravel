<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class AdminSBAirports extends Model {

    /*
     * name:    getAirportsList
     * params:
     * return:
     * desc:    getAirportsList frontend
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


    /*
     * name:    getAirports Safe bag
     * params:
     * return:
     * desc:    getAirports Safe bag backend
     */
    public static function getAirportsList2($qryArray=array()){
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

        $airportslist->orderBy('depport', 'asc');
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
        DB::table('airports')->where('iddepport', $airportid)->update(array('stato' => $stat));
        $status     = array('stat'=>'ok', 'msg'=>'');
        return $status;

    }





}