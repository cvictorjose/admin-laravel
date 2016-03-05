@extends('admin.app')
<?php foreach($data as $k=>$v) $$k=$v; ?>
@section('header')
    <h1>
        @if($mode == 'edit')
            Airline Edit
        @else
            Airline Add
        @endif
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Home</a></li>
        <li>Airlines </li>
        <li><a href="{{ URL::to('admin/airlineslist') }}">Airlines List</a></li>
        @if($mode == 'edit')
            <li class="active">Airline Edit</li>
        @else
            <li class="active">Airline Add</li>
        @endif
    </ol>
@endsection
<?php if((isset($alDetails) && count($alDetails)>0 && isset($alDetails->idairline) && $alDetails->idairline>0) || $mode == 'add')  {   ?>
@section('content')
    <script type="text/javascript" src="{{ asset('/js/adminairlines.js') }}" ></script>
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    @if($mode == 'edit')
                        <h3 class="box-title">Edit Airline</h3>
                    @else
                        <h3 class="box-title">Add New Airline</h3>
                    @endif
                </div><!-- /.box-header -->
                <!-- form start -->
                @if($mode == 'edit')
                    <form role="form" method="post" name="editairlinefrm" id="editairlinefrm">
                @else
                    <form method="post" name="addairlinefrm" id="addairlinefrm">
                @endif
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    @if($mode == 'edit')
                        <input type="hidden" name="url" id="url" value="{{ URL::to('admin/editairline') }}/{{ $alDetails->idairline }}">
                        <input type="hidden" name="al_id" id="al_id" value="{{ $alDetails->idairline }}">
                    @endif
                    <div class="box-body">
                        <div class="form-group">
                            <label for="al_name">Name</label> <span class="mandatory">*</span>
                            <input type="text" class="form-control" id="al_name" name="al_name" placeholder="Enter Name" required="required" @if($mode == 'edit') value="{{ $alDetails->name_airline }}" @endif />
                        </div>
                        <div class="form-group">
                            <label for="ap_city">Code</label> <span class="mandatory">*</span>
                            <input type="text" class="form-control" id="al_code" name="al_code" placeholder="Enter Code" required="required" @if($mode == 'edit') value="{{ $alDetails->code_airline }}" @endif />
                        </div>
                        <div class="form-group">
                            <label for="ap_rank">Country</label> <span class="mandatory">*</span>
                            <select name="al_country" id="al_country" class="form-control" required="required">
                                <option value="">Select Country</option>
                                @if(count($countriesList)>0)
                                    @foreach($countriesList as $country)
                                        <option value="{{ $country->country_name }}" @if($mode == 'edit') @if($country->country_name ==  $alDetails->country_airline ) selected="selected" @endif @endif>{{ $country->country_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="checkbox">
                            <label for="al_status">
                                <input type="checkbox" id="al_status" name="al_status" value="1"  @if($mode == 'edit')  @if($alDetails->stato == "1") checked="checked" @endif  @endif /> Status
                            </label>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" id="addairline" name="addairline" value="Submit">
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
                    <h3 class="box-title">Edit Airline</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    Invalid Airline to Edit
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <a href="{{ URL::to('admin/airlineslist') }}" class="btn btn-app">
                        <i class="fa fa-users"></i> Back to Airlines List
                    </a>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row (main row) -->
@endsection
<?php } ?>