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
        <li class="active"><a href="{{ URL::to('admin/trackinglist') }}">Tracking List</a></li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tracking</h3>
                    <a href="{{ URL::to('admin/download_all_track') }}" class="btn btn-app" style="float: right;">
                        <i class="fa fa-download"></i> All Tracking List
                    </a>
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
                        <th style="width: 200px;">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0;  if(empty($filter_lang))
                        $filter_lang    = "en";?>
                    @foreach ($acList as $content)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $content->card_number }}</td>
                            <td>{{ $content->name." ". $content->surname }}</td>
                            <td>{{ $content->company." ".$content->number }}</td>
                            <td>{{ $content->fromAirport }}</td>
                            <td>{{ $content->toAirport }}</td>
                            <td>{{ $status_flight[$content->status] }}</td>
                            <td>{{ $content->date }}</td>
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