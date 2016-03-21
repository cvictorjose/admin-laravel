

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





