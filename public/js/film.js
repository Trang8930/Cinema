$('.btn-change-active').click(function () {
    //add value into pop-up confirm
    $('#changeActiveModal .modal-title').html($(this).attr('data-title'));
    $('#changeActiveModal .modal-body p').html($(this).attr('data-content'));
    
    $idFilm = $(this).attr('data-id');
    $id = $(this).attr('id');
    $action = $(this).attr('data-action');
    
    $('#changeActiveModal .btn-confirm ').off().on().click(function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            url: $baseURL+'/admin/films/'+$idFilm+'/updateActive',
            type: 'PUT',
            dataType: 'json',
            success : function ($result){ 
                if ($result['is_active'] == 1) {
                    $('#' + $id).attr('class', 'btn-change-active btn btn-warning')   
                    $('#' + $id).html('Active');   
                } else {
                    $('#' + $id).attr('class', 'btn-change-active btn btn-default')   
                    $('#' + $id).html('Not');
                }
                $('#notify-success').remove();
                notifySuccess('Update Successful');
            },
            errors: function () {
                $('#notify-failure').remove();
                notifyFailure('Update Failure');
            }
        });
    });
    
});
$("#import-btn").click(function () {
    $("#importFile .modal-title").html($(this).attr("data-title"));   
    $("#importFile .modal-body").html($(this).attr("data-content"));
});
$("#importFile .btn-confirm").click(function(){
    $("#import-film").submit()
});
