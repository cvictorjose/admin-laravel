@extends('admin.app')
@section('header')
    <h1>
        Users List
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Home</a></li>
        <li class="active">Users </li>
        <li class="active">Users List</li>
    </ol>
@endsection
<?php foreach($data as $k=>$v) $$k=$v; $userDesignations    =  config('constants.userDesignations');   ?>
@section('content')
    <script type="text/javascript" src="{{ asset('/js/adminuser.js') }}" ></script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Admin Users</h3>
                    <a href="{{ URL::to('admin/useradd') }}" class="btn btn-app" style="float: right;">
                        <i class="fa fa-user-plus"></i> Add new Admin user
                    </a>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>User Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @foreach ($usersList as $user)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td align="center">
                                @if($user->profile_picture != '') <img src="{{ asset('/adminpictures') }}/{{ $user->profile_picture }}" height="30" width="30" class="img-circle"></td>
                            @else   <img src="{{ asset('/images/profile_foto.png') }}" height="30" width="30" class="img-circle">         @endif
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->f_name }}</td>
                            <td>{{ $user->l_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $userDesignations[$user->designation] }}</td>
                            <td>@if ($user->status == 1)  <i class="fa fa-check-circle" onclick="changestatus({{ $user->id }}, this);" style="cursor:pointer;"></i>  @else  <i class="fa fa-circle-o" onclick="changestatus({{ $user->id }}, this);" style="cursor:pointer;"></i>  @endif </td>
                            <td><a href="{{ URL::to('admin/edituser') }}/{{ $user->id }}"><i class="fa fa-edit" style="cursor:pointer;"></i></a> &nbsp; <!--a href=""><i class="fa fa-trash-o"></i></a--></td>

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