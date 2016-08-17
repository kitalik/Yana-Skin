jQuery(document).ready(function($){

  /* ============== Responsive Menu ================= */
  $('nav#menu').mmenu();
  /* ============== Responsive Menu End ============= */

  /* ============== Superfish Menu ================= */
  $('#nav ul.menu').superfish({
       
    // 0.2 second delay on mouseout
    delay: 600,
     
    // fade-in and slide-down animation
    animation: {opacity:'show',height:'show'},
     
    // enable drop shadows
    dropShadows: true,
     
    // Dropdown our menu slowly
    speed: 'fast',
    disableHI: true
  });
  //$('a.sf-with-ul').append('<i class="fa fa-angle-down"></i>');

  /* ============== Superfish Menu End ============= */

  if(!device.mobile() && !device.tablet()){
      $.srSmoothscroll({
          step:150,
          speed:800
      });
      // Forbid click event for phone links
      $('a[href^="callto:"]').on('click', function (e) {
        e.preventDefault();
      });    
  }

    /* ============== Fixed Elements ================= */
    $(window).scroll(function () {
        if (document.body.clientWidth > 1000 ){
            if ($(this).scrollTop() > 80) {
                $('.site-header').addClass('fixed');
            } 
            else if ($(this).scrollTop() <= 80) {
                $('.site-header').removeClass('fixed');
            }
        }
    });

  $(window).load(function () {
    $('body').addClass('loaded');  
   });
});



