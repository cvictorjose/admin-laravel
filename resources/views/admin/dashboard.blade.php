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
                    <h3 class="box-title">Clients Registered SB24 - {{$y = date("Y")}}</h3>
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
                                <td> Total Clients</td>
                                <?php
                                $cm = 1;$last_month="0";
                                for($i = 0; $i < 12; $i++){
                                    if(isset($total_client_sb24[$i]->month)){
                                        $m=$total_client_sb24[$i]->month;
                                        for($v = $cm; $v < $m; $v++){
                                            echo "<td>0</td>";
                                            $cm++;
                                        }
                                        echo "<td>".$total_client_sb24[$i]->total."</td>";
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
                                <td> Total Clients with PromoCode</td>
                                <?php
                                $cm = 1;$last_month="0";
                                for($i = 0; $i < 12; $i++){
                                    if(isset($total_client_with_promocode[$i]->month)){
                                        $m=$total_client_with_promocode[$i]->month;
                                        for($v = $cm; $v < $m; $v++){
                                            echo "<td>0</td>";
                                            $cm++;
                                        }
                                        echo "<td>".$total_client_with_promocode[$i]->total."</td>";
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
                                <td> - Safe Bag PromoCode - Utente</td>
                                <?php
                                $cm = 1;$last_month="0";
                                for($i = 0; $i < 12; $i++){
                                    if(isset($total_client_with_promocode_1[$i]->month)){
                                        $m=$total_client_with_promocode_1[$i]->month;
                                        for($v = $cm; $v < $m; $v++){
                                            echo "<td>0</td>";
                                            $cm++;
                                        }
                                        echo "<td>".$total_client_with_promocode_1[$i]->total."</td>";
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
                                <td> - Safe Bag PromoCode - Partner</td>
                                <?php
                                $cm = 1;$last_month="0";
                                for($i = 0; $i < 12; $i++){
                                    if(isset($total_client_with_promocode_2[$i]->month)){
                                        $m=$total_client_with_promocode_2[$i]->month;
                                        for($v = $cm; $v < $m; $v++){
                                            echo "<td>0</td>";
                                            $cm++;
                                        }
                                        echo "<td>".$total_client_with_promocode_2[$i]->total."</td>";
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
                                <td> - Safe Bag PromoCode - Smart-Track</td>
                                <?php
                                $cm = 1;$last_month="0";
                                for($i = 0; $i < 12; $i++){
                                    if(isset($total_client_with_promocode_3[$i]->month)){
                                        $m=$total_client_with_promocode_3[$i]->month;
                                        for($v = $cm; $v < $m; $v++){
                                            echo "<td>0</td>";
                                            $cm++;
                                        }
                                        echo "<td>".$total_client_with_promocode_3[$i]->total."</td>";
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
                                <td> - Safe Bag PromoCode - Wrapping</td>
                                <?php
                                $cm = 1;$last_month="0";
                                for($i = 0; $i < 12; $i++){
                                    if(isset($total_client_with_promocode_4[$i]->month)){
                                        $m=$total_client_with_promocode_4[$i]->month;
                                        for($v = $cm; $v < $m; $v++){
                                            echo "<td>0</td>";
                                            $cm++;
                                        }
                                        echo "<td>".$total_client_with_promocode_4[$i]->total."</td>";
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
                                <td> - Safe Bag PromoCode</td>
                                <?php
                                $cm = 1;$last_month="0";
                                for($i = 0; $i < 12; $i++){
                                    if(isset($total_client_with_promocode_5[$i]->month)){
                                        $m=$total_client_with_promocode_5[$i]->month;
                                        for($v = $cm; $v < $m; $v++){
                                            echo "<td>0</td>";
                                            $cm++;
                                        }
                                        echo "<td>".$total_client_with_promocode_5[$i]->total."</td>";
                                        $last_month=$m;
                                    }
                                    $cm++;
                                }
                                for($i = $last_month; $i < 12; $i++){
                                    echo "<td>0</td>";
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.row (box) -->

            <div class="box">
               <div class="box-header">
                   <h3 class="box-title">Transactions Registered SB24 - {{$y = date("Y")}}</h3>
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
                           <td> Total Entrance in EURO</td>
                           <?php
                           $cm = 1;
                           $last_month="0";
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
                           <td class="text-bold"> Total Entrance with Credit Card</td>
                           <?php
                           $cm = 1;
                           $last_month="0";
                           for($i = 0; $i < 12; $i++){
                               if(isset($total_transactions_credit_card[$i]->month)){
                                   $m=$total_transactions_credit_card[$i]->month;
                                   for($v = $cm; $v < $m; $v++){
                                       echo "<td>0</td>";
                                       $cm++;
                                   }
                                   echo "<td>".$total_transactions_credit_card[$i]->total."</td>";
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
                           <td> - Total Entrance Pack 1 / 2 Flights</td>
                           <?php
                           $cm = 1;
                           $last_month="0";
                           for($i = 0; $i < 12; $i++){
                               if(isset($total_money_p1_credit_card[$i]->month)){
                                   $m=$total_money_p1_credit_card[$i]->month;
                                   for($v = $cm; $v < $m; $v++){
                                       echo "<td>0</td>";
                                       $cm++;
                                   }
                                   echo "<td>".$total_money_p1_credit_card[$i]->total."</td>";
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
                           <td> - Total Entrance Pack 2 / 4 Flights</td>
                           <?php
                           $cm = 1;
                           $last_month="0";
                           for($i = 0; $i < 12; $i++){
                               if(isset($total_money_p2_credit_card[$i]->month)){
                                   $m=$total_money_p2_credit_card[$i]->month;
                                   for($v = $cm; $v < $m; $v++){
                                       echo "<td>0</td>";
                                       $cm++;
                                   }
                                   echo "<td>".$total_money_p2_credit_card[$i]->total."</td>";
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
                           <td> - Total Entrance Pack 3 / 8 Flights</td>
                           <?php
                           $cm = 1;
                           $last_month="0";
                           for($i = 0; $i < 12; $i++){
                               if(isset($total_money_p3_credit_card[$i]->month)){
                                   $m=$total_money_p3_credit_card[$i]->month;
                                   for($v = $cm; $v < $m; $v++){
                                       echo "<td>0</td>";
                                       $cm++;
                                   }
                                   echo "<td>".$total_money_p3_credit_card[$i]->total."</td>";
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
                           <td> - Total Entrance Pack 4 / 16 Flights</td>
                           <?php
                           $cm = 1;
                           $last_month="0";
                           for($i = 0; $i < 12; $i++){
                               if(isset($total_money_p4_credit_card[$i]->month)){
                                   $m=$total_money_p4_credit_card[$i]->month;
                                   for($v = $cm; $v < $m; $v++){
                                       echo "<td>0</td>";
                                       $cm++;
                                   }
                                   echo "<td>".$total_money_p4_credit_card[$i]->total."</td>";
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
                           <td class="text-bold"> Total Entrance with Paypal</td>
                           <?php
                           $cm = 1;
                           $last_month="0";
                           for($i = 0; $i < 12; $i++){
                               if(isset($total_transactions_Paypal[$i]->month)){
                                   $m=$total_transactions_Paypal[$i]->month;
                                   for($v = $cm; $v < $m; $v++){
                                       echo "<td>0</td>";
                                       $cm++;
                                   }
                                   echo "<td>".$total_transactions_Paypal[$i]->total."</td>";
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
                           <td> - Total Entrance Pack 1 / 2 Flights</td>
                           <?php
                           $cm = 1;
                           $last_month="0";
                           for($i = 0; $i < 12; $i++){
                               if(isset($total_money_p1_Paypal[$i]->month)){
                                   $m=$total_money_p1_Paypal[$i]->month;
                                   for($v = $cm; $v < $m; $v++){
                                       echo "<td>0</td>";
                                       $cm++;
                                   }
                                   echo "<td>".$total_money_p1_Paypal[$i]->total."</td>";
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
                           <td> - Total Entrance Pack 2 / 4 Flights</td>
                           <?php
                           $cm = 1;
                           $last_month="0";
                           for($i = 0; $i < 12; $i++){
                               if(isset($total_money_p2_Paypal[$i]->month)){
                                   $m=$total_money_p2_Paypal[$i]->month;
                                   for($v = $cm; $v < $m; $v++){
                                       echo "<td>0</td>";
                                       $cm++;
                                   }
                                   echo "<td>".$total_money_p2_Paypal[$i]->total."</td>";
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
                           <td> - Total Entrance Pack 3 / 8 Flights</td>
                           <?php
                           $cm = 1;
                           $last_month="0";
                           for($i = 0; $i < 12; $i++){
                               if(isset($total_money_p3_Paypal[$i]->month)){
                                   $m=$total_money_p3_Paypal[$i]->month;
                                   for($v = $cm; $v < $m; $v++){
                                       echo "<td>0</td>";
                                       $cm++;
                                   }
                                   echo "<td>".$total_money_p3_Paypal[$i]->total."</td>";
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
                           <td> - Total Entrance Pack 4 / 16 Flights</td>
                           <?php
                           $cm = 1;
                           $last_month="0";
                           for($i = 0; $i < 12; $i++){
                               if(isset($total_money_p4_Paypal[$i]->month)){
                                   $m=$total_money_p4_Paypal[$i]->month;
                                   for($v = $cm; $v < $m; $v++){
                                       echo "<td>0</td>";
                                       $cm++;
                                   }
                                   echo "<td>".$total_money_p4_Paypal[$i]->total."</td>";
                                   $last_month=$m;
                               }
                               $cm++;
                           }
                           for($i = $last_month; $i < 12; $i++){
                               echo "<td>0</td>";
                           }
                           ?>
                       </tr>

                       </tbody>
                   </table>
               </div><!-- /.box-body -->
           </div><!-- /.row (box) -->



            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tracking - {{$y = date("Y")}}</h3>
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
                        <?php
                        $total_promocode=$total_promocode[0]->total;
                        $total_promocode_users_bis=$total_users_bis[0]->total;
                        $total_free=$total_promocode-$total_promocode_users_bis;
                        ?>
                        <tr>
                            <td>Total</td>
                            <td>{{ $total_1=$total_free+$total_numflights_payed[0]->total }}</td>
                            <td>{{ $total_2=$total_promocode_used[0]->total+$total_numflights_payed_used[0]->total }}</td>
                            <td>{{ $total_3=$total_1- $total_2}}</td>
                        </tr>

                        <tr>
                            <td>Tracking Free</td>
                            <td> {{ $total_free }}</td>
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

        </div><!-- /.row (col) -->
    </div><!-- /.row (main row) -->
    </div><!-- /.row (col) -->
</div><!-- /.row (main row) -->






@endsection