if ($('#city_id').val() == "1") {
    ajaxShowListCinema(1);
}

$('#city_id').change(function() {
    ajaxShowListCinema($(this).val());
})

//list seats
$('#btn-confirm-seat').click(function() {
    $('.table-seats tbody').html('')

    $seats = parseInt($('#seats_amount').val());
    if ($seats == 0) {
        return
    }
    if (!isNaN($seats)) {
        for ($i = 0; $i < $seats; $i++) {
            var $chr = String.fromCharCode(65 + $i);

            $select = $("<select name='" + $chr + "' class='select'></select>")
            $tr = $("<tr></tr>")
            $td1 = $("<td></td>")
            $td2 = $("<td></td>")
            $td1.html($chr)
            $tr.append($td1)
            for ($j = 1; $j <= 15; $j++) {
                $option = $('<option></option>')
                $option.val($j)
                $option.html($j)
                $select.append($option)
            }
            $td2.append($select)
            $tr.append($td2)
            $('.table-seats tbody').append($tr)
        }
    }
})

//ajax show list cinemas
function ajaxShowListCinema($cityId) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: $baseURL + '/admin/cinemas/' + $cityId + '/city',
        type: "GET",
        dataType: 'json',
        success: function($cinemas) {
            $('#cinema_id option').remove()
            for ($i = 0; $i < $cinemas['cinemas'].length; $i++) {
                $option = $('<option></option>')
                $option.attr('value', $cinemas['cinemas'][$i]['id'])
                $option.html($cinemas['cinemas'][$i]['name'])
                $('#cinema_id').append($option)
            }
        },
    });
}