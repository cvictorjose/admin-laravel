@extends('admin.app')
@section('header')
    <h1>
        Rimborsi List
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-files-o"></i> Home</a></li>
        <li class="active"><a href="{{ URL::to('admin/cclist') }}">Customer Care List</a></li>
    </ol>
@endsection
<?php foreach($data as $k=>$v) $$k=$v; $stato_pratica   =  config('constants.stato_pratica'); ?>
@section('content')
    <script type="text/javascript" src="{{ asset('/js/cc.js') }}" ></script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <a href="{{ URL::to('admin/download_all_refund ') }}" class="btn btn-app" style="float: right;">
                        <i class="fa fa-download"></i> Refund Request List
                    </a>

                    <div class="input-group input-group-sm">
                        <div class="form-group col-md-6">
                            <label for="ap_price_airport">Stato della pratica</label>
                            <select name="ac_stato" id="acstato"  class="form-control">
                                @foreach($stato_pratica as $k=>$aclang)
                                    <option value="{{ $k }}" >{{ $aclang }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group col-md-3">
                            <label for="ap_price_airport">Dal</label>
                            <input type="text" class="form-control" id="ap_start_date" name="ap_start_date"  placeholder="Enter Start Date" >
                        </div>

                        <div class="form-group col-md-3">
                            <label for="ap_price_airport">Al</label>
                            <input type="text" class="form-control" id="ap_end_date" name="ap_end_date"  placeholder="Enter End Date" >
                        </div>

                           <span class="input-group-btn">
                          <button class="btn btn-info btn-flat" name="filter_btn" id="filter_btn" type="button" onclick="filtersearch();">Go!</button>
                        </span>
                    </div>
                </div>
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Codice Sinistro</th>
                        <th>Cliente</th>
                        <th>Nazione</th>
                        <th>Servizio</th>
                        <th>Scalo<br> partenza</th>
                        <th>Tipo <br>sinistro</th>
                        <th>Stato<br>Pratica</th>
                        <th>Data <br>Partenza</th>
                        <th>Apertura <br>Pratica</th>
                        <th>Conferma <br>Quietanza</th>
                        <th>Data <br>pagamento</th>
                        <th>Rimborso<br>Richiesto</th>
                        <th>Rimborso<br>Airline</th>
                        <th>Rimborso<br>SafeBag</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($ccList as $airlines)
                        <?php
                        $data_partenza=date('d-m-Y', $airlines->depdate);
                        $data_apertura=date('d-m-Y', $airlines->sigdate);

                        $invio_quietanza="";
                        if ($airlines->date_conferma_quietanza > 0)   $invio_quietanza=date('d-m-Y', $airlines->date_conferma_quietanza);

                        $data_pagamento="";
                        if ($airlines->payed > 0)   $data_pagamento=date('d-m-Y', $airlines->closuredate);


                        $ctype = "";
                        $total_ritardatac=0;
                        $total_ritardatacd=0;
                        $total_ritardatacf=0;

                        $total_damaged=0;
                        $total_damagedf=0;

                        $total_lost=0;
                        $total_nsop=0;
                        $total_nsop_d=0;
                        $total_nsop_df=0;
                        $total_nsop_l=0;
                        $total_nsop_r=0;
                        $total_nsop_rd=0;
                        $total_nsop_rf=0;


                        $total_ritardatac=$airlines->rt;
                        $total_ritardatacd=$airlines->rt_d;
                        $total_ritardatacf=$airlines->rt_f;

                        $total_damaged=$airlines->damaged;
                        $total_damagedf=$airlines->damaged_f;

                        $total_lost=$airlines->lost;

                        $total_nsop=$airlines->nsop;
                        $total_nsop_d=$airlines->op_damaged;
                        $total_nsop_df=$airlines->op_damaged_f;
                        $total_nsop_l=$airlines->op_lost;
                        $total_nsop_r=$airlines->op_rt;
                        $total_nsop_rd=$airlines->op_rt_d;
                        $total_nsop_rf=$airlines->op_rt_f;

                        if($total_ritardatac>0) $ctype .= "Rit.Consegna($total_ritardatac) " ;
                        if($total_ritardatacd>0) $ctype .= "Rit.Consegna+Danno($total_ritardatacd) ";
                        if($total_ritardatacf>0) $ctype .= "Rit.Consegna+Furto($total_ritardatacf) ";


                        if($total_damaged>0) $ctype .= "Danno($total_damaged) ";
                        if($total_damagedf>0) $ctype .= "Danno+Furto($total_damagedf) ";

                        if($total_lost>0) $ctype .= "Smarrimento($total_lost) ";

                        if($total_nsop>0) $ctype .= "Operatore($total_nsop) ";

                        if($total_nsop_d>0) $ctype .= "Operatore + Danno($total_nsop_d) ";
                        if($total_nsop_df>0) $ctype .= "Operatore + Danno + Furto($total_nsop_df) ";
                        if($total_nsop_l>0) $ctype .= "Operatore + Smarrimento($total_nsop_l) ";
                        if($total_nsop_r>0) $ctype .= "Operatore + Rit.Consegna($total_nsop_r) ";
                        if($total_nsop_rd>0) $ctype .= "Operatore + Rit.Consegna + Danno($total_nsop_rd) ";
                        if($total_nsop_rf>0) $ctype .= "Operatore + Rit.Consegna + Furto($total_nsop_rf) ";


                        if($airlines->flight_reg_via==4){$type_service="SafeBag24";}else{
                            if($airlines->smartcardcode != ''){ $type_service="Smart Track"; }else{$type_service="Wrapping";}
                        }
                                

                        ?>
                        <tr>
                            <td>{{ $airlines->idclaim }}</td>
                            <td>{{ $airlines->claimcode }}</td>

                            <td>{{ $airlines->name ." ". $airlines->surname }}</td>
                            <td>{{ $airlines->nationality }}</td>
                            <td>{{ $type_service }}</td>
                            <td>{{ $airlines->depport }}</td>
                            <td>{{ $ctype }}</td>

                            <td>{{ $stato_pratica[$airlines->stato_sinistro] }}</td>
                            <td>{{ $data_partenza }}</td>
                            <td>{{ $data_apertura }}</td>
                            <td>{{ $invio_quietanza }}</td>
                            <td>{{ $data_pagamento }}</td>
                            <td>{{ $airlines->importo_richiesto }}</td>
                            <td>{{ $airlines->paidbycom }}</td>
                            <td>{{ $airlines->paidbyus }}</td>
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

        $(function() {
            $( "#ap_expiry_date" ).datepicker();
            $( "#ap_start_date" ).datepicker();
            $( "#ap_end_date" ).datepicker();
        });
    </script>
@endsection