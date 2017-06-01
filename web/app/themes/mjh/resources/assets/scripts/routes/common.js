export default {
  init() {
    // JavaScript to be fired on all pages
    jQuery('#primary-nav-toggle').bind('click',function(event){
       event.preventDefault(); 
       jQuery('.overlay-nav').fadeToggle();
       jQuery("html, body").animate({ scrollTop: 0 });
    })
    jQuery('#primary-nav-close').bind('click',function(event){
       event.preventDefault(); 
       jQuery('.overlay-nav').fadeOut();
       jQuery('#menu-primary-navigation .open').removeClass('open').find('ul').hide();
    })
    jQuery('#menu-primary-navigation .menu-item-has-children > a').bind('click', function(event){ 
      event.preventDefault(); 
      jQuery(this).parent().toggleClass('open').find('ul').slideToggle();
      
    })

    /*new Waypoint.Sticky({
      element: jQuery('.sticky')[0],
    })*/
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
