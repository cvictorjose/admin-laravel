/**
 * Created by php on 5/22/2015.
 */
$( document ).ready(function() {
    $("#adduserfrm").validate({
        rules: {
            ad_username: {
                required: true,
                minlength: 6,
            },
            ad_firstname: "required",
            ad_lastname: "required",
            ad_email: {
                required: true,
                email: true
            },
            ad_pwd:{
                required: true,
                minlength: 5
            },
            ad_cpwd:{
                required: true,
                minlength: 5,
                equalTo: "#ad_pwd"
            },
            ad_designation: "required",
            ad_access_level: "required"

        },
        messages: {
            ad_username: {
                required: "Please enter Username",
                minlength: "User name must consist of at least 6 characters",
            },
            ad_firstname: "Please enter Firstname",
            ad_lastname: "Please enter Lastname",
            ad_email: "Please enter the valid Email Address",
            ad_pwd:{
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            ad_cpwd:{
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Please enter the same password as above"
            },
            ad_designation: "Please select the Designation",
            ad_access_level: "Please select the Access Level"

        },
        submitHandler: function (frm) {
            frm.preventDefault();
            var chkval  = $('#chkemail').val();
            if(chkval == 1) {
                var dataString =  $("#adduserfrm").serialize();
                var file_data = $("#ad_profileimg").prop("files")[0];
                dataString.append("file", file_data);
                chkemailexists();
                $.ajax({
                    url: 'useradd',
                    dataType: 'json',
                    type: 'post',
                    data: dataString,
                    success: function (data, textStatus, jQxhr) {
                        if(data.stat == 'ok'){
                            $("#adduserfrm").append('<div class="alert alert-success alert-dismissable">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                            '<h4>	<i class="icon fa fa-check"></i> Success!</h4>' +
                            data.msg + ' </div>');
                            $("#adduserfrm")[0].reset();
                            $( ".alert-success" ).fadeOut( 2000, "linear" );
                        } else {
                            $("#adduserfrm").append('<div class="alert alert-danger alert-dismissable">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                            '<h4>	<i class="icon fa fa-ban"></i> Failed!</h4>' +
                            data.msg + ' </div>');
                            $( ".alert-danger" ).fadeOut( 2000, "linear" );
                        }

                    },
                    error: function (jqXhr, textStatus, errorThrown) {
                        $("#adduserfrm").append(errorThrown);
                    }
                });
            }   else {
                $("#adduserfrm").prepend('<div class="alert alert-danger alert-dismissable">' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                '<h4>	<i class="icon fa fa-ban"></i> Failed!</h4> Email Already exists </div>');
                $(".alert-danger").fadeOut(2000, "linear");
            }
        }
    });


    $("#edituserfrm").validate({
        rules: {
            ad_username: {
                required: true,
                minlength: 6,
            },
            ad_firstname: "required",
            ad_lastname: "required",
            ad_email: {
                required: true,
                email: true
            },
            ad_pwd:{
                required: true,
                minlength: 5
            },
            ad_cpwd:{
                required: true,
                minlength: 5,
                equalTo: "#ad_pwd"
            },
            ad_designation: "required",
            ad_access_level: "required"

        },
        messages: {
            ad_username: {
                required: "Please enter Username",
                minlength: "User name must consist of at least 6 characters",
            },
            ad_firstname: "Please enter Firstname",
            ad_lastname: "Please enter Lastname",
            ad_email: "Please enter the valid Email Address",
            ad_pwd:{
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            ad_cpwd:{
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Please enter the same password as above"
            },
            ad_designation: "Please select the Designation",
            ad_access_level: "Please select the Access Level"

        },
        submitHandler: function (frm) {
            var chkval  = $('#chkemail').val();
            if(chkval == 1) {
                var dataString  =  $("#edituserfrm").serialize();
                var file_data = $("#ad_profileimg").prop("files")[0];
                dataString.append("file", file_data);
                var dataUrl     =  $("#url").val();
                $.ajax({
                    url: dataUrl,
                    dataType: 'json',
                    type: 'post',
                    data: dataString,
                    contentType: 'multipart/form-data',
                    cache: false,
                    success: function (data, textStatus, jQxhr) {
                        if(data.stat == 'ok'){
                            $("#edituserfrm").append('<div class="alert alert-success alert-dismissable">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                            '<h4>	<i class="icon fa fa-check"></i> Success!</h4>' +
                            data.msg + ' </div>');
                            $( ".alert-success" ).fadeOut( 2000, "linear" );
                        } else {
                            $("#edituserfrm").append('<div class="alert alert-danger alert-dismissable">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                            '<h4>	<i class="icon fa fa-ban"></i> Failed!</h4>' +
                            data.msg + ' </div>');
                            $( ".alert-danger" ).fadeOut( 2000, "linear" );
                        }

                    },
                    error: function (jqXhr, textStatus, errorThrown) {
                        $("#edituserfrm").append(errorThrown);
                    }
                });
            }   else {
                $("#edituserfrm").prepend('<div class="alert alert-danger alert-dismissable">' +
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                '<h4>	<i class="icon fa fa-ban"></i> Failed!</h4> Email Already exists </div>');
                $(".alert-danger").fadeOut(2000, "linear");
            }
        }
    });
});

function chkemailexists() {
    var usermail    = $('#ad_email').val();
    var userid      = $('#ad_userid').val();
    var chkurl      = $('#chkurl').val();
    var dataString  = "useremail="+usermail+"&userid="+userid;
    $.ajax({
        url: chkurl,
        dataType: 'json',
        type: 'post',
        data: dataString,
        success: function (data, textStatus, jQxhr) {
            if(data.stat == 'ok'){
                if($('#email-error'))   {
                    $('#email-error').remove();
                    $('#chkemail').val('1');
                }
            } else {
                $("#errormail").html('<label class="control-label" for="inputError" id="email-error"><i class="fa fa-times-circle-o"></i> '+ data.msg + '</label>');
                $('#chkemail').val('0');
                return false;
            }

        },
        error: function (jqXhr, textStatus, errorThrown) {
            $("#errormail").html(errorThrown); $('#chkemail').val('0');  return false;
        }
    });

}

function changestatus(userid, obj)   {
    var optstring   = "Activate";
    var dataString  = "ustat=1&userid="+userid;
    var changeclass = "fa fa-check-circle";
    if($(obj).attr('class') == 'fa fa-check-circle')    {
        optstring   = "De-Activate";
        dataString  = "ustat=0&userid="+userid;
        changeclass = "fa fa-circle-o";
    }   else changeclass = "fa fa-check-circle";
   var agree = confirm("Are you sure to "+ optstring +" this User?");
    if(agree)   {
        $.ajax({

            url: 'userstatuschange',
            dataType: 'json',
            type: 'post',
            data: dataString,

            success: function (data, textStatus, jQxhr) {
                if(data.stat == 'ok'){
                    alert("User "+ optstring +"d Successfully!");
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
