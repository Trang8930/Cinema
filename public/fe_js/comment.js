$('.create-comment').keypress(function (e) {
    div_wrap = $("<div class='comments-section-grid'></div>")
   
    //image user
    img = $(this).attr("user-img")
    div_img = $("<div class='col-md-2 comments-section-grid-image'></div>")
    img_user_link = ''
    if (img == "no-image.png") {
        img_user_link = $('<img src="/'+ img +'" class="img-responsive"/>')
    } else {
        img_user_link = $('<img src="/'+ img +'" class="img-responsive"/>')
    }
    //content comment
    div_content = $('<div class="col-md-10 comments-section-grid-text"></div>')
    fullname = $(this).attr('fullname')
    h4 = $('<h4><a href="#">'+fullname+'</a></h4>')
    btn = $('<button type="button" class="pull-right comments-option"><span>...</span></button>')

    current_month = date.getMonth() + 1;
    current_date = date.getDate();
    current_year = date.getFullYear();
    $date = moment(current_year + '-' + current_month + '-' + current_date).format('DD/MM/YYYY');
    let dt = new Date();
    let time = dt.getHours() + ":" + dt.getMinutes();
    lable = $('<label>'+$date+' at '+time+'</label>')
    content = $('<p>'+$(this).val()+'</p>')

    clr = $('<div class="clearfix"></div>')
    //get id_film
    let url = window.location.href
    let filmID = url.split('videos/')[1];

    let userID = $(this).attr("user-id")

    if(e.keyCode == 13 && $('.create-comment').val().trim() != "") {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            url: '/comments',
            type: "POST",
            dataType: 'json',
            data: {
                content :$('.create-comment').val(),
                id_film: filmID,
                id_user: userID,
            },
            success : function ($result) {
                if ($result["code"] == 200) {
                    location.reload();
                    // div_img.append(img_user_link)
            
                    // div_content.append(h4)
                    // div_content.append(btn)
                    // div_content.append(lable)
                    // div_content.append(content)
                    
                    // div_wrap.append(div_img)
                    // div_wrap.append(div_content)
                    // div_wrap.append(clr)
                    // $(".comments-section-head-text h3").html($result["count"] + " Bình luận")
                    // $('#comment-section').append(div_wrap)
                }
            },
            error : function () {
                console.log("error")
            }
        });
        
        $('.create-comment').val("")
    }
})

$('.delete-comment').click(function () {
    $commentID = $(this).attr("data-id")
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        url: '/comments/' + $commentID,
        type: "DELETE",
        success : function ($result) {
            if ($result["code"] == 200) {
                // $('#delete-comment-' + $commentID).parent().parent().remove();
                location.reload();
            }
        },
        error : function () {
            console.log("error")
        }
    });
});

$('.edit-comment').click(function () {
    $commentID = $(this).attr("data-id");
    $('.div-comment-' + $commentID).remove();
    $content = $(this).attr("data-content");
    $div = $('<div class="blog-form div-comment-'+$commentID+'"><input type="text" class="update-comment" value="'+ $content +'" placeholder="Nhập bình luận"></div>');
    $('#comment-' + $commentID).remove();
    $(this).parent().append($div);

    $('.div-comment-' + $commentID + " input").keypress(function (e) {
        if(e.keyCode == 13) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                url: '/comments/' + $commentID,
                data: {
                    content: $(this).val()
                },
                type: "PUT",
                success : function ($result) {
                    if ($result["code"] == 200) {
                        location.reload();
                    }
                },
                error : function () {
                    console.log("error")
                }
            });
        }
    });
});
