@extends('admin.app')
@section('header')
    <h1>
        Airlines List
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Home</a></li>
        <li class="active">Airlines </li>
        <li class="active">Airlines List</li>
    </ol>
@endsection
<?php foreach($data as $k=>$v) $$k=$v; ?>
@section('content')
    <script type="text/javascript" src="{{ asset('js/adminairlines.js') }}" ></script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Airlines</h3>
                    <a href="{{ URL::to('admin/airlineadd') }}" class="btn btn-app" style="float: right;">
                        <i class="fa fa-plane"></i> Add new Airline
                    </a>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @foreach ($airlinesList as $airlines)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $airlines->name_airline }}</td>
                            <td>{{ $airlines->code_airline }}</td>
                            <td>{{ $airlines->country_airline }}</td>
                            <td>@if ($airlines->stato == 1)  <i class="fa fa-check-circle" onclick="changeairlinestatus({{ $airlines->idairline }}, this);" style="cursor:pointer;"></i>  @else  <i class="fa fa-circle-o" onclick="changeairlinestatus({{ $airlines->idairline }}, this);" style="cursor:pointer;"></i>  @endif </td>
                            <td><a href="{{ URL::to('admin/editairline') }}/{{ $airlines->idairline }}"><i class="fa fa-edit"></i></a> &nbsp; <!--a href=""><i class="fa fa-trash-o"></i></a--></td>
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