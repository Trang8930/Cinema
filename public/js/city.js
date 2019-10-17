//create city
$("#createCity").click(function () {
    $('.modal-body').attr('class', 'modal-body form-group has-feedback')
    $('.modal-body .text-danger').html('')
    name = $('#nameCity').val()
    if (name != null && name != '' ) {
        $('#createCityModal form').submit()
    } else {
        $('.modal-body').attr('class', 'modal-body form-group has-feedback has-error')
        $('.modal-body .text-danger').html('The name field is required.')
    }
})

//update city
name = null
id = null
$('.update-city').click(function(){
    $('#nameCityUpdate').attr('value', '')
    $('.modal-body').attr('class', 'modal-body form-group has-feedback')
    $('.modal-body .text-danger').html('')
    name = $(this).attr('data-name')
    id = $(this).attr('data-id')
    $('#nameCityUpdate').attr('value', name)
    $('#nameCityUpdate').val(name)
    console.log(name)
})

$('#nameCityUpdate').keyup(function() {
    name = $('#nameCityUpdate').val()
})
$("#updateCity").click(function () {
    if (name != null && name != '' ) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            url: $baseURL+'/admin/cities/'+id,
            type: "PUT",
            dataType: 'json',
            data: {'name': name},
            success : function ($result) {
                if($result == 200) {
                    $('#notify-success').remove();
                    notifySuccess('Update Successful');
                    $('#name-city-'+id).html(name)
                }
            },
            error : function () {
                $('#notify-failure').remove();
                notifyFailure('Failure');
            }
        });    
        $('#updateCityModal').modal('hide');
    } else {
        $('.modal-body').attr('class', 'modal-body form-group has-feedback has-error')
        $('.modal-body .text-danger').html('The name field is required.')
    }
})
