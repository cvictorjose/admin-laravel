<?php foreach($data as $k=>$v) $$k=$v;  ?>
@extends('admin.app')
@section('header')
    <h1>
        Transactions List
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-files-o"></i> Home</a></li>
        <li class="active">Transactions </li>
        <li class="active">Transactions List</li>
    </ol>
@endsection
@section('content')
   

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Transactions</h3>
                </div><!-- /.box-header -->
                <div class="box-body"  id="table_filtered_content">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>

                        <th style="width: 200px;">Client</th>
                        <th>Paypal ID</th>
                        <th>Price</th>
                        <th>Currency</th>
                        <th>Device</th>
                        <th>Num. Flights</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0;  if(empty($filter_lang))
                        $filter_lang    = "en";?>
                    @foreach ($acList as $content)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $content->name." ". $content->surname }}</td>
                            <td>{{ $content->paypal_id }}</td>
                            <td>{{ $content->price }}</td>
                            <td>{{ $content->currency }}</td>
                            <td>{{ $content->device }}</td>
                            <td>{{ $content->numflights }}</td>
                            <td>{{ $content->date }}</td>
                            <td>{{ $content->status }}</td>
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