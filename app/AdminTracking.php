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
        $aclist         = DB::table('CodeBagFlights')
            ->join('sfb_smartcards', 'CodeBagFlights.idCode', '=', 'sfb_smartcards.card_id')
            ->join('claims_client', 'sfb_smartcards.idclient', '=', 'claims_client.idclient')
            ->join('Flight', 'CodeBagFlights.idFlights', '=', 'Flight.idFlights');

        if(count($qryArray)>0)  {
            if(isset($qryArray['scId']) && $qryArray['scId']>'0'){
                $y = date("Y");
                $m=$qryArray['scId'];
                $today=$y."-".$m;
                $start=$today."-01";
                $final=$today."-31";
                $aclist->select(DB::raw('count(Flight.idFlights) as totaltracks'));
                $aclist->whereBetween('CodeBagFlights.date', [$start, $final]);
            }
            $aclist= $aclist->get();
            return $aclist;
        }   else

        $aclist->select('CodeBagFlights.*', 'sfb_smartcards.*', 'claims_client.*', 'Flight.*') ;
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
        $aclist         = DB::table('CodeBagFlights')
            ->join('sfb_smartcards', 'CodeBagFlights.idCode', '=', 'sfb_smartcards.card_id')
            ->join('claims_client', 'sfb_smartcards.idclient', '=', 'claims_client.idclient')
            ->join('Flight', 'CodeBagFlights.idFlights', '=', 'Flight.idFlights');



        $aclist->select('CodeBagFlights.*', 'sfb_smartcards.*', 'claims_client.*', 'Flight.*') ;
        $aclist->where('Flight.status', $stato);
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
        $aclist         = DB::table('Flight')
            ->join('airlines', 'Flight.company', '=', 'airlines.code_airline');
        $aclist->select(DB::raw('count(Flight.company) as total, Flight.company, airlines.*'));
        $aclist->whereBetween('Flight.departureDayLocal', [$start, $final]);
        $aclist->groupBy('Flight.company');
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
        $aclist         = DB::table('Flight')
            ->join('airports_all', 'Flight.toAirport', '=', 'airports_all.iata');
        $aclist->select(DB::raw('count(Flight.toAirport) as total, airports_all.*'));
        $aclist->whereBetween('Flight.departureDayLocal', [$start, $final]);
        $aclist->groupBy('Flight.toAirport');
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
        $aclist         = DB::table('Flight')
            ->join('airports_all', 'Flight.fromAirport', '=', 'airports_all.iata');
        $aclist->select(DB::raw('count(Flight.fromAirport) as total, airports_all.*'));
        $aclist->whereBetween('Flight.departureDayLocal', [$start, $final]);
        $aclist->groupBy('Flight.fromAirport');
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
        $aclist         = DB::table('Flight')
            ->join('airports_all as a1', 'Flight.fromAirport', '=', 'a1.iata')
            ->join('airports_all as a2', 'Flight.toAirport', '=', 'a2.iata');
        $aclist->select(DB::raw('count(Flight.fromAirport) as total, a1.city as fromAirport, a2.city as toAirport'));

        $aclist->groupBy('Flight.fromAirport');
        $aclist->orderBy('total', 'desc');
        $aclist= $aclist->take(10)->get();
        return $aclist;
    }
}