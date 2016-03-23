$( document ).ready(function() {

    $("#addscontentfrm").validate({
        rules: {
            sc_title_en: "required",
            sc_contenten: "required",
        },
        messages: {
            sc_title_en: "Please enter Title in English",
            sc_contenten: "Please enter Content in English",

        },
        submitHandler: function () {
            var chkval  = $('#chktitle').val();
            if(chkval == 1) {
                var formData    = new FormData($(this)[0]);
                var submiturl   = $("#url").val();
                $.post(submiturl, formData, function(data) {//success
                });
            }   else {
                $("#addscontentfrm").append('<div class="alert alert-danger alert-dismissable">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  ' +
                    '<h4>	<i class="icon fa fa-ban"></i> Failed!</h4> Title Already exists </div>');
                $(".alert-danger").fadeOut(2000, "linear");
            }
            return false;
        }
    });


});

function filtercontent(){
    var filter_lang     = $("#sclang").val();
    var dataString      = "filter_lang="+filter_lang;
    $.ajax({
        url: 'filterservicecontentlist',
        dataType: 'html',
        type: 'post',
        data: dataString,
        success: function (data, textStatus, jQxhr) {
            $(".content").html(data);
            $("#example1").dataTable();
            return false;
        }
    });
}

function checksctitleexists() {
    var titleen     = $('#sc_title_en').val();
    var chkurl      = $('#chkurl').val();
    var dataString  = "titleen="+titleen;
    if($('#ad_scid'))
        if($('#ad_scid').val() > 0) {
            dataString  += "&scid="+$('#ad_scid').val();
        }   else dataString  += "&scid=";

    $.ajax({
        url: chkurl,
        dataType: 'json',
        type: 'post',
        data: dataString,
        success: function (data, textStatus, jQxhr) {
            if(data.stat == 'ok'){
                if($('#title-error'))   {
                    $('#title-error').remove();
                    $('#chktitle').val('1');
                }
            } else {
                $("#errortitle").html('<label class="control-label" for="inputError" id="title-error"><i class="fa fa-times-circle-o"></i> '+ data.msg + '</label>');
                $('#chktitle').val('0');    return false;
            }

        },
        error: function (jqXhr, textStatus, errorThrown) {
            $("#errortitle").html(errorThrown);  $('#chktitle').val('0');     return false;
        }
    });

}





