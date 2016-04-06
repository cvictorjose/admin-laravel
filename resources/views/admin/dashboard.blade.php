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
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">PromoCode</span>
                    <span class="info-box-number">90<small>%</small></span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Likes</span>
                    <span class="info-box-number">41,410</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">760</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">New Members</span>
                    <span class="info-box-number">2,000</span>
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
                            <h3 class="box-title">Top Last Activities Users</h3>
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
                <a href="{{ URL::to('admin/airportslist') }}" class="uppercase">View All Airports</a>
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




