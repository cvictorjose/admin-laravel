@extends('admin.app')
@section('header')
    <h1>
        Airports List
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Home</a></li>
        <li class="active">Airports </li>
        <li class="active">Airports List</li>
    </ol>
@endsection
<?php foreach($data as $k=>$v) $$k=$v; ?>
@section('content')
    <script type="text/javascript" src="{{ asset('/js/airports.js') }}" ></script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Airports</h3>
                    <a href="{{ URL::to('admin/airportadd') }}" class="btn btn-app" style="float: right;">
                        <i class="fa fa-rocket"></i> Add new Airport
                    </a>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Iata</th>
                        <th>City</th>
                        <th>Smart rank</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @foreach ($airportsList as $ports)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $ports->iata }}</td>
                            <td>{{ $ports->city }}</td>
                            <td>{{ $ports->smart_rank }}</td>
                            <td>@if ($ports->stato == 1)  <i class="fa fa-check-circle" onclick="changeairportstatus({{ $ports->id }}, this);" style="cursor:pointer;"></i>  @else  <i class="fa fa-circle-o" onclick="changeairportstatus({{ $ports->id }}, this);" style="cursor:pointer;"></i>  @endif </td>
                            <td><a href="{{ URL::to('admin/editairport') }}/{{ $ports->id }}"><i class="fa fa-edit"></i></a> &nbsp; <!--a href=""><i class="fa fa-trash-o"></i></a--></td>
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