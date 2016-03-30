@extends('admin.app')
<?php foreach($data as $k=>$v) $$k=$v;  ?>
@section('header')
    <h1>
        @if($mode == 'edit')
            Terms & Conditions Edit
        @else
            Terms & Conditions Add
        @endif
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-files-o"></i> Home</a></li>
        <li><a href="{{ URL::to('admin/termslist') }}">Terms & Conditions List</a></li>
        @if($mode == 'edit')
            <li class="active">Terms & Conditions Edit</li>
        @else
            <li class="active">Terms & Conditions Add</li>
        @endif
    </ol>
@endsection
<?php if((isset($apDetails) && count($apDetails)>0 && isset($apDetails->term_id) && $apDetails->term_id>0) || $mode == 'add')  {   ?>
@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    @if($mode == 'edit')
                        <h3 class="box-title">Terms & Conditions Edit</h3>
                    @else
                        <h3 class="box-title">Add Terms & Conditions</h3>
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
                    <form role="form" method="post" name="editaproductfrm" id="editaproductfrm" enctype="multipart/form-data">
                        @else
                            <form method="post" name="addaproductfrm" id="addaproductfrm" enctype="multipart/form-data">
                                @endif
                                @if($mode == 'edit')
                                    <input type="hidden" name="url" id="url" value="{{ URL::to('admin/editterms') }}/{{ $apDetails->term_id }}">
                                    <input type="hidden" name="ad_apid" id="ad_apid" value="{{ $apDetails->term_id }}">
                                @else
                                    <input type="hidden" name="url" id="url" value="{{ URL::to('admin/termsadd') }}">
                                @endif
                                <input type="hidden" name="chkurl" id="chkurl" />
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                <div class="box-body">

                                    <div class="form-group col-md-12">
                                        <label for="ap_title">Title</label>
                                        <input type="text" class="form-control" id="ap_title" name="ap_title"  placeholder="Enter Title" @if($mode == 'edit') value="{{ $apDetails->title }}" @endif required="required">
                                    </div>

                                    <div class="div-group col-md-12">
                                        <div class="form-group">
                                            <label for="ap_web_desc">Web Description </label> <span class="mandatory">*</span>
                                            <textarea id="ap_web_desc" name="ap_web_desc" rows="10" cols="80">
                                              @if($mode == 'edit') {{ $apDetails->description }} @else Enter the Web Description  @endif
                                            </textarea>
                                        </div>
                                    </div><!-- /. class="div-group" -->
                                </div><!-- /.box-body -->

                                <div class="box-footer">
                                    <input type="submit" class="btn btn-primary" id="addac" name="addap" value="Submit">
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
            CKEDITOR.replace('ap_web_desc');
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
                    <h3 class="box-title">Edit Terms & Conditions</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    Invalid Terms & Conditions to Edit
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <a href="{{ URL::to('admin/termslist') }}" class="btn btn-app">
                        <i class="fa fa-users"></i> Back to Terms & Conditions List
                    </a>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row (main row) -->
@endsection
<?php } ?>