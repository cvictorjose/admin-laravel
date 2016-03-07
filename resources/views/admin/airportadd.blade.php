@extends('admin.app')
<?php foreach($data as $k=>$v) $$k=$v; ?>
@section('header')
    <h1>
        @if($mode == 'edit')
            Airport Edit
        @else
            Airport Add
        @endif
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Home</a></li>
        <li>Airports </li>
        <li><a href="{{ URL::to('admin/airportslist') }}">Airports List</a></li>
        @if($mode == 'edit')
            <li class="active">Airport Edit</li>
        @else
            <li class="active">Airport Add</li>
        @endif
    </ol>
@endsection
<?php if((isset($portDetails) && count($portDetails)>0 && isset($portDetails->id) && $portDetails->id>0) || $mode == 'add')  {   ?>
@section('content')
    <script type="text/javascript" src="{{ asset('/js/airports.js') }}" ></script>
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    @if($mode == 'edit')
                        <h3 class="box-title">Edit Airport</h3>
                    @else
                        <h3 class="box-title">Add New Airport</h3>
                    @endif
                </div><!-- /.box-header -->
                <!-- form start -->
                @if($mode == 'edit')
                    <form role="form" method="post" name="editairportfrm" id="editairportfrm">
                @else
                    <form method="post" name="addairportfrm" id="addairportfrm">
                @endif
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    <input type="hidden" name="chkurl" id="chkurl" value="{{ URL::to('admin/airportiatacheck') }}">
                    <input type="hidden" name="chkiata" id="chkiata" value="0">
                    @if($mode == 'edit')
                        <input type="hidden" name="url" id="url" value="{{ URL::to('admin/editairport') }}/{{ $portDetails->id }}">
                        <input type="hidden" name="ap_id" id="ap_id" value="{{ $portDetails->id }}">
                    @endif
                    <div class="box-body">
                        <div class="form-group">
                            <label for="ap_iata">Iata</label> <span class="mandatory">*</span>
                            <input type="text" class="form-control" id="ap_iata" name="ap_iata" placeholder="Enter Iata" required="required" @if($mode == 'edit') value="{{ $portDetails->iata }}" @endif onblur="checkiataexists();">
                            <span id="erroriata"></span>
                        </div>
                        <div class="form-group">
                            <label for="ap_city">City</label> <span class="mandatory">*</span>
                            <input type="text" class="form-control" id="ap_city" name="ap_city" placeholder="City" required="required" @if($mode == 'edit') value="<?php echo strstr($portDetails->city, '-', true); ?>" @endif>
                        </div>
                        <div class="form-group">
                            <label for="ap_rank">Smart Rank</label> <span class="mandatory">*</span>
                            <select class="form-control"  id="ap_rank" name="ap_rank">
                                <option value="">Select Smart Rank</option>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" @if($mode == 'edit') @if($i ==  $portDetails->smart_rank ) selected="selected" @endif @endif  >{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="checkbox">
                            <label for="ap_status">
                                <input type="checkbox" id="ap_status" name="ap_status" value="1" @if($mode == 'edit')  @if($portDetails->stato == "1") checked="checked" @endif  @endif> Status
                            </label>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" id="addairport" name="addairport" value="Submit">
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
                    <h3 class="box-title">Edit Airport</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    Invalid Airport to Edit
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <a href="{{ URL::to('admin/airportslist') }}" class="btn btn-app">
                        <i class="fa fa-users"></i> Back to Airports List
                    </a>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row (main row) -->
@endsection
<?php } ?>