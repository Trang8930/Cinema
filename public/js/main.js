//notify success messages
function notifySuccess($message) {
    $.notify({
        // options
        icon: 'glyphicon glyphicon-ok ',
        title: 'Successful <br>',
        message: $message,
        target: '_blank'
    }, {
        // settings
        element: 'body',
        position: null,
        type: "success",
        allow_dismiss: true,
        newest_on_top: false,
        showProgressbar: false,
        placement: {
            from: "top",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 3000,
        timer: 1000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',
        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}"  id="notify-success check-notify" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
    });
}

//notify failse messages
function notifyFailure($message) {
    $.notify({
        // options
        icon: 'glyphicon glyphicon-remove',
        title: 'Failure <br>',
        message: $message,
        target: '_blank'
    }, {
        // settings
        element: 'body',
        position: null,
        type: "danger",
        allow_dismiss: true,
        newest_on_top: false,
        showProgressbar: false,
        placement: {
            from: "top",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 3000,
        timer: 1000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',
        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}"  id="notify-failure check-notify" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
    });
}

//show pop-up delete and submit form
$('.btn-delete').click(function() {
    $form = $(this.form)
    $('#confirmModalDelete .modal-title').html($(this).attr('data-title'));
    $('#confirmModalDelete .modal-body p').html($(this).attr('data-content'));
    $('#confirmModalDelete .btn-confirm').click(function() {
        $form.submit();
    })
})

//handle image if change imge from local
$('#img-local').hide();

$('#image').change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#img-local').attr('src', e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
        $('#img-local').show();
        $('#img-db').hide();
    }
})

//stop display image when press reset
$('.btn-reset').click(function() {
    $('#img-local').attr('src', '').hide();
    $('#img-db').show();
    $('#img-local').hide();
});

//show notify after return crud
$check = $('#show-message').val();
if (typeof($check) !== 'undefined' && $check !== '') {
    $check = parseInt($check);
    switch ($check) {
        case 1:
            $('#notify-success').remove();
            notifySuccess('Create Successful');
            break;
        case 2:
            $('#notify-success').remove();
            notifySuccess('Update Successful');
            break;
        case 3:
            $('#notify-success').remove();
            notifySuccess('Delete Successful');
            break;
        case 4:
            $('#notify-success').remove();
            notifySuccess('Successful');
            break;
        default:
            $('#notify-failure').remove();
            notifyFailure('Action Failure');
            break;
    }

    //load page
    $(window).one().bind('load', function() {
        url = window.location.href;
        urlOld = url.split('?')[0];
        window.location.href = urlOld;
    })
    $check = undefined;
}

// $url = '';
// $('.video-js').mouseover(function(e) {
//     $url = $(this).attr('src');
//     $(this).attr('src', $url+'?autoplay=1')
// })

// $('.video-js').onmouseout(function(e) {
//     $(this).attr('src', $url)
// })
function limitDateRegister($param) {
    var $date = new Date($param.val())
    d = new Date()
    $month = parseInt(d.getMonth()) + 1

    if ($month < 10) {
        $month = '0' + $month
    }
    $day = d.getDate()
    if ($day < 10) {
        $day = '0' + $day
    }

    $to = d.getFullYear() + '-' + $month + '-' + $day
    $currentDay = new Date($to)
    if ($date > $currentDay) {
        $param.val($to)
    }
}

//datatable 
$(document).ready( function () {
    // $class = $('#table-datatable').attr('data-table')
    $('#table-datatable').DataTable({
        paging      : true,
        lengthChange: true,
        searching   : true,
        ordering    : true,
        autoWidth   : false
    });
} );
