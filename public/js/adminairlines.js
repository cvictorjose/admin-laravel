/**
 * Created by php on 5/26/2015.
 */

$( document ).ready(function() {
    $("#addairlinefrm").validate({
        rules: {
            al_name: {
                required: true,
                minlength: 3,
            },
            al_code: {
                required: true,
                minlength: 2,
            },
            al_country: "required"
        },
        messages: {
            al_name: {
                required: "Please enter Name",
                minlength: "Name must consist of at least 3 characters",
            },
            al_code: {
                required: "Please enter Code",
                minlength: "Code must consist of at least 2 characters",
            },
            al_country: "Please Select Country"
        },
        submitHandler: function (form) {
            var dataString =  $("#addairlinefrm").serialize();
            $.ajax({
                url: 'airlineadd',
                dataType: 'json',
                type: 'post',
                data: dataString,
                success: function (data, textStatus, jQxhr) {
                    if(data.stat == 'ok'){
                        $("#addairlinefrm").prepend('<div class="alert alert-success alert-dismissable">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                        '<h4>	<i class="icon fa fa-check"></i> Success!</h4>' +
                        data.msg + ' </div>');
                        $( ".alert-success" ).fadeOut( 2000, "linear" );
                        $("#addairlinefrm")[0].reset();
                    } else {
                        $("#addairlinefrm").prepend('<div class="alert alert-danger alert-dismissable">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                        '<h4>	<i class="icon fa fa-ban"></i> Failed!</h4>' +
                        data.msg + ' </div>');
                        $( ".alert-danger" ).fadeOut( 2000, "linear" );
                    }

                },
                error: function (jqXhr, textStatus, errorThrown) {
                    $("#addairlinefrm").prepend(errorThrown);
                }
            });
        }
    });

    $("#editairlinefrm").validate({
        rules: {
            al_name: {
                required: true,
                minlength: 3,
            },
            al_code: {
                required: true,
                minlength: 2,
            },
            al_country: "required"
        },
        messages: {
            al_name: {
                required: "Please enter Name",
                minlength: "Name must consist of at least 3 characters",
            },
            al_code: {
                required: "Please enter Code",
                minlength: "Code must consist of at least 2 characters",
            },
            al_country: "Please Select Country"
        },
        submitHandler: function (frm) {
            var dataString = $("#editairlinefrm").serialize();
            var dataUrl = $("#url").val();
            $.ajax({
                url: dataUrl,
                dataType: 'json',
                type: 'post',
                data: dataString,
                async: false,
                success: function (data, textStatus, jQxhr) {
                    if (data.stat == 'ok') {
                        $("#editairlinefrm").prepend('<div class="alert alert-success alert-dismissable">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                        '<h4>	<i class="icon fa fa-check"></i> Success!</h4>' +
                        data.msg + ' </div>');
                        $(".alert-success").fadeOut(2000, "linear");
                    } else {
                        $("#editairlinefrm").prepend('<div class="alert alert-danger alert-dismissable">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                        '<h4>	<i class="icon fa fa-ban"></i> Failed!</h4>' +
                        data.msg + ' </div>');
                        $(".alert-danger").fadeOut(2000, "linear");
                    }

                },
                error: function (jqXhr, textStatus, errorThrown) {
                    $("#editairlinefrm").prepend(errorThrown);
                }
            });
        }
    });
});

function changeairlinestatus(airlineid, obj)   {
    var optstring   = "Activate";
    var dataString  = "alstat=1&airlineid="+airlineid;
    var changeclass = "fa fa-check-circle";
    if($(obj).attr('class') == 'fa fa-check-circle')    {
        optstring   = "De-Activate";
        dataString  = "alstat=0&airlineid="+airlineid;
        changeclass = "fa fa-circle-o";
    }   else changeclass = "fa fa-check-circle";
    var agree = confirm("Are you sure to "+ optstring +" this Airline?");
    if(agree)   {
        $.ajax({
            url: 'airlinestatuschange',
            dataType: 'json',
            type: 'post',
            data: dataString,
            success: function (data, textStatus, jQxhr) {
                if(data.stat == 'ok'){
                    alert("Airline "+ optstring +"d Successfully!");
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