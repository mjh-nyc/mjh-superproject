export default {
    init() {
        // JavaScript to be fired on all pages
        jQuery('#primary-nav-toggle').bind('click', function(event) {
            event.preventDefault();
            jQuery(this).toggleClass('open');
            jQuery('.overlay-nav').css({ 'height': jQuery(document).height() }).fadeToggle();
            jQuery("html, body").animate({ scrollTop: 0 });
        })
        jQuery('#primary-nav-close').bind('click', function(event) {
            event.preventDefault();
            jQuery('.overlay-nav').fadeOut();
            jQuery('#primary-nav-toggle').removeClass('open');
            jQuery('#menu-primary-navigation .open').removeClass('open').find('ul').hide();
        })
        jQuery('#menu-primary-navigation .menu-item-has-children > a').bind('click', function(event) {
            event.preventDefault();
            jQuery(this).parent().toggleClass('open').find('ul').slideToggle();
            //adjust overlay height
            //becuase we're animating the navigation items down, we have to wait for the animation to complete
            setTimeout(function () {
                jQuery('.overlay-nav').css({ 'height': jQuery(document).height() });
            }, 1000);

        })
        //automatically expand parent if we're on a subpage
        jQuery('#menu-primary-navigation .current-menu-parent').toggleClass('open').find('ul').slideToggle();

        //init Gallery
        var mjh_gallery = jQuery('.mjh-gallery');
        if (mjh_gallery.length) {
          mjh_gallery.slick({
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
        }
        //set the width of the mjh-slider content using the 4:6 ratio
        //first get width of the container
        var set_mjh_slider_width = function() {
          var content_col_width = jQuery('.entry-content, .page-content').width();
          var mjh_slider_height = content_col_width * (4/6);
          jQuery('.mjh-gallery .slide-image').css('height', mjh_slider_height);
        };
        var didResize = false;
        jQuery(window).resize(function() {
          didResize = true;
         });
         
         setInterval(function() {  
          if(didResize) {
            didResize = false;
            set_mjh_slider_width();
          }
         }, 250);
         //set on load too
         set_mjh_slider_width();

         //wrap video embeds with elastic container to make them responsive
         jQuery('.entry-content, .page-content').find( "iframe, object, embed" ).wrap( "<div class='video-container'></div>" );


        //init sticky header
      var Waypoint = window.Waypoint;
       var sticky = new Waypoint.Sticky({
          element: jQuery('.sticky')[0],
        })
       sticky.options.enabled = true;




        jQuery(".animsition").animsition({
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
            browser: ['animation-duration', '-webkit-animation-duration'],
            // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
            // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
            overlay: false,
            overlayClass: 'animsition-overlay-slide',
            overlayParentElement: 'body',
            transition: function(url) { window.location.href = url; },
        }).one('animsition.inStart', function(){
          jQuery(".parallax-mirror").fadeIn("slow");
        });

        /* Event listing form events */
        jQuery("#event-dates").change(function() {
            jQuery("#event-listing-form").submit();
        });
        jQuery("#event-category").change(function() {
            jQuery("#event-listing-form").submit();
        });
        jQuery("#publication-category").change(function() {
            jQuery("#publication-listing-form").submit();
        });

        //testimony card more link trigger
        jQuery(".testimony-card .more").on( "click", function(event) {
            event.preventDefault();
            var $link = jQuery(this).find( "i" ).attr('data-link');
            window.location = $link;
        });
    },
    finalize() {
        // JavaScript to be fired on all pages, after page specific JS is fired

    },
};