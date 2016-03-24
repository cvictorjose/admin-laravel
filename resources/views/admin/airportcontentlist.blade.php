<?php foreach($data as $k=>$v) $$k=$v; $acLanguages    =  config('constants.scLanguages'); ?>
@extends('admin.app')
@section('header')
    <h1>
        Airport Contents List
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Home</a></li>
        <li class="active">Airport Contents </li>
        <li class="active">Airport Contents List</li>
    </ol>
@endsection
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Airport Contents</h3>
                    <a href="{{ URL::to('admin/airportcontentadd') }}" class="btn btn-app" style="float: right;">
                        <i class="fa fa-newspaper-o"></i> Add Airport Content
                    </a>

                </div><!-- /.box-header -->
                <div class="box-body"  id="table_filtered_content">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Image</th>
                        <th>Airport Name</th>
                        <th>Name</th>
                        <th>Terminal</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th style="width: 100px;">Open Timings</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0;  if(empty($filter_lang))
                        $filter_lang    = "en";?>
                    @foreach ($acList as $content)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td align="center">
                                @if($content->image != '') <img src="http://www.safe-bag.com/safebag-airports/images/points/{{ $content->image }}" height="100" width="100" class="img-circle"></td>
                            @else   <img src="{{ asset('/public/images/content.gif') }}" height="30" width="30" class="img-circle">         @endif
                            <td>{{ $content->id_airport  }}</td>
                            <td>{{ $content->name_airport  }}</td>
                            <td><?php $varname   = "testo_intro_".$filter_lang; echo $content->$varname; ?></td>
                            <td><?php $varname   = "descrizione_".$filter_lang; echo html_entity_decode(mb_convert_encoding($content->$varname, 'HTML-ENTITIES', 'UTF-8')); ?></td>


                            <td>@if ($content->status == '1')  <i class="fa fa-check-circle" onclick="changeacontentstatus({{ $content->id_postazione }}, this);" style="cursor:pointer;"></i>  @else  <i class="fa fa-circle-o" onclick="changescontentstatus({{ $content->id_postazione }}, this);" style="cursor:pointer;"></i>  @endif </td>
                            <td><a href="{{ URL::to('admin/editairportcontent') }}/{{ $content->id_postazione }}"><i class="fa fa-edit"></i></a> &nbsp; <!--a href=""><i class="fa fa-trash-o"></i></a--></td>
                            <td>Mon: {{ $content->lun }} <br />Tue: {{ $content->mar }} <br />Wed: {{ $content->mer }} <br />Thu: {{ $content->gio }} <br />Fri: {{ $content->ven }} <br />Sat: {{ $content->sab }} <br />Sun: {{ $content->dom }}<br /></td>
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
        function opentimings(cid, lang){
            $('.contenttooltip'+cid+lang).css("width", "600px");
            $('.contenttooltip'+cid+lang).css("height", "500px");
            $('.contenttooltip'+cid+lang).css("background-color", "#fff");
            $('.contenttooltip'+cid+lang).css("border", "1px solid black");
            $('.contenttooltip'+cid+lang).css("overflow", "auto");
            $('.contenttooltip'+cid+lang).css("padding", "10px");
            $('.contenttooltip'+cid+lang).bPopup({
                follow: [false, false], //x, y
                position: [150, 100], //x, y
                speed: 150,
                transition: "slideIn",
                modalColor: "#DDDDDD",
                amsl:0,
            });
        }
    </script>

@endsection