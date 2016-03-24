

function filteracontent(){
    var filter_lang     = $("#aclang").val();
    var dataString      = "filter_lang="+filter_lang;
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




