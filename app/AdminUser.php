<?php namespace App;

use DB;
use Session;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{

    /*
     * name:    getUserList
     * params:  $qryArray
     * return:
     * desc:    getUserList admin
     */
    public static function getUserList($qryArray = array())
    {
        $userlist = array();
        $wheredata = array();
        $userlist = DB::table('sfb_admin');
        if (count($qryArray) > 0) {
            if (isset($qryArray['lastActivities']) && $qryArray['lastActivities'] == '1') {
                $userlist->orderBy('last_login', 'desc');
                $userlist->take(8);
            }
            if (isset($qryArray['userId']) && $qryArray['userId'] > '0') {
                $userlist->where('id', $qryArray['userId']);
                $userlist->take(1);
            }
        } else {
            $sessionData = Session::all();
            if (!empty($sessionData) && isset($sessionData['userDetails']) && count($sessionData['userDetails']) > 0) {
                $userlist->where('id', '!=', $sessionData['userDetails']['id']);
            }
            $userlist->orderBy('id', 'desc');
        }
        $userlist = $userlist->get();
        return $userlist;
    }



}