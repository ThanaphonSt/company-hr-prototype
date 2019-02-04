$( document ).ready(function() {
    var url = $("#companyID").val();
    $.ajax({
        url: url,
    })
    .done(function( data ) {
        $('#job').html(data.html);
        var lastpage = $("#lastpage").val();
        if(lastpage > 1){
            $('#pagination-demo').twbsPagination({
                totalPages: lastpage,
                visiblePages: 7,
                onPageClick: function (event, page) {
                    var type = $('ul .active').attr('data-type');
                    $.ajax({
                        url: url+"?page="+page,
                    })
                    .done(function( data ) {
                        $('#job').html(data.html);
                    });
                }
            });
        }
    });
}); 