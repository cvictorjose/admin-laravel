<?php foreach($data as $k=>$v) $$k=$v;  $status_flight    =  config('constants.fStatus');?>
@extends('admin.app')
@section('header')
    <h1>
        DashBoard
        <small>Safe-bag Admin</small>
    </h1>

@endsection
@section('content')

    <div class="row">
        <div style="padding-bottom: 5px; padding-left:15px;" class="text-bold text-uppercaInfse">STATS - Month
            04/03</div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-gift"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">PromoCode</span>
                    <strong>Registered:</strong>
                    @if (count($totalpromocode_registered_1)>0)
                        @foreach ($totalpromocode_registered_1 as $tc1)
                            {{$tc1->totalclient}}
                        @endforeach
                    @endif
                    -
                    @if (count($totalpromocode_registered_2)>0)
                        @foreach ($totalpromocode_registered_2 as $tc2)
                            {{$tc2->totalclient}}
                        @endforeach
                    @endif

                    <br>
                    <strong>Tracking:</strong>
                    @if (count($totalpromocode_tracking_1)>0)
                        @foreach ($totalpromocode_tracking_1 as $tc1)
                            {{$tc1->totaltracking}}
                        @endforeach
                    @endif
                    -
                    @if (count($totalpromocode_tracking_2)>0)
                        @foreach ($totalpromocode_tracking_2 as $tc2)
                            {{$tc2->totaltracking}}
                        @endforeach
                    @endif
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-bar-chart"></i></span>
                <div class="info-box-content">TRACKING</span>
                    <span class="info-box-number">
                        @if (count($total_Track_1)>0)
                            @foreach ($total_Track_1 as $tc1)
                                {{$tc1->totaltracks}} Flights
                            @endforeach
                        @endif
                      </span>
                      <span>
                          @if (count($total_Track_2)>0)
                              @foreach ($total_Track_2 as $tc2)
                                  {{$tc2->totaltracks}} Flights
                              @endforeach
                          @endif
                      </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-eur"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Trasactions</span>
                    <span class="info-box-number">
                        @if (count($total_transactions_1)>0)
                            @foreach ($total_transactions_1 as $tc1)
                                {{$tc1->totaltrans}} Payments
                            @endforeach
                        @endif
                    </span>
                    <span>
                      @if (count($total_transactions_2)>0)
                            @foreach ($total_transactions_2 as $tc2)
                                {{$tc2->totaltrans}} Payments
                            @endforeach
                        @endif
                  </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">CLIENTS</span>

                  <span class="info-box-number">
                        @if (count($totalclientsb_1)>0)
                          @foreach ($totalclientsb_1 as $tc1)
                              {{$tc1->total}} new users
                          @endforeach
                      @endif
                    </span>
                    <span>
                      @if (count($totalclientsb_2)>0)
                            @foreach ($totalclientsb_2 as $tc2)
                                {{$tc2->total}} users
                            @endforeach
                        @endif
                  </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
    </div><!-- /.row -->





    <div class="row panel panel-default" style="padding-top: 15px;">

        <div style="padding-bottom: 5px; padding-left:15px;" class="text-bold text-uppercase">Information About Tracking
            SafeBag24 - Month 04</div>

        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Top Flights - Tracking</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped" style="font-size:smaller">
                        <tbody>
                        <tr>
                            <th style="width: 10px">Total</th>
                            <th>From</th>
                            <th>To</th>
                        </tr>
                        @if (count($top_flights_dash)>0)
                            @foreach ($top_flights_dash as $tf)
                                <tr>
                                    <td>{{$tf->total}}</td>
                                    <td>{{$tf->fromAirport}}</td>
                                    <td>{{$tf->toAirport}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody></table>
                </div><!-- /.box-body -->
            </div>
        </div><!-- /.col -->




        <div class="col-md-3">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Top Departure - Track</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped" style="font-size: smaller">
                        <tbody>
                        <tr>
                            <th style="width: 10px">Total</th>

                            <th>From Airport</th>
                        </tr>
                        @if (count($top_departure_dash)>0)
                            @foreach ($top_departure_dash as $td)
                                <tr>
                                    <td>{{$td->total}}</td>

                                    <td>{{$td->city}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody></table>
                </div><!-- /.box-body -->
            </div>
        </div><!-- /.col -->

        <div class="col-md-3">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Top Arrival - Tracking</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped" style="font-size:smaller">
                        <tbody>
                        <tr>
                            <th style="width: 10px">Total</th>

                            <th>To Airport</th>
                        </tr>
                        @if (count($top_arrival_dash)>0)
                            @foreach ($top_arrival_dash as $ta)
                                <tr>
                                    <td>{{$ta->total}}</td>

                                    <td>{{$ta->city}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody></table>
                </div><!-- /.box-body -->
            </div>
        </div><!-- /.col -->


        <div class="col-md-2">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Top Airlines</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped" style="font-size: x-small">
                        <tbody>
                        <tr>
                            <th style="width: 10px">Total</th>
                            <th>Airline</th>
                        </tr>
                        @if (count($top_airlines_dash)>0)
                            @foreach ($top_airlines_dash as $topairlines)
                                <tr>
                                    <td>{{$topairlines->total}}</td>
                                    <td>{{$topairlines->name_airline."-".$topairlines->code_airline}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody></table>
                </div><!-- /.box-body -->
            </div>

        </div><!-- /.col -->

    </div><!-- /.row (main row) -->



    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Flights with Status Scheduled - Tracking </h3>
                </div><!-- /.box-header -->
                <div class="box-body"  id="table_filtered_content">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Code</th>
                            <th style="width: 200px;">Client</th>
                            <th>Flight</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Status</th>
                            <th style="width: 200px;">Departure Date</th>
                            <th style="width: 200px;">Arrival Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0;  ?>
                        @foreach ($total_track_scheduled as $content)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $content->card_number }}</td>
                                <td>{{ $content->name." ". $content->surname }}</td>
                                <td>{{ $content->company." ".$content->number }}</td>
                                <td>{{ $content->fromAirport }}</td>
                                <td>{{ $content->toAirport }}</td>
                                <td>{{ $status_flight[$content->status] }}</td>
                                <td>{{ $content->departureDayLocal }}</td>
                                <td>{{ $content->arrivalDayLocal }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.row (box) -->
        </div><!-- /.row (col) -->
    </div><!-- /.row (main row) -->

    <script type="text/javascript">
        $(function () {
            $("#example1").dataTable();
        });
    </script>
@endsection