/**
 * Created by php on 6/11/2015.
 */




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
