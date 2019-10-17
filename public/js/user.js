$('.btn-change-admin').click(function () {
    //add value into pop-up confirm
    $('#confirmModal .modal-title').html($(this).attr('data-title'));
    $('#confirmModal .modal-body p').html($(this).attr('data-content'));
    
    $token = $(this).attr('data-token');
    $id = $(this).attr('id');
    $action = $(this).attr('data-action');

    $('#confirmModal .btn-confirm ').click(function () {
        if($(this).attr('data-status') == 'true') {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                url: $baseURL+'/admin/users/'+$token+'/'+$action,
                type: 'post',
                dataType: 'json',
                success : function ($result){ 
                    if ($result['role'] == 1) {
                        $('#' + $id).attr('class', 'btn-change-admin btn btn-success')
                        $('#' + $id).prop('disabled', true);
                        
                        $('#' + $id).parent().prev().children().children().prop('disabled', true);

                        $('#' + $id).parent().next().find('form').find('button').prop('disabled', true);
                        $('#' + $id).parent().next().find('form').find('button').attr('class', 'glyphicon glyphicon-remove bg-gray option btn-delete')
                        $('#' + $id).html('Admin');
                    } else {
                        $('#' + $id).attr('class', 'btn-change-admin btn btn-danger')   
                        $('#' + $id).html('User');
                    }

                    $('#notify-success').remove();
                    notifySuccess('Update Successful');
                },
                errors: function () {
                    $('#notify-failure').remove();
                    notifyFailure('Update Failure');
                }
            });
        }
    });
});

$('.btn-change-active').click(function () {
    
    $token = $(this).attr('data-token');
    $id = $(this).attr('id');
    $action = $(this).attr('data-action');
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: $baseURL+'/admin/users/'+$token+'/'+$action,
        type: 'post',
        dataType: 'json',
        success : function ($result){ 
            if ($action == "updateActive") {
                if ($result['is_active'] == 1) {
                    $('#' + $id).attr('class', 'btn-change-active btn btn-warning')   
                    $('#' + $id).html('Active');   
                } else {
                    $('#' + $id).attr('class', 'btn-change-active btn btn-default')   
                    $('#' + $id).html('Not');
                }
                
                $('#notify-success').remove();
                notifySuccess('Update Successful');
            }
        },
        errors: function () {
            $('#notify-failure').remove();
            notifyFailure('Update Failure');
        }
    });
});


