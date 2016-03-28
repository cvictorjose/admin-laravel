/**
 * Created by php on 6/11/2015.
 */

$( document ).ready(function() {

    $("#addaproductfrm").validate({
        rules: {
            ap_product_code:                "required",
            ap_title:                       "required",
            ap_lang:                        "required",
            ap_web_desc:                    "required",
            ap_price_web_app:               "required",
            ap_price_airport:               "required",
            ap_airport_sales:               "required",
            ap_expiry_date:                 "required",
            ap_start_date:                  "required",
            ap_end_date:                    "required",
            ap_currency:                    "required",
            ap_terms:                       "required",
        },
        messages: {
            ap_product_code:                "Please Enter the Product Code",
            ap_title:                       "Please Enter the Title",
            ap_lang:                        "Please Select the Language",
            ap_web_desc:                    "Please Enter the Web Description",
            ap_price_web_app:               "Please Enter the Product Price",
            ap_price_airport:               "Please Enter the Airport Price",
            ap_airport_sales:               "Please Select the Airport Sales",
            ap_expiry_date:                 "Please Enter the Expiry Date",
            ap_start_date:                  "Please Enter the Start Date",
            ap_end_date:                    "Please Enter the End Date",
            ap_currency:                    "Please Enter the Currency",
            ap_terms:                       "Please Enter the Terms",

        },
        submitHandler: function () {
            var formData    = new FormData($(this)[0]);
            var submiturl   = $("#url").val();
            $.post(submiturl, formData, function(data) {//success
            });
            return false;
        }
    });

    $("#editaproductfrm").validate({
        rules: {
            ap_product_code:                "required",
            ap_item_code:                   "required",
            ap_priority:                    "required",
            ap_title:                       "required",
            ap_lang:                        "required",
            ap_web_desc:                    "required",
            ap_price_web_app:               "required",
            ap_price_airport:               "required",
            ap_airport_sales:               "required",
            ap_expiry_date:                 "required",
            ap_start_date:                  "required",
            ap_end_date:                    "required",
            ap_currency:                    "required",
            ap_id_airline:                  "required",
            ap_terms:                       "required",
        },
        messages: {
            ap_product_code:                "Please Enter the Product Code",
            ap_item_code:                   "Please Enter the Item Code",
            ap_priority:                    "Please Enter the Priority",
            ap_title:                       "Please Enter the Title",
            ap_lang:                        "Please Select the Language",
            ap_web_desc:                    "Please Enter the Web Description",
            ap_price_web_app:               "Please Enter the Product Price",
            ap_price_airport:               "Please Enter the Airport Price",
            ap_airport_sales:               "Please Select the Airport Sales",
            ap_expiry_date:                 "Please Enter the Expiry Date",
            ap_start_date:                  "Please Enter the Start Date",
            ap_end_date:                    "Please Enter the End Date",
            ap_currency:                    "Please Enter the Currency",
            ap_id_airline:                  "Please Select the Airline",
            ap_terms:                       "Please Enter the Terms",

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
    var agree = confirm("Are you sure to "+ optstring +" this Product - Booking?");
    if(agree)   {
        $.ajax({
            url: 'pricexairportstatuschange',
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
