// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    directionNav: false,
    slideshow: true,
  });
});

/*
* Fixed menu
*/

jQuery("document").ready(function($){

    var nav = $('.site-header-main');
    var content = $('#content');

    $(window).scroll(function (){
        if ($(this).scrollTop() > 1) {
            nav.addClass("active");
            content.addClass("offset");

        } else {
            nav.removeClass("active");
            content.removeClass("offset");
        }
        if ($(this).scrollTop() > 300){
            nav.addClass("active_more");
        } else {
            nav.removeClass("active_more");
        }

    });
});
