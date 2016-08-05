@extends('admin.app')
<?php foreach($data as $k=>$v) $$k=$v; ?>
@section('header')
    <h1>
        @if($mode == 'edit')
            Partner Edit
        @else
            Partner Add
        @endif
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-files-o"></i> Home</a></li>
        <li>Partners </li>
        <li><a href="{{ URL::to('admin/partnerslist') }}">Partners List</a></li>
        @if($mode == 'edit')
            <li class="active">Partner Edit</li>
        @else
            <li class="active">Partner Add</li>
        @endif
    </ol>
@endsection
<?php if((isset($portDetails) && count($portDetails)>0 && isset($portDetails->id) && $portDetails->id>0) || $mode == 'add')  {   ?>
@section('content')
    <script type="text/javascript" src="{{ asset('/js/adminpartners.js') }}" ></script>
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    @if($mode == 'edit')
                        <h3 class="box-title">Edit Partner</h3>
                    @else
                        <h3 class="box-title">Add New Partner</h3>
                    @endif
                </div><!-- /.box-header -->
                <!-- form start -->
                @if($mode == 'edit')
                    <form role="form" method="post" name="editpartnerfrm" id="editpartnerfrm">
                        @else
                            <form method="post" name="addpartnerfrm" id="addpartnerfrm">
                                @endif
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                <input type="hidden" name="chkurl" id="chkurl" value="{{ URL::to('admin/partnercodecheck') }}">
                                <input type="hidden" name="chkiata" id="chkiata" value="0">

                                @if($mode == 'edit')
                                    <input type="hidden" name="url" id="url" value="{{ URL::to('admin/editpartner') }}/{{ $portDetails->id }}">
                                    <input type="hidden" name="ap_id" id="ap_id" value="{{ $portDetails->id }}">
                                @endif
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="ap_partner">Partner</label> <span class="mandatory">*</span>
                                        <input type="text" class="form-control" id="ap_partner" name="ap_partner" placeholder="Enter Partner" required="required" @if($mode == 'edit') value="{{ $portDetails->name }}" @endif >

                                    </div>
                                    <div class="form-group">
                                        <label for="ap_code">Partner Code</label> <span class="mandatory">*</span>
                                        <input type="text" class="form-control" id="ap_code" name="ap_code"
                                               placeholder="Enter Code" required="required" @if($mode == 'edit')
                                               value="<?php echo ($portDetails->code); ?>" @endif
                                               onblur="checkcodeexists();">
                                        <span id="erroriata"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="ap_commission">Commission</label> <span class="mandatory">*</span>
                                        <input type="text" class="form-control" id="ap_commission" name="ap_commission"
                                               placeholder="Enter Commission" required="required" @if($mode == 'edit')
                                               value="<?php echo ($portDetails->commission); ?>"
                                                @endif>
                                    </div>

                                    <div class="checkbox">
                                        <label for="ap_status">
                                            <input type="checkbox" id="ap_status" name="ap_status" value="1" @if($mode == 'edit')  @if($portDetails->status == "1") checked="checked" @endif  @endif> Status
                                        </label>
                                    </div>
                                </div><!-- /.box-body -->

                                <div class="box-footer">
                                    <input type="submit" class="btn btn-primary" id="addpartner" name="addpartner" value="Submit">
                                    <input type="reset" class="btn btn-primary" value="Reset">
                                </div>
                            </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row (main row) -->
@endsection
<?php }   else {    ?>
@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Partner</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    Invalid Partner to Edit
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <a href="{{ URL::to('admin/partnreslist') }}" class="btn btn-app">
                        <i class="fa fa-users"></i> Back to Partners List
                    </a>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row (main row) -->
@endsection
<?php } ?>