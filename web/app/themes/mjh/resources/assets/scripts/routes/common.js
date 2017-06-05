export default {
    init() {
        // JavaScript to be fired on all pages
        jQuery('#primary-nav-toggle').bind('click', function(event) {
            event.preventDefault();
            jQuery('.overlay-nav').fadeToggle();
            jQuery("html, body").animate({ scrollTop: 0 });
        })
        jQuery('#primary-nav-close').bind('click', function(event) {
            event.preventDefault();
            jQuery('.overlay-nav').fadeOut();
            jQuery('#menu-primary-navigation .open').removeClass('open').find('ul').hide();
        })
        jQuery('#menu-primary-navigation .menu-item-has-children > a').bind('click', function(event) {
            event.preventDefault();
            jQuery(this).parent().toggleClass('open').find('ul').slideToggle();

        })

        //init Gallery
        $('.gallery').slick({
            responsive: [{
                breakpoint: 576,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '0',
                    slidesToShow: 1,
                },
            }],
        });

        /*new Waypoint.Sticky({
          element: jQuery('.sticky')[0],
        })*/


        $(".animsition").animsition({
          inClass: 'fade-in',
          outClass: 'fade-out',
          inDuration: 1500,
          outDuration: 800,
          linkElement: '.animsition-link',
          // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
          loading: true,
          loadingParentElement: 'body', //animsition wrapper element
          loadingClass: 'animsition-loading',
          loadingInner: '', // e.g '<img src="loading.svg" />'
          timeout: false,
          timeoutCountdown: 5000,
          onLoadEvent: true,
          browser: [ 'animation-duration', '-webkit-animation-duration'],
          // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
          // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
          overlay : false,
          overlayClass : 'animsition-overlay-slide',
          overlayParentElement : 'body',
          transition: function(url){ window.location.href = url; },
        });

        /* Event listing form events */
        $( "#event-dates" ).change(function() {
          $( "#event-listing-form" ).submit();
        });
        $( "#event-category" ).change(function() {
          $( "#event-listing-form" ).submit();
        });
    },
    finalize() {
        // JavaScript to be fired on all pages, after page specific JS is fired
    },
};
