<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class AdminAirportProduct extends Model {

    /*
     * name:    getAirportProductList
     * params:  $qryArray
     * return:
     * desc:    getAirportProductList admin
     */
    public static function getAirportProductList($qryArray=array()){
        $aplist         = array();
        $wheredata      = array();
        $aplist         = DB::table('airports_products');
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
    public static function changeAirportProductStatus($stat, $apid)   {
        $apstatus     = ($stat == '1')?'1':'0';
        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        DB::table('airports_products')->where('id_prodotto', $apid)->update(array('stato' => $apstatus));
        $status     = array('stat'=>'ok', 'msg'=>'');
        return $status;

    }


    /*
    * name:    insertAirportProduct
    * params:  $apdata
    * return:
    * desc:    insertAirportProduct admin
    */
    public static function insertAirportProduct($apdata){

        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        $id = 0;

        $id = DB::table('airports_products')->insertGetId( $apdata );
        if($id>0){
            $status     = array('stat'=>'ok', 'msg'=>'Airport Product Added Successfully');
        } else {
            $status     = array('stat'=>'error', 'msg'=>'Airport Product Addition Failed');
        }
        return $status;
    }


    /*
     * name:    updateAirportProduct
     * params:  $apdata, $apid
     * return:
     * desc:    change the details of the Airport Product Admin
     */
    public static function updateAirportProduct($apdata, $apid)    {
        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        DB::table('airports_products')->where('id_prodotto', $apid)->update( $apdata );
        $status     = array('stat'=>'ok', 'msg'=>'Airport Product Edited Successfully');
        return $status;
    }




}