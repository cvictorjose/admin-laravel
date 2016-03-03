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


    /*
    * name:    insertAdminUser
    * params:  $userdata
    * return:
    * desc:    insertAdminUser admin
    */
    public static function insertAdminUser($userdata)
    {

        $status = array('stat' => 'error', 'msg' => 'Something went wrong');
        $id = 0;

        $id = DB::table('sfb_admin')->insertGetId($userdata);
        if ($id > 0) {
            $status = array('stat' => 'ok', 'msg' => 'Admin User Added Successfully');
        } else {
            $status = array('stat' => 'error', 'msg' => 'Admin User Addition Failed');
        }
        return $status;
    }


    /*
     * name:    updateAdminUser
     * params:  $userdata, $userid
     * return:
     * desc:    change the details of the User Admin
     */
    public static function updateAdminUser($userdata, $userid)
    {
        $status = array('stat' => 'error', 'msg' => 'Something went wrong');
        DB::table('sfb_admin')->where('id', $userid)->update($userdata);
        $status = array('stat' => 'ok', 'msg' => 'Admin User Edited Successfully');
        return $status;
    }

    /*
         * name:    checkUserEmail
         * params:  $useremail
         * return:
         * desc:    check if admin user email already exists
         */
    public static function checkUserEmail($useremail, $userid)
    {
        $status = array('stat' => 'error', 'msg' => 'Something went wrong');
        $users = array();

        $users = DB::table('sfb_admin')->where('email', $useremail);
        if($userid>0)
            $users  = $users->whereNotIn('id',array($userid));
        $users = $users->select('id')->orderBy('id', 'desc')->take(1)->get();
        if (count($users) > 0) {
            $status = array('stat' => 'error', 'msg' => 'Email already exists');
        } else {
            $status = array('stat' => 'ok', 'msg' => '');
        }
        return $status;
    }
    /*
     * name:    changeUserStatus
     * params:  $stat, $userid
     * return:
     * desc:    change the status of the User
     */
    public static function changeUserStatus($stat, $userid)
    {
        $status = array('stat' => 'error', 'msg' => 'Something went wrong');
        DB::table('sfb_admin')->where('id', $userid)->update(array('status' => $stat));
        $status = array('stat' => 'ok', 'msg' => '');
        return $status;

    }



}