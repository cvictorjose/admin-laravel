@extends('admin.app')
<?php foreach($data as $k=>$v) $$k=$v; $acLanguages    =  config('constants.scLanguages');  $acDays     =  config('constants.acDays'); ?>
@section('header')
    <h1>
        @if($mode == 'edit')
            Airport Content Edit
        @else
            Airport Content Add
        @endif
        <small>Safe-bag Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-files-o"></i> Home</a></li>
        <li>News </li>
        <li><a href="{{ URL::to('admin/airportcontentlist') }}">Airport Content List</a></li>
        @if($mode == 'edit')
            <li class="active">Airport Content Edit</li>
        @else
            <li class="active">Airport Content Add</li>
        @endif
    </ol>
@endsection
<?php if((isset($acDetails) && count($acDetails)>0 && isset($acDetails->id_postazione) && $acDetails->id_postazione>0) || $mode == 'add')  {   ?>
@section('content')
    <!-- bootstrap time picker -->
    <link href="{{ asset('/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('/js/airportcontent.js') }}" ></script>
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    @if($mode == 'edit')
                        <h3 class="box-title">Edit Airport Content</h3>
                    @else
                        <h3 class="box-title">Add Airport Content</h3>
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
                    <form role="form" method="post" name="editacontentfrm" id="editacontentfrm" enctype="multipart/form-data">
                @else
                    <form method="post" name="addacontentfrm" id="addacontentfrm" enctype="multipart/form-data">
                @endif
                @if($mode == 'edit')
                    <input type="hidden" name="url" id="url" value="{{ URL::to('admin/editairportcontent') }}/{{ $acDetails->id_postazione }}">
                    <input type="hidden" name="ad_acid" id="ad_acid" value="{{ $acDetails->id_postazione }}">
                @else
                    <input type="hidden" name="url" id="url" value="{{ URL::to('admin/airportcontentadd') }}">
                @endif
                    <input type="hidden" name="chkurl" id="chkurl" value="{{ URL::to('admin/airportcontenttitlecheck') }}" />
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    <input type="hidden" name="chktitle" id="chktitle" @if($mode == 'edit') value="1" @else value="0" @endif">
                    <div class="box-body">

                        <div class="form-group col-md-6">
                            <label for="ac_airport">Airport</label>
                            <select class="form-control" id="ac_airport" name="ac_airport">
                                <option value="" >Select the Airport</option>
                                @foreach($airportsList as $ports)
                                    <option value="{{ $ports->iddepport }}" @if($mode == 'edit') @if($ports->iddepport == $acDetails->id_airport) selected="selected" @endif @endif >{{ $ports->city }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="ac_name">Airport Name</label>
                            <input type="text" class="form-control" id="ac_name" name="ac_name"  placeholder="Enter Airport Name" @if($mode == 'edit') value="{{ $acDetails->name_airport }}" @endif required="required">
                        </div>

                        <div class="div-group col-md-12">

                            <ul id="tabs">
                                @foreach($acLanguages as $k=>$aclang)
                                    <li><a href="#{{ $k }}">{{ $aclang }}</a></li>
                                @endforeach
                            </ul>
                            @foreach($acLanguages as $k=>$aclang)
                                <div id="{{ $k }}" class="tab-section">
                                    <div class="form-group">
                                        <label for="ac_intro">Terminal - {{ $aclang }}</label> <span
                                                class="mandatory">*</span><?php $varname = "testo_intro_".$k; ?>
                                        <input type="text" class="form-control" id="ac_intro_{{ $k }}" name="ac_intro[{{ $k }}]" @if($mode == 'edit') value="{{ $acDetails->$varname }}" @endif placeholder="Enter Intro Text in {{ $aclang }}" @if($k=='en') required="required" @endif />
                                    </div>

                                    <div class="form-group"><?php $varname = "descrizione_".$k; ?>
                                        <label for="ac_descrizione{{ $k }}">Description - {{ $aclang }}</label> <span class="mandatory">*</span>
                                    <textarea id="ac_descrizione{{ $k }}" name="ac_descrizione[{{ $k }}]" rows="10" cols="80">
                                      @if($mode == 'edit') {{ $acDetails->$varname }} @else Enter the Description in {{ $aclang }}  @endif
                                    </textarea>
                                    </div>

                                    <div class="form-group"><?php $varname = "orario_".$k; ?>
                                        <label for="ac_time{{ $k }}">Time - {{ $aclang }}</label> <span class="mandatory">*</span>
                                    <textarea id="ac_time{{ $k }}" name="ac_time[{{ $k }}]" rows="10" cols="80">
                                      @if($mode == 'edit') {{ $acDetails->$varname }} @else Enter the Time Details in {{ $aclang }}  @endif
                                    </textarea>
                                    </div>
                                </div>
                            @endforeach

                        </div><!-- /. class="div-group" -->

                        <div class="form-group">
                            <label for="ac_image">Image</label>
                            <input type="file" id="ac_image" name="ac_image"  accept="image/*" >
                            @if($mode == 'edit')
                                @if($acDetails->image != '')
                                    <img src="{{ asset('/public/acontentpictures') }}/{{ $acDetails->image }}" height="30" width="30"></p>
                                @endif
                            @endif
                        </div>

                        @foreach($acDays as $k=>$acdays)
                            <div class="bootstrap-timepicker  col-md-3">
                                @if($mode == 'edit')
                                <?php $timeArray    = explode(' - ', $acDetails->$k); ?>
                                @endif
                                <div class="form-group">
                                    <label>{{ $acdays }}:</label>
                                    <div class="input-group col-md-6">
                                        <input type="text" name="ac_opentimestart[{{ $k }}]" id="ac_opentimestart{{ $k }}" class="form-control timepicker" @if($mode == 'edit') value="<?php echo $timeArray[0]; ?>" @endif />
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div><!-- /.input group -->&nbsp;
                                    <div class="input-group col-md-6">
                                        <input type="text" name="ac_opentimeend[{{ $k }}]" id="ac_opentimeend{{ $k }}" class="form-control timepicker" @if($mode == 'edit') value="<?php echo $timeArray[1]; ?>" @endif />
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                            </div>
                        @endforeach

<div style="clear: both"></div>
                        <div class="checkbox  col-md-12">
                            <label for="ac_status">
                                <input type="checkbox" id="ac_status" name="ac_status" value="1" @if($mode == 'edit')  @if($acDetails->status == "1") checked="checked" @endif  @endif> Status
                            </label>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" id="addac" name="addac" value="Submit">
                        <input type="reset" class="btn btn-primary" value="Reset">
                    </div>
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row (main row) -->
    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
    <!-- bootstrap time picker -->
    <script src="{{ asset('/plugins/timepicker/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            <?php foreach($acLanguages as $k=>$aclang)  {
                echo "CKEDITOR.replace('ac_descrizione".$k."');";
                echo "CKEDITOR.replace('ac_time".$k."');"; }?>
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

        //Timepicker
        <?php foreach($acDays as $k=>$acdays)  {
            echo "$('#ac_opentimestart".$k."').timepicker({showInputs: false, timeFormat: 'HH:mm:ss'  });";
            echo "$('#ac_opentimeend".$k."').timepicker({showInputs: false, timeFormat: 'HH:mm:ss'  });";
        }   ?>
    </script>

@endsection
<?php }   else {    ?>
@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Airport Content</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    Invalid Airport Content to Edit
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <a href="{{ URL::to('admin/airportcontentlist') }}" class="btn btn-app">
                        <i class="fa fa-users"></i> Back to Airport Content List
                    </a>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row (main row) -->
@endsection
<?php } ?>