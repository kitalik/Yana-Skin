jQuery(function($) {
	$('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 156,
    itemMargin: 5,
    asNavFor: '#slider'
  });

  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carousel",
    start: function(slider){
      $('body').removeClass('loading');
    }
  });
});

jQuery(document).ready(function($){
/* ============== Anchor Slide Down ================= */
    $(document).ready(function(){ 
      $('a').click(function(){
        $('html, body').animate({
            scrollTop: $( $(this).attr('href') ).offset().top-150
        }, 500);
         return false;
      });
    });

    /* ============== Anchor Slide Down ================= */
});