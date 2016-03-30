<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class AdminTerms extends Model {

    /*
     * name:    getTermsList
     * params:
     * return:
     * desc:    getTermsList frontend
     */

    public static function getTermsList($qryArray=array()){
        $airportslist   = array();
        $wheredata      = array();
        $airportslist   = DB::table('sfb_terms');
        if(count($qryArray)>0)  {
            if(isset($qryArray['lastAirports']) && $qryArray['lastAirports']=='1'){
                $airportslist->orderBy('term_id', 'desc');
                $airportslist->take(10);
            }
            if(isset($qryArray['portId']) && $qryArray['portId']>'0'){
                $airportslist->where('term_id', $qryArray['portId']);
                $airportslist->take(1);
            }
        }

        $airportslist->orderBy('term_id', 'desc');
        $airportslist   = $airportslist->get();
        return $airportslist;
    }


    /*
     * name:    insertAirport
     * params:
     * return:
     * desc:    insertAirport admin
     */
    public static function insertTerms($portData){

        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        $id = 0;

        $id = DB::table('sfb_terms')->insertGetId( $portData );
        if($id>0){
            $status     = array('stat'=>'ok', 'msg'=>'Terms Added Successfully');
        } else {
            $status     = array('stat'=>'error', 'msg'=>'Terms Addition Failed');
        }
        return $status;
    }



    /*
     * name:    updateAdminAirport
     * params:  $portdata, $airportid
     * return:
     * desc:    change the details of the Airport Admin
     */
    public static function updateTerms($portdata, $airportid)    {
        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        DB::table('sfb_terms')->where('term_id', $airportid)->update( $portdata );
        $status     = array('stat'=>'ok', 'msg'=>'Terms Edited Successfully');
        return $status;
    }




}