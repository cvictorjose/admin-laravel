@extends('admin.app')
<?php foreach($data as $k=>$v) $$k=$v; $apLanguages    =  config('constants.apLanguages'); ?>
@section('header')
    <h1>
        @if($mode == 'edit')
            Airport Product Edit
        @else
            Airport Product Add
        @endif
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Home</a></li>

        <li><a href="{{ URL::to('admin/airportproductlist') }}">Airport Product List</a></li>
        @if($mode == 'edit')
            <li class="active">Airport Product Edit</li>
        @else
            <li class="active">Airport Product Add</li>
        @endif
    </ol>
@endsection
<?php if((isset($apDetails) && count($apDetails)>0 && isset($apDetails->id_prodotto) && $apDetails->id_prodotto>0) || $mode == 'add')  {   ?>
@section('content')
    <script type="text/javascript" src="{{ asset('/js/airportproduct.js') }}" ></script>
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    @if($mode == 'edit')
                        <h3 class="box-title">Edit Airport Product</h3>
                    @else
                        <h3 class="box-title">Add Airport Product</h3>
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
                    <form role="form" method="post" name="editaproductfrm" id="editaproductfrm" enctype="multipart/form-data">
                        @else
                            <form method="post" name="addaproductfrm" id="addaproductfrm" enctype="multipart/form-data">
                                @endif
                                @if($mode == 'edit')
                                    <input type="hidden" name="url" id="url" value="{{ URL::to('admin/editairportproduct') }}/{{ $apDetails->id_prodotto }}">
                                    <input type="hidden" name="ad_apid" id="ad_apid" value="{{ $apDetails->id_prodotto }}">
                                @else
                                    <input type="hidden" name="url" id="url" value="{{ URL::to('admin/airportproductadd') }}">
                                @endif
                                <input type="hidden" name="chkurl" id="chkurl" />
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                <div class="box-body">

                                    <div class="form-group col-md-6">
                                        <label for="ap_title">Title</label>
                                        <input type="text" class="form-control" id="ap_title" name="ap_title"  placeholder="Enter Title" @if($mode == 'edit') value="{{ $apDetails->titolo }}" @endif required="required">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="ap_product_code">Product Code</label>
                                        <input type="text" class="form-control" id="ap_product_code" name="ap_product_code"  placeholder="Enter Product Code" @if($mode == 'edit') value="{{ $apDetails->codice_prodotto }}" @endif required="required">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="ap_priority">Priority</label>
                                        <input type="text" class="form-control" id="ap_priority" name="ap_priority"  placeholder="Enter Priority" @if($mode == 'edit') value="{{ $apDetails->priority }}" @endif required="required">
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="ap_lang">Language</label>
                                        <select name="ap_lang" id="ap_lang" class="form-control">

                                            @foreach($apLanguages as $k=>$lang)
                                                <option value="{{ $k }}" @if($mode == 'edit') @if($k == $apDetails->lingua) selected="selected" @endif @endif>{{ $lang }}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="form-group col-md-12">
                                        <label for="ap_airport_sales">Airport Sales</label>
                                        <?php  if($mode == 'edit') { $portarray   = array(); $portarray    = explode(',', $apDetails->aeroporto_di_vendita); } ?>
                                        <select name="ap_airport_sales[]" id="ap_airport_sales" class="form-control" multiple="multiple">
                                            <option value=""> Select the Airport Sales </option>
                                            @foreach($airportsList as $ports)
                                                <option value="{{ $ports->depport }}" @if($mode == 'edit') <?php if(in_array($ports->depport, $portarray)) echo ' selected="selected" '; ?> @endif>{{ $ports->city }}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="form-group col-md-12">
                                        <label for="ap_image">Upload Image</label>
                                        <input type="file" id="ap_image" name="ap_image"  accept="image/*" >
                                        @if($mode == 'edit')
                                            @if($apDetails->image != '')
                                                <img src="{{ asset('/airproductpictures') }}/{{ $apDetails->image }}" height="30" width="30"></p>
                                            @endif
                                        @endif
                                    </div>

                                    <div class="div-group col-md-12">
                                        <div class="form-group">
                                            <label for="ap_web_desc">Web Description </label> <span class="mandatory">*</span>
                                            <textarea id="ap_web_desc" name="ap_web_desc" rows="10" cols="80">
                                              @if($mode == 'edit') {{ $apDetails->descrizione_web }} @else Enter the Web Description  @endif
                                            </textarea>
                                        </div>
                                    </div><!-- /. class="div-group" -->


                                    <div class="checkbox  col-md-12">
                                        <label for="ap_status">
                                            <input type="checkbox" id="ap_status" name="ap_status" value="1" @if($mode == 'edit')  @if($apDetails->stato == "1") checked="checked" @endif  @endif> Status
                                        </label>
                                    </div>
                                </div><!-- /.box-body -->

                                <div class="box-footer">
                                    <input type="submit" class="btn btn-primary" id="addac" name="addap" value="Submit">
                                    <input type="reset" class="btn btn-primary" value="Reset">
                                </div>
                            </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row (main row) -->
    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>

    <script type="text/javascript">
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('ap_web_desc');
        });

        $(function(){
            $('.tab-section').hide();
            $('#tabs a').bind('click', function(e){
                $('#tabs a.current').removeClass('current');
                $('.tab-section:visible').hide();
                $(this.hash).show();
                $(this).addClass('current');
                e.preventDefault();
            }).filter(':first').click();
        });

        $(function() {
            $( "#ap_expiry_date" ).datepicker();
            $( "#ap_start_date" ).datepicker();
            $( "#ap_end_date" ).datepicker();
        });
    </script>
@endsection
<?php }   else {    ?>
@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Airport Product</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    Invalid Airport Product to Edit
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <a href="{{ URL::to('admin/airportproductlist') }}" class="btn btn-app">
                        <i class="fa fa-users"></i> Back to Airport Content List
                    </a>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row (main row) -->
@endsection
<?php } ?>