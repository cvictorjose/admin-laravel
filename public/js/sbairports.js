/**
 * Created by php on 5/22/2015.
 */
$( document ).ready(function() {
        $("#addairportfrm").validate({
            rules: {
                ap_iata: {
                    required: true,
                    minlength: 3,
                    maxlength: 3
                },
                ap_city: "required",
                ap_rank: "required"
            },
            messages: {
                ap_iata: {
                    required: "Please enter Iata",
                    minlength: "Iata must consist of at least 3 characters",
                    maxlength: "Iata must consist 3 characters",
                },
                ap_city: "Please enter City",
                ap_rank: "Please enter your Smart Rank"
            },
            submitHandler: function (form) {
                var chkval  = $('#chkiata').val();
                if(chkval == 1) {
                    var dataString =  $("#addairportfrm").serialize();
                    $.ajax({
                        url: 'airportadd',
                        dataType: 'json',
                        type: 'post',
                        data: dataString,
                        success: function (data, textStatus, jQxhr) {
                            if(data.stat == 'ok'){
                                $("#addairportfrm").prepend('<div class="alert alert-success alert-dismissable">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                                '<h4>	<i class="icon fa fa-check"></i> Success!</h4>' +
                                data.msg + ' </div>');
                                $( ".alert-success" ).fadeOut( 2000, "linear" );
                                $("#addairportfrm")[0].reset();
                            } else {
                                $("#addairportfrm").prepend('<div class="alert alert-danger alert-dismissable">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                                '<h4>	<i class="icon fa fa-ban"></i> Failed!</h4>' +
                                data.msg + ' </div>');
                                $( ".alert-danger" ).fadeOut( 2000, "linear" );
                            }

                        },
                        error: function (jqXhr, textStatus, errorThrown) {
                            $("#addairportfrm").prepend(errorThrown);
                        }
                    });
                }   else {
                    $("#addairportfrm").prepend('<div class="alert alert-danger alert-dismissable">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                    '<h4>	<i class="icon fa fa-ban"></i> Failed!</h4> IATA Already exists </div>');
                    $(".alert-danger").fadeOut(2000, "linear");
                }
            }
        });

    $("#editairportfrm").validate({
        rules: {
            ap_iata: {
                required: true,
                minlength: 3,
                maxlength: 3
            },
            ap_city: "required",
            ap_rank: "required"
        },
        messages: {
            ap_iata: {
                required: "Please enter Iata",
                minlength: "Iata must consist of at least 3 characters",
                maxlength: "Iata must consist 3 characters",
            },
            ap_city: "Please enter City",
            ap_rank: "Please enter your Smart Rank"
        },
        submitHandler: function (frm) {
            var chkval  = $('#chkiata').val();
            if(chkval == 1) {
                var dataString = $("#editairportfrm").serialize();
                var dataUrl = $("#url").val();
                $.ajax({
                    url: dataUrl,
                    dataType: 'json',
                    type: 'post',
                    data: dataString,
                    async: false,
                    success: function (data, textStatus, jQxhr) {
                        if (data.stat == 'ok') {
                            $("#editairportfrm").prepend('<div class="alert alert-success alert-dismissable">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                            '<h4>	<i class="icon fa fa-check"></i> Success!</h4>' +
                            data.msg + ' </div>');
                            $(".alert-success").fadeOut(2000, "linear");
                        } else {
                            $("#editairportfrm").prepend('<div class="alert alert-danger alert-dismissable">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                            '<h4>	<i class="icon fa fa-ban"></i> Failed!</h4>' +
                            data.msg + ' </div>');
                            $(".alert-danger").fadeOut(2000, "linear");
                        }

                    },
                    error: function (jqXhr, textStatus, errorThrown) {
                        $("#editairportfrm").prepend(errorThrown);
                    }
                });
            }   else {
                $("#editairportfrm").prepend('<div class="alert alert-danger alert-dismissable">' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                '<h4>	<i class="icon fa fa-ban"></i> Failed!</h4> IATA Already exists </div>');
                $(".alert-danger").fadeOut(2000, "linear");
            }
        }
    });
});

function changeairportstatus(airportid, obj)   {
    var optstring   = "Activate";
    var dataString  = "apstat=1&airportid="+airportid;
    var changeclass = "fa fa-check-circle";
    if($(obj).attr('class') == 'fa fa-check-circle')    {
        optstring   = "De-Activate";
        dataString  = "apstat=0&airportid="+airportid;
        changeclass = "fa fa-circle-o";
    }   else changeclass = "fa fa-check-circle";
    var agree = confirm("Are you sure to "+ optstring +" this Airport?");
    if(agree)   {
        $.ajax({
            url: 'sbairportstatuschange',
            dataType: 'json',
            type: 'post',
            data: dataString,
            success: function (data, textStatus, jQxhr) {
                if(data.stat == 'ok'){
                    alert("Airport "+ optstring +"d Successfully!");
                    $(obj).attr('class', changeclass);
                }   else    {
                    alert(data.msg);
                }
            },
            error: function (jqXhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }
}

function checkiataexists()  {
    var iata        = $('#ap_iata').val();
    var dataString  = "iata="+iata;
    var url         = $('#chkurl').val();
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'post',
        data: dataString,
        async: false,
        success: function (data, textStatus, jQxhr) {
            if(data.stat == 'ok'){
                if($('#iata-error'))   {
                    $('#iata-error').remove();
                    $('#chkiata').val('1');
                }
            } else {
                $("#erroriata").html('<label class="control-label" for="inputError" id="iata-error"><i class="fa fa-times-circle-o"></i> '+ data.msg + '</label>');
                $('#chkiata').val('0');
                return false;
            }

        },
        error: function (jqXhr, textStatus, errorThrown) {
            $("#erroriata").html(errorThrown); $('#chkiata').val('0');  return false;
        }
    });
}