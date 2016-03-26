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
        $aclist         = DB::table('airports_postazione')
            ->join('airports', 'airports_postazione.id_airport', '=', 'airports.iddepport')
            ->select('airports_postazione.*', 'airports.city') ;
        if(count($qryArray)>0)  {
            if(isset($qryArray['acId']) && $qryArray['acId']>'0'){
                $aclist->where('id_postazione', $qryArray['acId']);
                $aclist->take(1);
            }
        }   else $aclist->orderBy('name_airport', 'asc');
        $aclist         = $aclist->get();
        return $aclist;
    }


    public static function getAirportContentList2($qryArray=array()){
        $aclist         = array();
        $wheredata      = array();
        $aclist         = DB::table('airports_postazione')
            ->join('airports', 'airports_postazione.id_airport', '=', 'airports.iddepport')
            ->select('airports_postazione.*', 'airports.city') ;

        if(isset($qryArray['Id']) && $qryArray['Id']>'0'){
            $aclist->where('id_airport',$qryArray['Id']);
        }   else
            $aclist->orderBy('name_airport', 'asc');
        $aclist = $aclist->get();
        return $aclist;
    }

    /*
     * name:    insertAirportContent
     * params:  $acdata
     * return:
     * desc:    insertAirportContent admin
     */
    public static function insertAirportContent($acdata){

        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        $id = 0;

        $id = DB::table('airports_postazione')->insertGetId( $acdata );
        if($id>0){
            $status     = array('stat'=>'ok', 'msg'=>'Airport Content Added Successfully');
        } else {
            $status     = array('stat'=>'error', 'msg'=>'Airport Content Addition Failed');
        }
        return $status;
    }





}