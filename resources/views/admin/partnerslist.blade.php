@extends('admin.app')
@section('header')
    <h1>
        Partners List
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-files-o"></i> Home</a></li>
        <li class="active">Partners </li>
        <li class="active">Partners List</li>
    </ol>
@endsection
<?php foreach($data as $k=>$v) $$k=$v; ?>
@section('content')
    <script type="text/javascript" src="{{ asset('/js/adminpartners.js') }}" ></script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Partners</h3>
                    <a href="{{ URL::to('admin/partnersadd') }}" class="btn btn-app" style="float: right;">
                        <i class="fa fa-rocket"></i> Add new Partner
                    </a>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Partner</th>
                        <th>Code</th>
                        <th>Commission</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @foreach ($partnersList as $ports)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $ports->name }}</td>
                            <td>{{ $ports->code }}</td>
                            <td>{{ $ports->commission }}</td>
                            <td>{{ $ports->date }}</td>
                            <td>@if ($ports->status == 1)  <i class="fa fa-check-circle" onclick="partnerschangetatus({{ $ports->id }}, this);" style="cursor:pointer;"></i>  @else  <i class="fa fa-circle-o" onclick="partnerschangetatus({{ $ports->id }}, this);" style="cursor:pointer;"></i>  @endif </td>
                            <td><a href="{{ URL::to('admin/editpartner') }}/{{ $ports->id }}"><i class="fa fa-edit"></i></a> &nbsp; <!--a href=""><i class="fa fa-trash-o"></i></a--></td>
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