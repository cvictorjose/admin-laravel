function filteracontent() {
    var filter_lang     = $("#aclang").val();
    var idairport     = $("#ap_airport_sales").val();
    var dataString      = "filter_lang="+filter_lang;

        if($('#ap_airport_sales').val() > 0) {
            dataString  += "&idairport="+$('#ap_airport_sales').val();
        }

    $.ajax({
        url: 'filterairportcontentlist',
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

function changeacontentstatus(acid, obj)   {
    var optstring   = "Activate";
    var dataString  = "acstat=1&acid="+acid;
    var changeclass = "fa fa-check-circle";
    if($(obj).attr('class') == 'fa fa-check-circle')    {
        optstring   = "De-Activate";
        dataString  = "acstat=0&acid="+acid;
        changeclass = "fa fa-circle-o";
    }   else changeclass = "fa fa-check-circle";
    var agree = confirm("Are you sure to "+ optstring +" this Airport Content?");
    if(agree)   {
        $.ajax({
            url: 'airportcontentstatuschange',
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




