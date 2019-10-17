$(document).on('click', function (e) {
  var target = $(e.target).closest(".btn-select");
  if (!target.length) {
    $(".btn-select").removeClass("active").find("ul").hide();
  }
});

//Login
$(document).ready(function () {

  $("#loginLink").click(function (event) {
    event.preventDefault();
    $("#login-modal").modal("show");
    $('.nav-tabs a[href="#tab_login_1"]').tab('show');
    $("#forgetpass-modal").modal("hide");
    $("#success-modal").modal("hide");
  });

  $("#forgetPass").click(function (event) {
    event.preventDefault();
    $("#login-modal").modal("hide");
    $("#forgetpass-modal").modal("show");
    $("#success-modal").modal("hide");
  });


  $("#loginLinkMobile").click(function (event) {
    event.preventDefault();
    $("#login-modal").modal("show");
  });

  // $("#loginBuyticket").click(function (event) {
  //   event.preventDefault();
  //   $("#login-buyticket-modal").fadeToggle("fast");
  // });
  // $("#forgetPassBuyticket").click(function (event) {
  //   event.preventDefault();
  //   $("#login-buyticket-modal").fadeToggle("fast");
  //   setTimeout(function () {
  //     $("#forgetpass-modal").fadeToggle("fast");
  //   });
  // });

  // $("#login-modal .close").click(function () {
  //   $("#login-modal").fadeToggle("fast");
  // });

  // $("#forgetpass-modal .close").click(function () {
  //   $("#forgetpass-modal").fadeToggle("fast");
  //   $("#forgetpass-modal").modal("hide");
  // });

  $("#active-modal .close").click(function () {
    $("#active-modal").fadeToggle("fast");
    $("#active-modal").modal("hide");
  });

  $("#login-buyticket-modal .close").click(function () {
    $("#login-buyticket-modal").fadeToggle("fast");
  });

  $("#locationLink").click(function (event) {
    event.preventDefault();
    $("#location-modal").fadeToggle("fast");
  });

  $("#locationLinkMobile").click(function (event) {
    event.preventDefault();
    $("#location-modal").fadeToggle("fast");
  });

  $("#location-modal .close").click(function () {
    $("#location-modal").fadeToggle("fast");
  });
});

//Calendar
// $( document ).ready(function() {
//   $('.datepicker').datepicker('setDate', 'now');
// });

$(document).ready(function () {
  function toggleIcon(e) {
    $(e.target)
      .prev('.panel-heading')
      .find(".more-less")
      .toggleClass('glyphicon-plus glyphicon-minus');
  }

  $('.panel-group').on('hidden.bs.collapse', toggleIcon);
  $('.panel-group').on('shown.bs.collapse', toggleIcon);
});

$(document).ready(function () {
  var idIntervalSearchHeader = null;
  $('a[href="#tab_images"]').one('shown.bs.tab', function (e) {
    $('.slider-images').bxSlider({
      minSlides: 2,
      maxSlides: 4,
      slideMargin: 10,
      slideWidth: 180,
      controls: true,
      infiniteLoop: false,
      pager: false,
      hideControlOnEnd: true
    });
  });

  $('.slider-images-actors').bxSlider({
    minSlides: 2,
    maxSlides: 4,
    slideMargin: 10,
    slideWidth: 180,
    controls: true,
    infiniteLoop: false,
    pager: false,
    hideControlOnEnd: true
  });

  $('#btn-search-header').on('keyup', function (evt) {
    // var val = $(this).val();
    // if(idIntervalSearchHeader) clearInterval(idIntervalSearchHeader);
    // idIntervalSearchHeader = setTimeout(function ()
    // {
    //   if(val.length>3)
    //   {
    //     $('#search-list').slideDown(100);
    //   }else{
    //     $('#search-list').slideUp(100);
    //   }
    //   clearInterval(idIntervalSearchHeader);
    // },100);
  });

  $('#changepass').change(function () {
    // console.log($(this));
    if ($(this).is(":checked")) {
      // $('.box-changepass').fadeIn('slow');
      $('#box-changepass').fadeIn('slow');
    }
    else
      $('#box-changepass').fadeOut('slow');

  });

  $('[data-toggle="tooltip"]').tooltip()

});


$(document).ready(function() {
  setTimeout(function () {
    if($('.slider-images-actors'))
    {
      $('.slider-images-actors').bxSlider({
        minSlides: 1,
        maxSlides: 4,
        slideMargin: 10,
        // slideWidth: 180,
        controls: true,
        infiniteLoop: false,
        pager: true,
        hideControlOnEnd: false
      });
    }
  },1);
});



$(document).ready(function () {
  $('#list').click(function (event) {
    event.preventDefault();
    $('#products .item').addClass('list-group-item');
  });
  $('#grid').click(function (event) {
    event.preventDefault();
    $('#products .item').removeClass('list-group-item');
    $('#products .item').addClass('grid-group-item');
  });


$(document).ready(function() {
  if($(".carousel-inner") && typeof ($(".carousel-inner").swiperight) =='function'){
    $(".carousel-inner").swiperight(function() {
      $(this).parent().carousel('prev');
    });
    $(".carousel-inner").swipeleft(function() {
      $(this).parent().carousel('next');
    });
  }
});

  /***************** Responsive Nav ******************/

  $('.nav-toggle').click(function () {
    $(this).toggleClass('active');
    $('.navicon').toggleClass('fixed-mobile');
    $('.galaxy-nav').toggleClass('open');
    event.preventDefault();
  });
  // $('.galaxy-nav li a').click(function () {
  //   $('.nav-toggle').toggleClass('active');
  //   $('.navicon').toggleClass('fixed');
  //   $('.galaxy-nav').toggleClass('open');
  // });
});


