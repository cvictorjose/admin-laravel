@extends('admin.app')
<?php foreach($data as $k=>$v) $$k=$v; $userDesignations    =  config('constants.userDesignations');    ?>
@section('header')
    <h1>
        @if($mode == 'edit')
            User Edit
        @else
            User Add
        @endif
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Home</a></li>
        <li>Users </li>
        <li><a href="{{ URL::to('admin/userlist') }}">Users List</a></li>
        @if($mode == 'edit')
            <li class="active">User Edit</li>
        @else
            <li class="active">User Add</li>
        @endif
    </ol>
@endsection
<?php if((isset($userDetails) && count($userDetails)>0 && isset($userDetails->id) && $userDetails->id>0) || $mode == 'add')  {   ?>
@section('content')
    <script type="text/javascript" src="{{ asset('/js/adminuser.js') }}" ></script>
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    @if($mode == 'edit')
                        <h3 class="box-title">Edit Admin User</h3>
                    @else
                        <h3 class="box-title">Add New Admin User</h3>
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
                    <form role="form" method="post" name="edituserfrm" id="edituserfrm" enctype="multipart/form-data">
                @else
                    <form role="form" method="post" name="adduserfrm" id="adduserfrm"  enctype="multipart/form-data">
                @endif

                    @if($mode == 'edit')
                        <input type="hidden" name="url" id="url" value="{{ URL::to('admin/edituser') }}/{{ $userDetails->id }}">
                    @endif
                    <input type="hidden" name="ad_userid" id="ad_userid" @if($mode == 'edit') value="{{ $userDetails->id }}" @else value="0" @endif>
                    <input type="hidden" name="chkurl" id="chkurl" value="{{ URL::to('admin/useremailcheck') }}" />
                    <input type="hidden" name="chkemail" id="chkemail" @if($mode == 'edit')  value="1" @else value="0" @endif>
                    <div class="box-body">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Username" id="ad_username" name="ad_username" @if($mode == 'edit') value="{{ $userDetails->username }}" @endif >
                        </div><br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Firstname" id="ad_firstname" name="ad_firstname" @if($mode == 'edit') value="{{ $userDetails->f_name }}" @endif >
                        </div><br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Lastname" id="ad_lastname" name="ad_lastname" @if($mode == 'edit') value="{{ $userDetails->l_name }}" @endif >
                        </div><br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" class="form-control" placeholder="Email" id="ad_email" name="ad_email" onblur="chkemailexists();" @if($mode == 'edit') value="{{ $userDetails->email }}" @endif >
                            <span id="errormail"></span>
                        </div><br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Password" id="ad_pwd" name="ad_pwd">
                        </div><br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" placeholder="Confirm Password" id="ad_cpwd" name="ad_cpwd">
                        </div><br/>
                        <div class="form-group">
                            <select class="form-control"  id="ad_designation" name="ad_designation">
                                <option value="">Select Designation</option>
                                @if($userDesignations && count($userDesignations)>0)
                                    @foreach($userDesignations as $k=>$udesig)
                                        <option value="{{ $k }}" @if($mode == 'edit') @if($k ==  $userDetails->designation ) selected="selected" @endif @endif  >{{ $udesig }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control"  id="ad_access_level" name="ad_access_level">
                                <option value="">Select Access Level</option>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}"  @if($mode == 'edit') @if($i == $userDetails->access_id ) selected="selected" @endif @endif >{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="file" id="ad_profileimg" name="ad_profileimg"><p class="help-block">Profile Picture
                                @if($mode == 'edit')
                                    @if($userDetails->profile_picture != '')
                                        <img src="{{ asset('/adminpictures') }}/{{ $userDetails->profile_picture }}" height="30" width="30"></p>
                                    @else
                                        <img src="{{ asset('/images/profile_foto.png') }}" height="30" width="30"></p>
                                    @endif
                                @else
                                    <img src="{{ asset('/images/profile_foto.png') }}" height="30" width="30"></p>
                                @endif
                        </div>
                        <div class="checkbox">
                            <label for="ap_status">
                                <input type="checkbox" id="ad_status" name="ad_status" value="1" @if($mode == 'edit')  @if($userDetails->status == "1") checked="checked" @endif  @endif> Status
                            </label>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="adduser" id="adduser" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                <h3 class="box-title">Edit Admin User</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                Invalid User to Edit
            </div><!-- /.box-body -->

            <div class="box-footer">
                <a href="{{ URL::to('admin/userlist') }}" class="btn btn-app">
                    <i class="fa fa-users"></i> Back to Users List
                </a>
            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row (main row) -->
@endsection
<?php } ?>
