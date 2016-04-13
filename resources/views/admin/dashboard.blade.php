<?php foreach($data as $k=>$v) $$k=$v;  $status_flight    =  config('constants.fStatus');?>
@extends('admin.app')
@section('header')
    <h1>
        Tracking List
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-files-o"></i> Home</a></li>
        <li class="active">Tracking </li>
        <li class="active">Tracking List</li>
    </ol>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-gift"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">PromoCode</span>
                    <strong>Registered:</strong>
                    @if (count($totalpromocode_registered)>0)
                        @foreach ($totalpromocode_registered as $clientsb1)
                            {{$clientsb1->totalclient}} Codes
                        @endforeach
                    @endif

                    <br>
                    <strong>Tracking:</strong>
                    @if (count($totalpromocode_tracking)>0)
                        @foreach ($totalpromocode_tracking as $clientsb2)
                            {{$clientsb2->totaltracking}} Flights
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
                        @if (count($total_transactions)>0)
                            @foreach ($total_transactions as $clientsb3)
                                {{$clientsb3->totaltrans}} Payments
                            @endforeach
                        @endif
                    </span>
                    <span>
                      345 Payments
                  </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Registration</span>
                    <span class="info-box-number">
                        @if (count($totalclientsb)>0)    <?php $i = 0; ?>
                        @foreach ($totalclientsb as $clientsb)  <?php $i++; ?>
                        {{$clientsb->total}} new users
                        @endforeach
                        @endif
                   </span>
                  <span>
                      345 users
                  </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
    </div><!-- /.row -->



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

    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Status Flight - Tracking</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tbody><tr>
                            <th style="width: 10px">03/02</th>
                            <th>Device</th>
                            <th>Entrance</th>
                            <th style="width: 40px">Label</th>
                        </tr>
                        <tr>
                            <td>120/123</td>
                            <td>IOS</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 15%"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-red">15%</span></td>
                        </tr>

                        </tbody></table>
                </div><!-- /.box-body -->
            </div>
        </div><!-- /.col -->

        <div class="col-md-3">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Top Departure - Tracking</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th style="width: 10px">Total</th>
                            <th>Code</th>
                            <th>Airline</th>
                        </tr>
                        @if (count($top_airlines_dash)>0)
                            @foreach ($top_airlines_dash as $topairlines)
                                <tr>
                                    <td>{{$topairlines->total}}</td>
                                    <td>{{$topairlines->code_airline}}</td>
                                    <td>{{$topairlines->name_airline}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody></table>
                </div><!-- /.box-body -->
            </div>
        </div><!-- /.col -->
    </div><!-- /.row (main row) -->

    <script type="text/javascript">
        $(function () {
            $("#example1").dataTable();
        });
    </script>
@endsection