@extends('admin.app')
@section('header')
    <h1>
        Airport Products List
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-files-o"></i> Home</a></li>
        <li class="active">Airport Products </li>
        <li class="active">Airport Products List</li>
    </ol>
@endsection
<?php foreach($data as $k=>$v) $$k=$v; $filter_lang="en";?>
@section('content')
    <script type="text/javascript" src="{{ asset('/js/priceairport.js') }}" ></script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Airport Products</h3>
                    <a href="{{ URL::to('admin/pricexairportadd') }}" class="btn btn-app" style="float: right;">
                        <i class="fa fa-rocket"></i> Add new Airport Product
                    </a>
                </div><!-- /.box-header -->
                <div class="box-body" >
                    <table id="example1" class="table table-bordered table-striped" style="font-size:xx-small ">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Lang</th>
                        <th>Currency</th>
                        <th>Price Web</th>
                        <th>Price Airport</th>
                        <th>Airports - Booking</th>
                        <th>Data di scandenza</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @foreach ($apList as $products)
                        <?php $i++; ?>
                        <tr  >
                            <td>{{ $i }}</td>
                            <td><img src="http://www.safe-bag.com/cmproducts/images/{{$products->image }}" width="25%"></td>
                            <td><a class="moredesc" onclick="opendesc({{ $products->id_prodotto }}, '{{ $filter_lang }}');" style="cursor: pointer;">{{ $products->titolo }}</a>
                                <!-- tooltip element -->
                                <div class="desctooltip{{ $products->id_prodotto }}{{ $filter_lang }}"  style="display: none;">
                                    <?php echo html_entity_decode(mb_convert_encoding($products->descrizione_web, 'HTML-ENTITIES', 'UTF-8'));  ?>
                                </div></td>
                            <td>{{ $products->lingua }}</td>
                            <td>{{ $products->currency }}</td>
                            <td>{{ $products->prezzo_web_app }}</td>
                            <td>{{ $products->prezzo_aeroporto }}</td>

                            <td><?php
                                $exArr = @explode(',', $products->aeroporto_di_vendita);
                                foreach($exArr as $key=>$value){
                                    echo $exArr[$key].', ';
                                }
                               ?>
                            </td>
                            <td>{{ date('d-m-Y', strtotime($products->data_di_scandenza)) }}</td>
                            <td>{{ date('d-m-Y', $products->start_date) }}</td>
                            <td>{{ date('d-m-Y', $products->end_date) }}</td>
                            <td>@if ($products->stato == 1)  <i class="fa fa-check-circle" onclick="changeairproductstatus({{ $products->id_prodotto }}, this);" style="cursor:pointer;"></i>  @else  <i class="fa fa-circle-o" onclick="changeairproductstatus({{ $products->id_prodotto }}, this);" style="cursor:pointer;"></i>  @endif </td>
                            <td><a href="{{ URL::to('admin/editpricexairport') }}/{{ $products->id_prodotto }}"><i class="fa fa-edit"></i></a> &nbsp; <!--a href=""><i class="fa fa-trash-o"></i></a--></td>
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