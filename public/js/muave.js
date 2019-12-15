$("li.item-phim").click(function() {
    var idphim = $(this).attr('id');
    $("li.item-phim").removeClass("active");
    $(this).addClass('active');
    //console.log(idphim);
    $.get("ajax/rap/"+idphim,function(data){
        $("#dsrap").html(data);
    });
});


$(document).on('click', 'li.item-rap', function() {
    var idPhim = $('#idPhim').attr('idphim');
    var idRap = $(this).attr('idrap');
    $("li.item-rap").removeClass("active");
    $(this).addClass('active');
    $.get("ajax/xem-phong/"+idPhim+'/'+idRap, function(data) {
        $("#dssuat").html(data);
    });
});