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


    /*
     * name:    insertAirport
     * params:
     * return:
     * desc:    insertAirport admin
     */
    public static function insertAirport($portData){

        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        $id = 0;

        $id = DB::table('airports')->insertGetId( $portData );
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

        $ports = DB::table('airports')->where('depport', strtoupper($iata) )->select('iddepport')->orderBy('iddepport', 'desc')
            ->take(1)->get();
        if(count($ports)>0){
            $status     = array('stat'=>'error', 'msg'=>'Iata already exists');
        } else {
            $status     = array('stat'=>'ok', 'msg'=>'');
        }
        return $status;
    }








}