<?php foreach($data as $k=>$v) $$k=$v;  ?>
@extends('admin.app')
@section('header')
    <h1>
        Promocode List
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-files-o"></i> Home</a></li>
        <li class="active">Promocode </li>
        <li class="active">Promocode List</li>
    </ol>
@endsection
@section('content')
   

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Promocode</h3>


                </div><!-- /.box-header -->
                <div class="box-body"  id="table_filtered_content">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Promocode</th>
                        <th style="width: 200px;">Client</th>
                        <th>Email</th>
                        <th>Platform</th>
                        <th>Mobile</th>
                        <th>Country</th>
                        <th>Credits</th>
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
                            <td>{{ $content->promocode }}</td>
                            <td>{{ $content->name." ". $content->surname }}</td>
                            <td>{{ $content->email }}</td>
                            <td>{{ $content->os }}</td>
                            <td>{{ $content->mobile }}</td>
                            <td>{{ $content->nationality }}</td>

                            <td>{{  $content->credits }}</td>
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