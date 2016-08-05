function filtersearch() {
    var filter_stato = $("#acstato").val();
    var dal_date = $("#ap_start_date").val();
    var al_date  = $("#ap_end_date").val();

    var dataString      = "filter_stato="+filter_stato+"&dal_date="+dal_date+"&al_date="+al_date;

        //if($('#ap_airport_sales').val() > 0) {
        //    dataString  += "&idairport="+$('#ap_airport_sales').val();
        //}

    $.ajax({
        url: 'filtercclist',
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




