<?php namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class AdminCc  extends Model {

    /*
     * SELECT claims.idclaim, claims.claimcode, bag.safebagcode, client.name, client.surname, client.nationality, claims.sigdate, bag.depport, claims.damaged, claims.lost, claims.nsop, claims.stato_sinistro, client.password, client.idclient, bag.depdate
     * FROM claims
     * INNER JOIN claims_client AS client ON claims.idclient = client.idclient
     * INNER JOIN claims_bag AS bag ON claims.idclaim = bag.idclaim
     * GROUP BY claims.claimcode
     * ORDER BY `claims`.`idclaim` DESC
     *
     * name:    getAirlinesList
     * params:
     * return:
     * desc:    getAirlinesList admin
     */
    public static function  getCCList(){
        {

            $aclist= DB::table('claims')
                ->join('claims_client', 'claims.idclient', '=', 'claims_client.idclient')
                ->join('claims_bag', 'claims.idclaim', '=', 'claims_bag.idclaim')
                ->join('claims_closed', 'claims.idclaim', '=', 'claims_closed.idclaim');
                //->join('claims_close_refund', 'claims.idclaim', '=', 'claims_close_refund.idclaim');
            $aclist->groupBy('claims.claimcode');
            $aclist->orderBy('claims.idclaim', 'desc');
            $aclist = $aclist->get();
            return $aclist;
        }
    }

    public static function  getCCList2($qryArray=array()){
        {

            $start= $qryArray['dal_date'];
            $final=$qryArray['al_date'];

            $aclist= DB::table('claims')
                ->join('claims_client', 'claims.idclient', '=', 'claims_client.idclient')
                ->join('claims_bag', 'claims.idclaim', '=', 'claims_bag.idclaim')
                ->join('claims_closed', 'claims.idclaim', '=', 'claims_closed.idclaim');

            if ($qryArray['Id']<10){
                $aclist->where('stato_sinistro', $qryArray['Id']);
            }

            if ($start>0 && !empty($start) ){
                $aclist->where('sigdate', '>', $start);
            }

            if ($final>0 || !empty($final)){
                $aclist->where('sigdate', '<', $final);
            }



            $aclist->groupBy('claims.claimcode');
            $aclist->orderBy('claims.claimcode', 'desc');
            $aclist = $aclist->get();
            return $aclist;
        }
    }


}