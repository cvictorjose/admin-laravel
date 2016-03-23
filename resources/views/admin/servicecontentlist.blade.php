<?php foreach($data as $k=>$v) $$k=$v; $scLanguages    =  config('constants.scLanguages'); ?>
@extends('admin.app')
@section('header')
    <h1>
        Service Contents List
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Home</a></li>
        <li class="active">Service Contents </li>
        <li class="active">Service Contents List</li>
    </ol>
@endsection
@section('content')
    <script type="text/javascript" src="{{ asset('/js/servicecontent.js') }}" ></script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Service Contents</h3>
                    <a href="{{ URL::to('admin/servicecontentadd') }}" class="btn btn-app" style="float: right;">
                        <i class="fa fa-newspaper-o"></i> Add Service Content
                    </a>
                    <div class="input-group input-group-sm">
                        <select name="sc_lang" id="sclang" style="float: right;width: 150px;" class="form-control">
                            @foreach($scLanguages as $k=>$sclang)
                                <option value="{{ $k }}" >{{ $sclang }}</option>
                            @endforeach
                        </select><span class="input-group-btn">
                      <button class="btn btn-info btn-flat" name="filter_btn" id="filter_btn" type="button" onclick="filtercontent();">Go!</button>
                    </span>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body"  id="table_filtered_content">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0;  if(empty($filter_lang))
                        $filter_lang    = "it";?>
                    @foreach ($scList as $content)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td><?php $varname   = "cont_title_".$filter_lang;  ?> {{ $content->$varname }}</td>
                            <td><a class="morecontent" onclick="openpopup({{ $content->id }}, '{{ $filter_lang }}');"
                                   style="cursor: pointer;">...read...</a>
                                <!-- tooltip element -->
                                <div class="contenttooltip{{ $content->id }}{{ $filter_lang }}" style="display: none;">
                                    <?php $varname   = "contents_".$filter_lang; echo html_entity_decode(mb_convert_encoding($content->$varname, 'HTML-ENTITIES', 'UTF-8'));  ?>
                                </div>
                            </td>
                           <td><a href="{{ URL::to('admin/editservicecontent') }}/{{ $content->id }}"><i class="fa fa-edit"></i></a> &nbsp; <!--a href=""><i class="fa fa-trash-o"></i></a--></td>

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


        function openpopup(cid, lang){
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
        function openintro(cid, lang){
            $('.introtooltip'+cid+lang).css("width", "600px");
            $('.introtooltip'+cid+lang).css("height", "500px");
            $('.introtooltip'+cid+lang).css("background-color", "#fff");
            $('.introtooltip'+cid+lang).css("border", "1px solid black");
            $('.introtooltip'+cid+lang).css("overflow", "auto");
            $('.introtooltip'+cid+lang).css("padding", "10px");
            $('.introtooltip'+cid+lang).bPopup({
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