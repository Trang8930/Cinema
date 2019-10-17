$count = 0
$start = []
$end = []

//change cinema
$("#cinema_id").change(function(){
    // change list of rooms
    $cinemaID = $(this).val()
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: $baseURL + '/admin/rooms/' + $cinemaID + '/listRoom',
        type: "GET",
        dataType: 'json',
        success: function($rooms) {
            $('#room_id option').remove()
            for ($i = 0; $i < $rooms['rooms'].length; $i++) {
                $option = $('<option></option>')
                $option.attr('value', $rooms['rooms'][$i]['id'])
                $option.html($rooms['rooms'][$i]['name'])
                $('#room_id').append($option)
            }
        },
        error: function() {
            console.log($baseURL + '/admin/rooms/' + $cinemaID + '/listRoom')
            console.log("fail")
        }
    });
    //change room
    $('#room_id').change(function() {
        $('#time_start').val("")
        $('#time_start').prop('disabled', true);
        $('#time_finish').html('0')

        if ($('#date-schedule').val() != '') {
            $('#time_start').removeAttr('disabled')
        }

        $('#date-schedule').attr('data-room', $(this).val())
        if ($('#date-schedule').val() != '') {
            ajaxUpdateSchedule($('#date-schedule').val(), $('#date-schedule').attr('data-room'))
            if ($('#time_start').val() != '') {
                $from = $('#time_start').val().split(':')

                $from = (parseInt($from[0]) - 8) * 60 + parseInt($from[1])
                $to = $from + parseInt($('#time_limit').html().split(' '))

                setTimeFinish($from, $to)

                addSchedule($from, $to)
            }
        }
    });
});

// disabled time_start if date not choose
if ($('#date-schedule').val() == '') {
    $('#time_start').attr('disabled', 'disabled')
} else {
    $('#time_start').removeAttr('disabled')
    ajaxUpdateSchedule($('#date-schedule').val(), $('#date-schedule').attr('data-room'))
}

// change date 
$('#date-schedule').change(function() {
    $('#time_start').removeAttr('disabled')
    ajaxUpdateSchedule($(this).val(), $(this).attr('data-room'))

});

//change film
$('#film_id').change(function() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: $baseURL + '/admin/films/' + $(this).val() + '/getData',
        type: "GET",
        dataType: 'json',
        success: function($result) {
            $('#time_limit').html($result['time_limit'] + ' minutes')
            if ($('#time_start').val() != '') {
                $from = $('#time_start').val().split(':')

                $from = (parseInt($from[0]) - 8) * 60 + parseInt($from[1])
                $to = $from + parseInt($('#time_limit').html().split(' '))

                setTimeFinish($from, $to)

                addSchedule($from, $to)
            }

            if ($result['image'] == null) {
                $url = "/no-image.jpg"
            } else {
                $url = "/fe_images/" + $result['image']
            }

            $('.img-schedule').attr('src', $url)

        },
        error: function() {
            $('#notify-failure').remove();
            notifyFailure('Failure');
        }
    });
})

//input and validator time_start
$('#time_start').keyup(function() {
    if ($(this).val().length == 5 && $(this).val()[2].includes(":")) {
        $('#error-time-start').html('')
        $from = $(this).val().split(':')
        if (typeof(parseInt($from[0])) != NaN && typeof(parseInt($from[1])) != NaN) {
            if ((parseInt($from[0]) - 8) >= 0 && parseInt($from[0]) <= 24 && parseInt($from[1]) < 60 && parseInt($from[1]) >= 0) {

                //set time_finish
                $from = (parseInt($from[0]) - 8) * 60 + parseInt($from[1])
                $to = $from + parseInt($('#time_limit').html().split(' '))

                setTimeFinish($from, $to)

                addSchedule($from, $to)

            } else {
                $('#error-time-start').html('Please enter hour start from 8h and minute between 0 and 60')
            }
        } else {
            $('#error-time-start').html('Please enter the correct format')
        }

    } else {
        $('#error-time-start').html('Please enter the correct format')
    }
})

//ajax update schedule
function ajaxUpdateSchedule($date, $roomId) {
    $('.timeline-schedule div').remove()
    $start = [];
    $end = [];
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: $baseURL + '/admin/schedules/' + $date + '/' + $roomId + '/updateSchedule',
        type: "PUT",
        dataType: 'json',
        success: function($result) {
            $count = $result.length
            for ($i = 0; $i < $result.length; $i++) {
                $start[$i] = $result[$i]['time_start']
                $end[$i] = $result[$i]['time_finish']

                $from = $result[$i]['time_start'].split(':')
                $from = ($from[0] - 8) * 60 + parseInt($from[1])
                $to = $result[$i]['time_finish'].split(':')
                $to = ($to[0] - 8) * 60 + parseInt($to[1])

                $width = ($to - $from) / 9
                $left = $from / 9

                $div = $('<div></div>')
                $('.timeline-schedule').append($div)
                $div.attr('class', 'sub-time-' + ($i + 1))
                $div.css('background-color', 'green')
                $div.css('position', 'absolute')
                $div.css('height', '100%')
                $div.css('width', $width + '%')
                $div.css('left', $left + '%')
                $('.timeline-schedule div').append($div)
            }
        },
        error: function() {
            $('#notify-failure').remove();
            notifyFailure('Failure');
        }
    });
}

// change background-color if time duplicates
function changeBackground($timeStart, $timeEnd, $div) {
    if ($('time_start').attr('data-method') == undefined) {
        $div.css('background-color', 'blue')
    } else {
        if ($start.length == 0) {
            $div.css('background-color', 'blue')
        } else if ($start.length == 1) {
            $finish = (parseInt($end[0].split(':')[0]) - 8) * 60 + parseInt($end[0].split(':')[1])
            $begin = (parseInt($start[0].split(':')[0]) - 8) * 60 + parseInt($start[0].split(':')[1])
            if ($timeStart > 0 && ($timeEnd + 15) <= $begin || $timeStart > ($finish + 15) && $timeEnd <= 900) {
                $('.btn-submit').removeAttr('disabled');
                $div.css('background-color', 'blue')
            } else {
                $div.css('background-color', 'red')
                $('.btn-submit').prop('disabled', true);
            }
        }
    }
}

// add new schedule
function addSchedule($from, $to) {
    $i = 0
    if ($('.timeline-schedule').children().last().attr('class') != undefined) {
        $i = parseInt($('.timeline-schedule').children().last().attr('class').split('-')[2])
    }
    if ($i == $count) {
        if ($('time_start').attr('data-method') == undefined) {
            $('.sub-time-' + ($i)).remove();
        } else {
            $('.sub-time-' + ($i + 1)).remove();
        }
    } else {
        $('.sub-time-' + $i).remove();
    }

    $width = ($to - $from) / 9
    $left = $from / 9

    $div = $('<div></div>')
    $div.attr('class', 'sub-time-' + ($i + 1))
    changeBackground($from, $to, $div)
    $('.timeline-schedule').append($div)
    $('.sub-time-' + ($i + 1)).css('position', 'absolute')
    $('.sub-time-' + ($i + 1)).css('height', '100%')
    $('.sub-time-' + ($i + 1)).css('width', $width + '%')
    $('.sub-time-' + ($i + 1)).css('left', $left + '%')
}

function setTimeFinish($from, $to) {
    $hour = Math.floor($to / 60) + 8
    $minute = $to % 60
    if ($minute < 10) {
        $minute = '0' + $minute
    }
    $('#time_finish').html($hour + ":" + $minute)
    $time = $('#time_finish').html()
    $('#time_finish_rq').val($time)
}