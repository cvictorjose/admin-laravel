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




