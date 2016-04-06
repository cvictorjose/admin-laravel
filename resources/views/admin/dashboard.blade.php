@extends('admin.app')
@section('header')
<h1>Dashboard <small>Safe Bag Admin</small></h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol>
@endsection
<?php foreach($data as $k=>$v) $$k=$v; ?>
@section('content')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-plane"></i></span>
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
                <div class="info-box-content">Tracking</span>

                    <span class="info-box-number">
                        @if (count($total_Track)>0)
                            @foreach ($total_Track as $clientsb4)
                            {{$clientsb4->totaltracks}} Flights
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
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Trasactions</span>
                    <span class="info-box-number">

                        @if (count($total_transactions)>0)
                            @foreach ($total_transactions as $clientsb3)
                                {{$clientsb3->totaltrans}} Payments
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
                    <span class="info-box-text">
                        Clients:
                        @if (count($totalclientsb)>0)    <?php $i = 0; ?>
                            @foreach ($totalclientsb as $clientsb)  <?php $i++; ?>
                                {{$clientsb->total}}
                            @endforeach
                        @endif
                      </span>
                         @if (count($totalclient)>0)    <?php $i = 0; ?>
                            @foreach ($totalclient as $client)  <?php $i++; ?>
                            - <strong>{{ strtoupper($client->nationality)}} </strong> {{$client->nat}}
                            @endforeach
                        @endif
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-5">
            <!-- MAP & BOX PANE -->
            <div class="row">
                <div class="col-md-12">
                    <!-- TOP LAST ACTIVITIES USERS LIST -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Top Last Activities Users SafeBag</h3>
                            <div class="box-tools pull-right">
                                <!--span class="label label-danger">8 New Members</span-->
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <!--button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button-->
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <ul class="users-list clearfix">
                                @if (count($topUsersList)>0)
                                @foreach ($topUsersList as $user)
                                    <li>
                                        @if($user->profile_picture != '')
                                            <img src="{{ asset('/adminpictures') }}/{{ $user->profile_picture }}" alt="User Image" style="height:100px;"/>
                                        @else
                                            <img src="{{ asset('public/images/blank-male.jpg') }}" alt="User Image" style="height:100px;"/>
                                        @endif
                                        <a class="users-list-name" href="#">{{ $user->f_name }} &nbsp; {{ $user->l_name }}</a>
                                        <span class="users-list-date"><?php echo date("d,M. Y", strtotime($user->last_login)); ?></span>
                                    </li>
                                @endforeach
                                @endif
                            </ul><!-- /.users-list -->
                        </div><!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="{{ URL::to('admin/userlist') }}" class="uppercase">View All Users</a>
                        </div><!-- /.box-footer -->
                    </div><!--/.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            <!-- TABLE: LATEST ORDERS -->

        </div><!-- /.col -->

        <div class="col-md-3">

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Recently Added Airlines</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Country</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($lastAirlines)>0)    <?php $i = 0; ?>
                            @foreach ($lastAirlines as $airlines)  <?php $i++; ?>
                            <tr>
                                <td>{{ $airlines->name_airline }}</td>
                                <td>{{ $airlines->country_airline }}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div><!-- /.table-responsive -->
            </div><!-- /.box-body -->
            <div class="box-footer text-center">
                <a href="{{ URL::to('admin/airlineslist') }}" class="uppercase">View All Airlines</a>
            </div><!-- /.box-footer -->
        </div><!-- /.box -->
        </div>

        <div class="col-md-4">
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Recently Added Airports</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <!--button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button-->
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>Iata</th>
                                <th>Airport
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($lastAirports)>0)    <?php $i = 0; ?>
                            @foreach ($lastAirports as $ports)  <?php $i++; ?>
                            <tr>
                                <td>{{ $ports->iata }}</td>
                                <td>{{ $ports->city }}</td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="{{ URL::to('admin/airportslist') }}" class="uppercase">View All Airports</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div><!-- /.col -->



    </div><!-- /.row -->
@endsection




