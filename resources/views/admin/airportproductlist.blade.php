@extends('admin.app')
@section('header')
    <h1>
        Airport Products List
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Home</a></li>
        <li class="active">Airport Products </li>
        <li class="active">Airport Products List</li>
    </ol>
@endsection
<?php foreach($data as $k=>$v) $$k=$v; $filter_lang="en";?>
@section('content')
    <script type="text/javascript" src="{{ asset('/js/airportproduct.js') }}" ></script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Airport Products</h3>
                    <a href="{{ URL::to('admin/airportproductadd') }}" class="btn btn-app" style="float: right;">
                        <i class="fa fa-rocket"></i> Add new Airport Product
                    </a>
                </div><!-- /.box-header -->
                <div class="box-body" >
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Language</th>

                        <th>Priority</th>

                        <th>Web Description</th>


                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @foreach ($apList as $products)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td><img src="http://www.safe-bag.com/cmproducts/images/{{$products->image }}" width="25%"></td>
                            <td>{{ $products->titolo }}</td>
                            <td>{{ $products->lingua }}</td>
                            <td>{{ $products->priority }}</td>

                            <td>  <a class="moredesc" onclick="opendesc({{ $products->id_prodotto }}, '{{ $filter_lang }}');" style="cursor: pointer;">...More...</a>
                                <!-- tooltip element -->
                                <div class="desctooltip{{ $products->id_prodotto }}{{ $filter_lang }}"  style="display: none;">
                                    <?php echo html_entity_decode(mb_convert_encoding($products->descrizione_web, 'HTML-ENTITIES', 'UTF-8'));  ?>
                                </div>
                            </td>
                            <td>@if ($products->stato == 1)  <i class="fa fa-check-circle" onclick="changeairproductstatus({{ $products->id_prodotto }}, this);" style="cursor:pointer;"></i>  @else  <i class="fa fa-circle-o" onclick="changeairproductstatus({{ $products->id_prodotto }}, this);" style="cursor:pointer;"></i>  @endif </td>
                            <td><a href="{{ URL::to('admin/editairportproduct') }}/{{ $products->id_prodotto }}"><i class="fa fa-edit"></i></a> &nbsp; <!--a href=""><i class="fa fa-trash-o"></i></a--></td>
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
        function opendesc(pid, lang){
            $('.desctooltip'+pid+lang).css("width", "400px");
            $('.desctooltip'+pid+lang).css("height", "300px");
            $('.desctooltip'+pid+lang).css("background-color", "#fff");
            $('.desctooltip'+pid+lang).css("border", "1px solid black");
            $('.desctooltip'+pid+lang).css("overflow", "auto");
            $('.desctooltip'+pid+lang).css("padding", "10px");
            $('.desctooltip'+pid+lang).bPopup({
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