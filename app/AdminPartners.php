<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class AdminPartners extends Model {

    /*
     * name:    getAirportsList
     * params:
     * return:
     * desc:    getAirportsList frontend
     */
    public static function getAirportsList($qryArray=array()){
        $partnerslist   = array();
        $wheredata      = array();
        $partnerslist   = DB::table('airports');
        if(count($qryArray)>0)  {
            if(isset($qryArray['lastAirports']) && $qryArray['lastAirports']=='1'){
                $partnerslist->orderBy('city', 'desc');
                $partnerslist->take(10);
            }
            if(isset($qryArray['portId']) && $qryArray['portId']>'0'){
                $partnerslist->where('iddepport', $qryArray['portId']);
                $partnerslist->take(1);
            }
        }
        $partnerslist->where('stato', '1');
        $partnerslist->orderBy('city', 'asc');
        $partnerslist   = $partnerslist->get();
        return $partnerslist;
    }


    /*
     * name:    getPartnersList Safe bag
     * params:
     * return:
     * desc:    getPartnersList Safe bag backend
     */
    public static function getPartnersList($qryArray=array()){
        $partnerslist   = array();
        $wheredata      = array();
        $partnerslist   = DB::table('sb24_partnercode');
        if(count($qryArray)>0)  {

            if(isset($qryArray['portId']) && $qryArray['portId']>'0'){
                $partnerslist->where('id', $qryArray['portId']);
                $partnerslist->take(1);
            }
        }

        $partnerslist->orderBy('id', 'desc');
        $partnerslist   = $partnerslist->get();
        return $partnerslist;
    }

    /*
   * name:    changeAirportStatus
   * params:  $stat, $airportid
   * return:
   * desc:    change the status of the Airport
   */
    public static function changePartnerStatus($stat, $id)   {
        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        DB::table('sb24_partnercode')->where('id', $id)->update(array('status' => $stat));
        $status     = array('stat'=>'ok', 'msg'=>'');
        return $status;

    }


    /*
     * name:    insertPartner
     * params:
     * return:
     * desc:    insertPartner admin
     */
    public static function insertPartner($portData){

        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        $id = 0;

        $id = DB::table('sb24_partnercode')->insertGetId( $portData );
        if($id>0){
            $status     = array('stat'=>'ok', 'msg'=>'Partner Added Successfully');
        } else {
            $status     = array('stat'=>'error', 'msg'=>'Partner Addition Failed');
        }
        return $status;
    }


    /*
     * name:    checkPartnerCode
     * params:  PartnerCode
     * return:
     * desc:    check if PartnerCode already exists
     */
    public static function checkPartnerCode($code){
        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        $ports      = array();

        $ports = DB::table('sb24_partnercode')->where('code', strtoupper($code) )->select('id')->orderBy
        ('id', 'desc')->take(1)->get();
        if(count($ports)>0){
            $status     = array('stat'=>'error', 'msg'=>'Code already exists');
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
    public static function updatePartner($portdata, $id)    {
        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        DB::table('sb24_partnercode')->where('id', $id)->update( $portdata );
        $status     = array('stat'=>'ok', 'msg'=>'Partner Edited Successfully');
        return $status;
    }




}