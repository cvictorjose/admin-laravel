/**
 * Created by php on 6/11/2015.
 */

$( document ).ready(function() {

    $("#addaproductfrm").validate({
        rules: {
            ap_product_code:                "required",
            ap_priority:                    "required",
            ap_title:                       "required",
            ap_lang:                        "required",
            ap_web_desc:                    "required",
            ap_airport_sales:               "required",

        },
        messages: {
            ap_product_code:                "Please Enter the Product Code",
            ap_priority:                    "Please Enter the Priority",
            ap_title:                       "Please Enter the Title",
            ap_lang:                        "Please Select the Language",
            ap_web_desc:                    "Please Enter the Web Description",
            ap_airport_sales:               "Please Select the Airport Sales",


        },
        submitHandler: function () {
            var formData    = new FormData($(this)[0]);
            var submiturl   = $("#url").val();
            $.post(submiturl, formData, function(data) {//success
            });
            return false;
        }
    });



});


function changeairproductstatus(apid, obj)   {
    var optstring   = "Activate";
    var dataString  = "apstat=1&apid="+apid;
    var changeclass = "fa fa-check-circle";
    if($(obj).attr('class') == 'fa fa-check-circle')    {
        optstring   = "De-Activate";
        dataString  = "apstat=0&apid="+apid;
        changeclass = "fa fa-circle-o";
    }   else changeclass = "fa fa-check-circle";
    var agree = confirm("Are you sure to "+ optstring +" this Airport Product?");
    if(agree)   {
        $.ajax({
            url: 'airportproductstatuschange',
            dataType: 'json',
            type: 'post',
            data: dataString,
            success: function (data, textStatus, jQxhr) {
                if(data.stat == 'ok'){
                    alert("Airport Content "+ optstring +"d Successfully!");
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
