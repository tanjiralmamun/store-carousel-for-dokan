var jq = jQuery.noConflict();

jq( document ).ready(function() {

  jq( '.flexslider' ).flexslider({
    animation: "slide",
    animationLoop: false,
    itemWidth: 390,
    itemMargin: 5,
    controlNav: false,
    prevText: '',
    nextText: ''
  });

});