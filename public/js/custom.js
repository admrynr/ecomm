
  $(function () {

    // MENU
    $('.nav-link').on('click',function(){
      $(".navbar-collapse").collapse('hide');
    });


    // AOS ANIMATION
    AOS.init({
      disable: 'mobile',
      duration: 800,
      anchorPlacement: 'center-bottom'
    });


    // SMOOTH SCROLL
    $(function() {
      $('.nav-link').on('click', function(event) {
        var $anchor = $(this);
          $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 0
          }, 1000);
            event.preventDefault();
      });
    });
    
    // HERO SLIDE
    $('.owl-banner').owlCarousel({
      loop: true,
      nav: true,
      dots: true,
      items: 1,
      autoplay: true,
      smartSpeed: 700,
      autoplayTimeout: 6000,
      responsive: {
          0: {
              items: 1,
              margin: 0
          },
          460: {
              items: 1,
              margin: 0
          },
          576: {
              items: 1,
              margin: 0
          },
          992: {
              items: 1,
              margin: 0
          }
      }
  });


    // PROJECT SLIDE
    $('#project-slide').owlCarousel({
      loop: true,
      center: true,
      autoplayHoverPause: false,
      autoplay: true,
      margin: 30,
      responsiveClass:true,
      responsive:{
          0:{
              items:1,
          },
          768:{
              items:2,
          }
      }
    });

  });


    

