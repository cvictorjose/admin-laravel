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
                $y = date("Y");
                $m=$qryArray['scId'];
                $today=$y."-".$m;
                $start=$today."-01";
                $final=$today."-31";
                $aclist->select(DB::raw('count(flight.idFlights) as totaltracks'));
                $aclist->whereBetween('codebagflights.date', [$start, $final]);
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
    public static function get_top_airlines_dashboard($m){
        $aclist         = array();
        $wheredata      = array();
        $y = date("Y");

        //$today=$y."-".$m;
        $today=$y."-03";
        $start=$today."-01";
        $final=$today."-31";
        $aclist         = DB::table('flight')
            ->join('airlines', 'flight.company', '=', 'airlines.code_airline');
        $aclist->select(DB::raw('count(flight.company) as total, flight.company, airlines.*'));
        $aclist->whereBetween('flight.departureDayLocal', [$start, $final]);
        $aclist->groupBy('flight.company');
        $aclist->orderBy('total', 'desc');
        $aclist= $aclist->take(10)->get();
        return $aclist;
    }



    /*
     * name:    get_top_arrival_dashboard
     * params:  $qryArray
     * return:
     * desc:    get_top_arrival_dashboard admin
     */
    public static function get_top_arrival_dashboard($m){
        $aclist         = array();
        $y = date("Y");

        //$today=$y."-".$m;
        $today=$y."-03";
        $start=$today."-01";
        $final=$today."-31";
        $aclist         = DB::table('flight')
            ->join('airports_all', 'flight.toAirport', '=', 'airports_all.iata');
        $aclist->select(DB::raw('count(flight.toAirport) as total, airports_all.*'));
        $aclist->whereBetween('flight.departureDayLocal', [$start, $final]);
        $aclist->groupBy('flight.toAirport');
        $aclist->orderBy('total', 'desc');
        $aclist= $aclist->take(10)->get();
        return $aclist;
    }



    /*
     * name:    get_top_arrival_dashboard
     * params:  $qryArray
     * return:
     * desc:    get_top_arrival_dashboard admin
     */
    public static function get_top_departure_dashboard($m){
        $aclist         = array();
        $y = date("Y");

        //$today=$y."-".$m;
        $today=$y."-03";
        $start=$today."-01";
        $final=$today."-31";
        $aclist         = DB::table('flight')
            ->join('airports_all', 'flight.fromAirport', '=', 'airports_all.iata');
        $aclist->select(DB::raw('count(flight.fromAirport) as total, airports_all.*'));
        $aclist->whereBetween('flight.departureDayLocal', [$start, $final]);
        $aclist->groupBy('flight.fromAirport');
        $aclist->orderBy('total', 'desc');
        $aclist= $aclist->take(10)->get();
        return $aclist;
    }



    /*
     * name:    get_top_arrival_dashboard
     * params:  $qryArray
     * return:
     * desc:    get_top_arrival_dashboard admin
     */
    public static function get_top_flights_dashboard($m){
        $aclist         = array();
        $y = date("Y");

        //$today=$y."-".$m;
        $today=$y."-03";
        $start=$today."-01";
        $final=$today."-31";
        $aclist         = DB::table('flight')
            ->join('airports_all as a1', 'flight.fromAirport', '=', 'a1.iata')
            ->join('airports_all as a2', 'flight.toAirport', '=', 'a2.iata');
        $aclist->select(DB::raw('count(flight.fromAirport) as total, a1.city as fromAirport, a2.city as toAirport'));

        $aclist->groupBy('flight.fromAirport');
        $aclist->orderBy('total', 'desc');
        $aclist= $aclist->take(10)->get();
        return $aclist;
    }
}