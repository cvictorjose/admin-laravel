<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class AdminServiceContent extends Model {

    /*
     * name:    getServiceContentList
     * params:  $qryArray
     * return:
     * desc:    getServiceContentList admin
     */
    public static function getServiceContentList($qryArray=array()){
        $sclist    = array();
        $wheredata      = array();
        $sclist    = DB::table('sfb_site_contents');
        if(count($qryArray)>0)  {
            if(isset($qryArray['scId']) && $qryArray['scId']>'0'){
                $sclist->where('id', $qryArray['scId']);
                $sclist->take(1);
            }
        }   else $sclist->orderBy('cont_title_it', 'asc');
        $sclist   = $sclist->get();
        return $sclist;
    }



}