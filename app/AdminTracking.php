<?php namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
class AdminTracking extends Model {
    /*
     * name:    getAirportContentList
     * params:  $qryArray
     * return:
     * desc:    getAirportContentList admin
     */
    public static function gettrackingList($qryArray=array()){
        $aclist         = array();
        $wheredata      = array();
        $aclist         = DB::table('codebagflights')
            ->join('sfb_smartcards', 'codebagflights.idCode', '=', 'sfb_smartcards.card_id')
            ->join('claims_client', 'sfb_smartcards.idclient', '=', 'claims_client.idclient')
            ->join('flight', 'codebagflights.idFlights', '=', 'flight.idFlights');

        if(count($qryArray)>0)  {
            if(isset($qryArray['scId']) && $qryArray['scId']>'0'){
                $aclist->select(DB::raw('count(flight.idFlights) as totaltracks'));
            }
            $aclist= $aclist->get();
            return $aclist;
        }   else

        $aclist->select('codebagflights.*', 'sfb_smartcards.*', 'claims_client.*', 'flight.*') ;
        $aclist->orderBy('date', 'desc');
        $aclist         = $aclist->get();
        return $aclist;
    }


    /*
     * name:    getAirportContentList
     * params:  $qryArray
     * return:
     * desc:    getAirportContentList admin
     */
    public static function get_top_track_scheduled_dashboard($stato){
        $aclist         = array();
        $wheredata      = array();
        $aclist         = DB::table('codebagflights')
            ->join('sfb_smartcards', 'codebagflights.idCode', '=', 'sfb_smartcards.card_id')
            ->join('claims_client', 'sfb_smartcards.idclient', '=', 'claims_client.idclient')
            ->join('flight', 'codebagflights.idFlights', '=', 'flight.idFlights');



        $aclist->select('codebagflights.*', 'sfb_smartcards.*', 'claims_client.*', 'flight.*') ;
        $aclist->where('flight.status', $stato);
        $aclist->orderBy('date', 'desc');
        $aclist= $aclist->get();
        return $aclist;
    }



    /*
     * name:    getAirportContentList
     * params:  $qryArray
     * return:
     * desc:    getAirportContentList admin
     */
    public static function get_top_airlines_dashboard($scid){
        $aclist         = array();
        $wheredata      = array();

        $start="2016-$scid-01";
        $final="2016-$scid-31";
        //SELECT `company`, airlines.name_airline,Count(*) FROM flight INNER JOIN airlines ON flight.company=airlines
        // .`code_airline`
        //WHERE YEAR(departureDayLocal) = 2016 && MONTH(departureDayLocal) BETWEEN 2 AND 3 GROUP BY flight.company ORDER BY Count(*) DESC
        $aclist         = DB::table('flight')
            ->join('airlines', 'flight.company', '=', 'airlines.code_airline');
        $aclist->select(DB::raw('count(flight.company) as total, flight.company, airlines.*'));

        //$aclist->orWhere('flight.departureDayLocal', 'like', '%2016%');
        $aclist->whereBetween('flight.departureDayLocal', [$start, $final]);
        $aclist->groupBy('flight.company');
        $aclist->orderBy('total', 'desc');
        $aclist= $aclist->take(10)->get();
        return $aclist;
    }
}