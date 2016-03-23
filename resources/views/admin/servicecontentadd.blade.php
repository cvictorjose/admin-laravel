@extends('admin.app')
<?php foreach($data as $k=>$v) $$k=$v; $scLanguages    =  config('constants.scLanguages');   ?>
@section('header')
    <h1>
        Service Content Add
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Home</a></li>
        <li>News </li>
        <li><a href="{{ URL::to('admin/servicecontentlist') }}">Service Content List</a></li>
        @if($mode == 'edit')
            <li class="active">Service Content Edit</li>
        @else
            <li class="active">Service Content Add</li>
        @endif
    </ol>
@endsection
<?php if((isset($scDetails) && count($scDetails)>0 && isset($scDetails->id) && $scDetails->id>0) || $mode == 'add')  {   ?>
@section('content')
    <script type="text/javascript" src="{{ asset('/js/servicecontent.js') }}" ></script>
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    @if($mode == 'edit')
                        <h3 class="box-title">Edit Service Content</h3>
                    @else
                        <h3 class="box-title">Add Service Content</h3>
                    @endif
                </div><!-- /.box-header -->
                <?php if(Session::has('status') && Session::get('status') == 'ok')   {   ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Success!</h4>  <?php echo Session::get('statmsg'); ?>  </div>
                <?php } else  if(Session::has('status') && Session::get('status') == 'error')   {  ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-ban"></i> Failed!</h4> <?php echo Session::get('statmsg'); ?>  </div>
                <?php } ?>
                <!-- form start -->
                @if($mode == 'edit')
                    <form role="form" method="post" name="editscontentfrm" id="editscontentfrm" enctype="multipart/form-data">
                @else
                    <form method="post" name="addscontentfrm" id="addscontentfrm" enctype="multipart/form-data">
                @endif
                @if($mode == 'edit')
                    <input type="hidden" name="url" id="url" value="{{ URL::to('admin/editservicecontent') }}/{{ $scDetails->id }}">
                    <input type="hidden" name="ad_scid" id="ad_scid" value="{{ $scDetails->id }}">
                @else
                    <input type="hidden" name="url" id="url" value="{{ URL::to('admin/servicecontentadd') }}">
                @endif
                    <input type="hidden" name="chkurl" id="chkurl" value="{{ URL::to('admin/servicecontenttitlecheck') }}" />
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    <input type="hidden" name="chktitle" id="chktitle" @if($mode == 'edit') value="1" @else value="1"
                        @endif">
                    <div class="box-body">

                        <div class="div-group">

                            <ul id="tabs">
                                @foreach($scLanguages as $k=>$sclang)
                                    <li><a href="#{{ $k }}">{{ $sclang }}</a></li>
                                @endforeach
                            </ul>
                            @foreach($scLanguages as $k=>$sclang)
                                <div id="{{ $k }}" class="tab-section">
                                    <div class="form-group">
                                        <label for="sc_title">Title - {{ $sclang }}</label> <span class="mandatory">*</span><?php $varname = "cont_title_".$k; ?>
                                        <input type="text" class="form-control" id="sc_title_{{ $k }}"
                                               name="sc_title[{{ $k }}]" @if($mode == 'edit') value="{{
                                               $scDetails->$varname }}" @endif   placeholder="Enter Title in {{
                                               $sclang }}" @if($k=='en') required="required" @endif ">
                                        <span id="errortitle"></span>
                                    </div>

                                    <div class="form-group"><?php $varname = "contents_".$k; ?>
                                        <label for="sc_content{{ $k }}">Content - {{ $sclang }}</label> <span class="mandatory">*</span>
                                    <textarea id="sc_content{{ $k }}" name="sc_content[{{ $k }}]" rows="10" cols="80">
                                      @if($mode == 'edit') {{ $scDetails->$varname }} @else Enter the Content in {{ $sclang }}  @endif
                                    </textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div><!-- /. class="div-group" -->

                        {{--<div class="form-group">
                            <label for="sc_url">Url</label>
                            <input type="text" class="form-control" id="sc_url" name="sc_url"  placeholder="Enter URL" @if($mode == 'edit') value="{{ $scDetails->url }}" @endif required="required">
                        </div>--}}

                        {{--<div class="form-group">
                            <label for="sc_image">Image</label>
                            <input type="file" id="sc_image" name="sc_image"  accept="image/*" >
                            @if($mode == 'edit')
                                @if($scDetails->image != '')
                                    <img src="{{ asset('/public/scontentpictures') }}/{{ $scDetails->image }}" height="30" width="30"></p>
                                @endif
                            @endif
                        </div>--}}

                        {{--<div class="checkbox">
                            <label for="sc_status">
                                <input type="checkbox" id="sc_status" name="sc_status" value="1" @if($mode == 'edit')  @if($scDetails->status == "Y") checked="checked" @endif  @endif> Status
                            </label>
                        </div>--}}
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" id="addsc" name="addsc" value="Submit">
                        <input type="reset" class="btn btn-primary" value="Reset">
                    </div>
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row (main row) -->
    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>

    <script type="text/javascript">
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            <?php foreach($scLanguages as $k=>$sclang)  {
                echo "CKEDITOR.replace('sc_content".$k."');";}?>
        });

        $(function(){
            $('.tab-section').hide();
            $('#tabs a').bind('click', function(e){
                $('#tabs a.current').removeClass('current');
                $('.tab-section:visible').hide();
                $(this.hash).show();
                $(this).addClass('current');
                e.preventDefault();
            }).filter(':first').click();
        });
    </script>
@endsection
<?php }   else {    ?>
@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Service Content</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    Invalid Service Content to Edit
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <a href="{{ URL::to('admin/servicecontentlist') }}" class="btn btn-app">
                        <i class="fa fa-users"></i> Back to Service Content List
                    </a>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row (main row) -->
@endsection
<?php } ?>