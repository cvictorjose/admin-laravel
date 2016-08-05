/**
 * Created by php on 5/26/2015.
 */

$( document ).ready(function() {
    $("#addpartnerfrm").validate({
        rules: {
            ap_partner: {
                required: true,
                minlength: 3,
            },
            ap_code: {
                required: true,
                minlength: 6,
            }
        },
        messages: {
            ap_partner: {
                required: "Please enter Company",
                minlength: "Company must consist of at least 3 characters",
            },
            ap_code: {
                required: "Please enter Code",
                minlength: "Code must consist of at least 6 characters",
            }
        },
        submitHandler: function (form) {
            var dataString =  $("#addpartnerfrm").serialize();
            $.ajax({
                url: 'partnersadd',
                dataType: 'json',
                type: 'post',
                data: dataString,
                success: function (data, textStatus, jQxhr) {
                    if(data.stat == 'ok'){
                        $("#addpartnerfrm").prepend('<div class="alert alert-success alert-dismissable">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                        '<h4>	<i class="icon fa fa-check"></i> Success!</h4>' +
                        data.msg + ' </div>');
                        $( ".alert-success" ).fadeOut( 2000, "linear" );
                        $("#addpartnerfrm")[0].reset();
                    } else {
                        $("#addpartnerfrm").prepend('<div class="alert alert-danger alert-dismissable">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                        '<h4>	<i class="icon fa fa-ban"></i> Failed!</h4>' +
                        data.msg + ' </div>');
                        $( ".alert-danger" ).fadeOut( 2000, "linear" );
                    }

                },
                error: function (jqXhr, textStatus, errorThrown) {
                    $("#addpartnerfrm").prepend(errorThrown);
                }
            });
        }
    });

    $("#editpartnerfrm").validate({
        rules: {
            ap_partner: {
                required: true,
                minlength: 3,
            },
            ap_code: {
                required: true,
                minlength: 6,
            }
        },
        messages: {
            ap_partner: {
                required: "Please enter Company",
                minlength: "Company must consist of at least 3 characters",
            },
            ap_code: {
                required: "Please enter Code",
                minlength: "Code must consist of at least 6 characters",
            }
        },
        submitHandler: function (frm) {
            var dataString = $("#editpartnerfrm").serialize();
            var dataUrl = $("#url").val();
            $.ajax({
                url: dataUrl,
                dataType: 'json',
                type: 'post',
                data: dataString,
                async: false,
                success: function (data, textStatus, jQxhr) {
                    if (data.stat == 'ok') {
                        $("#editpartnerfrm").prepend('<div class="alert alert-success alert-dismissable">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                        '<h4>	<i class="icon fa fa-check"></i> Success!</h4>' +
                        data.msg + ' </div>');
                        $(".alert-success").fadeOut(2000, "linear");
                    } else {
                        $("#editpartnerfrm").prepend('<div class="alert alert-danger alert-dismissable">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                        '<h4>	<i class="icon fa fa-ban"></i> Failed!</h4>' +
                        data.msg + ' </div>');
                        $(".alert-danger").fadeOut(2000, "linear");
                    }

                },
                error: function (jqXhr, textStatus, errorThrown) {
                    $("#editpartnerfrm").prepend(errorThrown);
                }
            });
        }
    });
});

function partnerschangetatus(airlineid, obj)   {
    var optstring   = "Activate";
    var dataString  = "alstat=1&airlineid="+airlineid;
    var changeclass = "fa fa-check-circle";
    if($(obj).attr('class') == 'fa fa-check-circle')    {
        optstring   = "De-Activate";
        dataString  = "alstat=0&airlineid="+airlineid;
        changeclass = "fa fa-circle-o";
    }   else changeclass = "fa fa-check-circle";
    var agree = confirm("Are you sure to "+ optstring +" this Partner?");
    if(agree)   {
        $.ajax({
            url: 'partnerschangetatus',
            dataType: 'json',
            type: 'post',
            data: dataString,
            success: function (data, textStatus, jQxhr) {
                if(data.stat == 'ok'){
                    alert("Partner "+ optstring +"d Successfully!");
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


function checkcodeexists()  {
    var code        = $('#ap_code').val();
    var dataString  = "code="+code;
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