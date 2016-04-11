
function filtercontent(){
    var filter_promocode     = $("#promocode").val();
    var dataString      = "filter_promocode="+filter_promocode;


    $.ajax({
        url: 'search_promocode',
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







