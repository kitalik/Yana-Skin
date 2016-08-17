jQuery(document).ready(function($){

  /*Init Owl Carousel*/
  $('.carousel').owlCarousel({
    loop: true,
    margin:26,
    nav:true,
    dots:false,
    autoplay: true,
    autoplayTimeout: 10000,
    autoplayHoverPause: true,
    //mouseDrag:false,
    responsive:{
      0:{
          items:1
      },
      450:{
          items:2
      },
      600:{
          items:3
      },
      1000:{
          items:4
      }
    }
  });

  /*Videos on Home Page*/
  $('.video-link').magnificPopup({type:'iframe'});

  /*----------------------------------------------------*/
  // Superslides
  /*----------------------------------------------------*/
  /*$('#slides').superslides({
    play: 7000,
    animation: 'fade',
    pagination: true
  });*/

});
