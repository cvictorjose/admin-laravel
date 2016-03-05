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

    /*
     * name:    changeAirlineStatus
     * params:  $stat, $airlineid
     * return:
     * desc:    change the status of the Airline
     */
    public static function changeAirlineStatus($stat, $airlineid)   {
        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        DB::table('airlines')->where('idairline', $airlineid)->update(array('stato' => $stat));
        $status     = array('stat'=>'ok', 'msg'=>'');
        return $status;

    }

    /*
         * name:    insertAdminAirlines
         * params:  $airlinesdata
         * return:
         * desc:    insertAdminAirlines admin
         */
    public static function insertAdminAirlines($airlinesdata)
    {

        $status = array('stat' => 'error', 'msg' => 'Something went wrong');
        $id = 0;

        $id = DB::table('airlines')->insertGetId($airlinesdata);
        if ($id > 0) {
            $status = array('stat' => 'ok', 'msg' => 'Airlines Added Successfully');
        } else {
            $status = array('stat' => 'error', 'msg' => 'Airlines Addition Failed');
        }
        return $status;
    }

    /*
         * name:    updateAdminAirlines
         * params:  $aldata, $airlineid
         * return:
         * desc:    change the details of the Airline Admin
         */
    public static function updateAdminAirlines($aldata, $airlineid)    {
        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        DB::table('airlines')->where('idairline', $airlineid)->update( $aldata );
        $status     = array('stat'=>'ok', 'msg'=>'Airline Edited Successfully');
        return $status;
    }




}