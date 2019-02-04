$(document).ready(function() { 
    var url = $("#resumesListID").val();
    $.ajax({
        url: url+"apply",
    })
    .done(function( data ) {
        $('#apply').html(data.html);
        var lastpage = $('#lastpageapply').val();
        
        if(lastpage > 1){
             $('#pagination-demo-apply').twbsPagination({
                 totalPages: lastpage,
                 visiblePages: 7,
                 onPageClick: function (event, page) {
                     var type = $('li.tab a.active').attr('data-type');
                     $.ajax({
                         url: url+type+"?page="+page,
                     })
                     .done(function( data ) {
                         $('#'+type).html(data.html);
                     });
                 }
             });
        }
    });
    $('.nav-tabs li').on('click',function(){
        var paginateApply = $('#pagination-demo-apply');
        var paginateFavorite = $('#pagination-demo-favorite');
        var paginateView = $('#pagination-demo-view');
        paginateApply.hide();
        paginateFavorite.hide();
        paginateView.hide();
        var tab = $(this);
        var type = tab.data('type');
        if(type == 'apply'){
            $('#pagination-demo-apply').show();
        }else if(type == 'favorite'){
            $('#pagination-demo-favorite').show();
        }else{
            $('#pagination-demo-view').show();
        }
        $.ajax({
            url: url+type,
        })
        .done(function( data ) {
            $('#'+type).html(data.html);
            var lastpage = $('#lastpage'+type).val();
            if(lastpage > 1){
                $('#pagination-demo-'+type).twbsPagination({
                    totalPages: lastpage,
                    visiblePages: 7,
                    onPageClick: function (event, page) {
                        $.ajax({
                            url: url+type+"?page="+page,
                        })
                        .done(function( data ) {
                            $('#'+type).html(data.html);
                        });
                    }
                });
            }else{
                $('#'+type).html('<h6 class="center" >-ไม่มีข้อมูล-</h6>');
            }
        });
    })
});

