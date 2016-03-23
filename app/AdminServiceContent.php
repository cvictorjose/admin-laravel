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
        }   else
            $sclist->where('status', '1');
            $sclist->orderBy('id', 'desc');
        $sclist   = $sclist->get();
        return $sclist;
    }

    /*
    *
    * name:    insertServiceContent
    * params:  $scdata
    * return:
    * desc:    insertServiceContent admin
    */
    public static function insertServiceContent($scdata){

        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        $id = 0;

        $id = DB::table('sfb_site_contents')->insertGetId( $scdata );
        if($id>0){
            $status     = array('stat'=>'ok', 'msg'=>'Service Content Added Successfully');
        } else {
            $status     = array('stat'=>'error', 'msg'=>'Service Content Addition Failed');
        }
        return $status;
    }


    /*
     * name:    checkServiceContentTitle
     * params:  $titleen, $scid
     * return:
     * desc:    check if Service Content Title already exists
     */
    public static function checkServiceContentTitle($titleen, $scid=''){
        $status         = array('stat'=>'error', 'msg'=>'Something went wrong');
        $contents       = array();

        $contents = DB::table('sfb_site_contents')->where('cont_title_en', $titleen)->select('id');
        if(!empty($scid) && $scid>0)
            $contents = $contents->whereNotIn('id',array($scid));
        $contents = $contents->orderBy('id', 'desc')->take(1)->get();
        if(count($contents)>0){
            $status     = array('stat'=>'error', 'msg'=>'Title in English already exists');
        } else {
            $status     = array('stat'=>'ok', 'msg'=>'');
        }
        return $status;
    }

    /*
     * name:    updateServiceContent
     * params:  $scdata, $scid
     * return:
     * desc:    change the details of the Service Content Admin
     */
    public static function updateServiceContent($scdata, $scid)    {
        $status     = array('stat'=>'error', 'msg'=>'Something went wrong');
        DB::table('sfb_site_contents')->where('id', $scid)->update( $scdata );
        $status     = array('stat'=>'ok', 'msg'=>'Service Content Edited Successfully');
        return $status;
    }



}