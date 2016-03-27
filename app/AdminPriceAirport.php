<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class AdminPriceAirport extends Model {

    /*
     * name:    getAirportProductList
     * params:  $qryArray
     * return:
     * desc:    getAirportProductList admin
     */
    public static function getAirportProductList($qryArray=array()){
        $aplist         = array();
        $wheredata      = array();
        $aplist         = DB::table('sfb_products');
        if(count($qryArray)>0)  {
            if(isset($qryArray['apId']) && $qryArray['apId']>'0'){
                $aplist->where('id_prodotto', $qryArray['apId']);
                $aplist->take(1);
            }
        }   else $aplist->orderBy('titolo', 'asc');
        $aplist         = $aplist->get();
        return $aplist;
    }


    /*
    * name:    changeAirportProductStatus
    * params:  $stat, $apid
    * return:
    * desc:    change the status of the Airport Product
    */
    public static function changePriceAirportStatus($stat, $apid)   {
        $apstatus     = ($stat == '1')?'1':'0';
        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        DB::table('sfb_products')->where('id_prodotto', $apid)->update(array('stato' => $apstatus));
        $status     = array('stat'=>'ok', 'msg'=>'');
        return $status;

    }





}