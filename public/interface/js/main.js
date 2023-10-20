//loader
$(function() {
  $('.loader-container').fadeOut(2000);
})

// sidebar menu toggle
$(document).on('click', '#sidebar_toggler', function() {
  $('.sidebar-wrapper').addClass('sidebar-show');
   $('.mob-overlay').addClass('active');
   $('body').addClass('overflow__hidden');
});

$(document).on('click', '#burgerBtn', function() {
  $('.sidebar-wrapper').removeClass('sidebar-show');
  $('.mob-overlay').removeClass('active');
  $('body').removeClass('overflow__hidden');
});

$(document).on('click', '.mob-overlay', function() {
  $('.sidebar-wrapper').removeClass('sidebar-show');
  $('.mob-overlay').removeClass('active');
  $('body').removeClass('overflow__hidden');
});

// mobile menu toggle 
if ($(window).width() < 992) {
    $(document).on('click', '.nav-link .fa-plus', function(e) {
      e.preventDefault();
      $(this).parent().next('.dropdown__Firstmenu').slideToggle(500);
      console.log('one');
    });
}

// innovation select
$(document).ready(function() {
  $('select.nice-select').niceSelect();
});

// innovation menu toggle
$(document).on('click', '.open__menu', function() {
  $('#innovForm__card').slideToggle(500);
  $('.inovIcon_container').toggleClass('inovIcon_CoRelative');
});

$(document).on('click', '.inovIcon_conOverlay', function() {
  $('#innovForm__card').slideToggle(500);
  $('.inovIcon_container').toggleClass('inovIcon_CoRelative');
});



// products slider
$(function(){

  var is_rtl = $("html[lang='ar']").length > 0;

  $('.products__slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    nextArrow: '<button type="button" class="slick-next"><i class="fa-solid fa-caret-right"></i></button>',
		prevArrow: '<button type="button" class="slick-prev"><i class="fa-solid fa-caret-left"></i></button>',
    dots: false,
    rtl: is_rtl,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [{

      breakpoint: 992,
      settings: {
        slidesToShow: 2,
      }

    },
   {

      breakpoint: 576,
      settings: {
        slidesToShow: 1,
      }

    }
  ]
  });
});

// certificate lightbox Plugin 
$(function() {
  var gallery = $('a.certificate__card , a.prOiIMG__link').simpleLightbox({

  });
})

// scroll top button
$(function () {

  var scrollButton = $('.go-top');

  $(window).scroll(function () {

    if($(window).scrollTop() >= 500) {
      scrollButton.show();
    }else {
      scrollButton.hide();
    }

  });

  scrollButton.click(function () {
    $('html, body').animate({scrollTop: 0});
  })
});

