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
                                <?php $td_empty=1?>
                                @if(isset($total_client_with_promocode_IV[0]->month))
                                <?php $td_empty=$total_client_with_promocode_IV[0]->month?>
                                    @for($i = 1; $i < $td_empty; $i++)
                                        <td>0</td>
                                    @endfor
                                    @foreach ($total_client_with_promocode_IV as $tc1)
                                        <td>{{$tc1->total}}</td>
                                        <?php $td_empty++; ?>
                                    @endforeach
                                 @else
                                    @for($i = $td_empty; $i < 13; $i++)
                                        <td>0</td>
                                    @endfor
                                @endif
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
                            <th style="width: 300px;">Total Tracking</th>
                            <th style="width: 300px;">Tracking used</th>
                            <th style="width: 300px;">Tracking remain</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Total</td>
                            <td>{{ $total_1=$total_promocode[0]->total+$total_numflights_payed[0]->total }}</td>
                            <td>{{ $total_2=$total_promocode_used[0]->total+$total_numflights_payed_used[0]->total }}</td>
                            <td>{{ $total_3=$total_numflights_payed[0]->total+$total_numflights_payed[0]->total }}</td>
                        </tr>

                        <tr>
                            <td>Tracking Free</td>
                            <td>{{ $total_promocode=$total_promocode[0]->total }}</td>
                             <td>{{ $total_promocode_used=$total_promocode_used[0]->total }}</td>
                             <td>{{ $total_promocode_noused=$total_promocode-$total_promocode_used }}</td>
                         </tr>

                         <tr>
                             <td>Tracking Paid</td>
                             <td>{{ $total_numflights_payed=$total_numflights_payed[0]->total }}</td>
                             <td>{{ $total_numflights_payed_used=$total_numflights_payed_used[0]->total }}</td>
                             <td>{{ $total_numflights_payed_noused=$total_numflights_payed-$total_numflights_payed_used }}</td>
                        </tr>
                     </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.row (box) -->



            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Transactions Registered SB24</h3>
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
                                <td> Total Entrance</td>
                                <?php
                                $cm = 1;

                                for($i = 0; $i < 12; $i++){
                                    if(isset($total_transactions[$i]->month)){
                                        $m=$total_transactions[$i]->month;
                                        for($v = $cm; $v < $m; $v++){
                                            echo "<td>0</td>";
                                            $cm++;
                                        }
                                        echo "<td>".$total_transactions[$i]->total."</td>";
                                        $last_month=$m;
                                    }
                                    $cm++;
                                }


                                for($i = $last_month; $i < 12; $i++){
                                    echo "<td>0</td>";
                                }
                                ?>
                            </tr>

                            <tr>
                                <td> Total PAYPAL</td>
                                <?php
                                $cm = 1;

                                for($i = 0; $i < 12; $i++){
                                    if(isset($total_transactions[$i]->month)){
                                        $m=$total_transactions[$i]->month;
                                        for($v = $cm; $v < $m; $v++){
                                            echo "<td>0</td>";
                                            $cm++;
                                        }
                                        echo "<td>".$total_transactions[$i]->total."</td>";
                                        $last_month=$m;
                                    }
                                    $cm++;
                                }


                                for($i = $last_month; $i < 12; $i++){
                                    echo "<td>0</td>";
                                }
                                ?>
                            </tr>


                               <?php
                               for($tr = 1; $tr < 4; $tr++){
                               switch ($tr) {
                                   case 1:
                                       $pack=$total_money_p1;
                                       break;
                                   case 2:
                                       $pack=$total_money_p2;
                                       break;
                                   case 10:
                                       $pack=$total_money_p10;
                                       break;
                               }
                               ?>

                                   <tr>
                                   <td>- Pack {{$tr}} Flight</td>
                                   <?php
                                   $cm = 1; $upto_td=1;
                                   $total_td=count($pack);
                                   for($i = 0; $i < 12; $i++){

                                       if(isset($pack[$i]->month)){
                                           $m=$pack[$i]->month;
                                           for($v = $cm; $v < $m; $v++){
                                               echo "<td>0</td>";
                                               $cm++;
                                               $upto_td=$cm;
                                           }
                                           echo "<td>".$pack[$i]->total."</td>";
                                       }
                                       $cm++;
                                   }
                                   $total_colum=$total_td+=$upto_td;

                                   for($i = $total_colum; $i < 13; $i++){
                                       echo "<td>0</td>";
                                   }
                                   ?>
                                   </tr>
                               <?php
                               }
                               ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.row (box) -->
    </div><!-- /.row (col) -->
</div><!-- /.row (main row) -->

@endsection