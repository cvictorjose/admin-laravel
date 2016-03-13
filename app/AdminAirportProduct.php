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




}