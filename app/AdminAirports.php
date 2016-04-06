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
                $airportslist->take(7);
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


    /*
     * name:    insertAirport
     * params:
     * return:
     * desc:    insertAirport admin
     */
    public static function insertAirport($portData){

        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        $id = 0;

        $id = DB::table('airports_all')->insertGetId( $portData );
        if($id>0){
            $status     = array('stat'=>'ok', 'msg'=>'Airport Added Successfully');
        } else {
            $status     = array('stat'=>'error', 'msg'=>'Airport Addition Failed');
        }
        return $status;
    }

    /*
     * name:    checkAirportIata
     * params:  $iata
     * return:
     * desc:    check if airport iata already exists
     */
    public static function checkAirportIata($iata){
        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        $ports      = array();

        $ports = DB::table('airports_all')->where('iata', strtoupper($iata) )->select('id')->orderBy('id', 'desc')->take(1)->get();
        if(count($ports)>0){
            $status     = array('stat'=>'error', 'msg'=>'Iata already exists');
        } else {
            $status     = array('stat'=>'ok', 'msg'=>'');
        }
        return $status;
    }

    /*
     * name:    updateAdminAirport
     * params:  $portdata, $airportid
     * return:
     * desc:    change the details of the Airport Admin
     */
    public static function updateAdminAirport($portdata, $airportid)    {
        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        DB::table('airports_all')->where('id', $airportid)->update( $portdata );
        $status     = array('stat'=>'ok', 'msg'=>'Airport Edited Successfully');
        return $status;
    }



}