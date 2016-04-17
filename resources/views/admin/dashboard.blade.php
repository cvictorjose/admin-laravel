<?php foreach($data as $k=>$v) $$k=$v;
$status_flight    =  config('constants.fStatus');
$conf_moths    =  config('constants.acMonths');
?>
@extends('admin.app')
@section('header')
    <h1>
        DashBoard
        <small>Safe-bag Admin</small>
    </h1>

@endsection
@section('content')


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Clients Registered SB24</h3>
                </div><!-- /.box-header -->
                <div class="box-body"  id="table_filtered_content">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 300px;">Description</th>
                            @for($i = 1; $i <= 12; $i++)
                                <th>{{$conf_moths[$i]}}</th>
                            @endfor
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ok Total Clients</td>
                                    <?php
                                     $start=count($total_client_sb24);
                                    ?>
                                     @foreach ($total_client_sb24 as $tc1)
                                         <td>{{$tc1->total}}</td>
                                    @endforeach
                                    @for($i = $start; $i < 12; $i++)
                                        <td>0</td>
                                    @endfor
                            </tr>



                            <tr>
                                <td>ok Total Clients with PromoCode</td>
                                <?php
                                $start=count($total_client_with_promocode);
                                ?>
                                @foreach ($total_client_with_promocode as $tc1)
                                    <td>{{$tc1->total}}</td>
                                @endforeach
                                @for($i = $start; $i < 12; $i++)
                                    <td>0</td>
                                @endfor
                            </tr>

                            <tr>
                                <td> - Safe Bag PromoCode</td>
                                <?php
                                $start=count($total_client_with_promocode_VC);
                                ?>
                                @foreach ($total_client_with_promocode_VC as $tc1)
                                    <td>{{$tc1->total}}</td>
                                @endforeach
                                @for($i = $start; $i < 12; $i++)
                                    <td>0</td>
                                @endfor
                            </tr>


                            <tr>
                                <td> - Partner PromoCode</td>
                                <?php $td_empty=$total_client_with_promocode_IV[0]->month;?>
                                @for($i = 1; $i < $td_empty; $i++)
                                    <td>0</td>
                                @endfor
                                @foreach ($total_client_with_promocode_IV as $tc1)
                                    <td>{{$tc1->total}}</td>
                                    <?php $td_empty++; ?>
                                @endforeach
                                @for($i = $td_empty; $i < 13; $i++)
                                    <td>0</td>
                                @endfor
                            </tr>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.row (box) -->


            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Credits</h3>
                </div><!-- /.box-header -->
                <div class="box-body"  id="table_filtered_content">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 300px;">Description</th>
                            <th style="width: 300px;">xxx</th>
                            <th style="width: 300px;">Usati</th>
                            <th style="width: 300px;">non usati</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Total</td>
                            <td>xx</td>
                            <td>

                            </td>
                            <td>x</td>
                        </tr>



                        <tr>
                            <td>Free Services</td>
                            <td>
                                <?php
                                echo $total_promocode=$total_promocode[0]->total;
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $total_promocode_used=$total_promocode_used[0]->total;
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $total_promocode_used=$total_promocode-$total_promocode_used;
                                ?>
                            </td>
                        </tr>


                        <tr>
                            <td>Pay Services</td>
                            <td>

                            </td>
                            <td>


                            </td>
                            <td>x</td>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.row (box) -->
        </div><!-- /.row (col) -->
    </div><!-- /.row (main row) -->

@endsection