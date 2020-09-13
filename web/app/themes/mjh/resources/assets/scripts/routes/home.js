import ScrollMagic from 'scrollmagic/scrollmagic/minified/ScrollMagic.min';
export default {
    init() {
      // JavaScript to be fired on the home page
      // For the exhibition featured sliders
      function sliderFeatured() {
        jQuery('.slider-for').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          draggable: false,
          asNavFor: '.slider-nav',
        });

        var $sliderNav = jQuery('.slider-nav');
        $sliderNav.slick({
          slidesToShow: 3,
          centerPadding: '0',
          slidesToScroll: 3,
          asNavFor: '.slider-for',
          arrows: true,
          speed: 900,
          autoplaySpeed: 5000,
          autoplay: true,
          centerMode: true,
          pauseOnHover: true,
          lazyLoad: 'ondemand',
          responsive: [{
            breakpoint: 768,
            settings: {
              centerMode: true,
              centerPadding: '150',
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
            {
              breakpoint: 576,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '0',
                slidesToShow: 1,
                slidesToScroll: 1,
              },
            },
          ],
        });

        //https://github.com/kenwheeler/slick/issues/248
        $sliderNav.on('lazyLoaded', function (e, slick, image, imageSource) {
          image.parent().css('opacity','0');
          image.parent().css('background-image', 'url("' + imageSource + '")');
          image.parent().fadeTo( 'slow', 1 );
          image.hide();
        });

        // there are less then 4 slides, create a rollover that highlights and loads the bg above
        $sliderNav.on('mouseenter', '.slick-slide', function (e) {
          var $currTarget = $(e.currentTarget),
            index = $currTarget.data('slick-index'),
            slickObj = $('.slider-for').slick('getSlick');
          if (slickObj.slideCount < 4) {
            slickObj.slickGoTo(index);
          }

        });
        //update the header title based on slide loaded
        var header_container = jQuery('.onview .header');
        var curr_header = jQuery('.exhibtion-card.slick-center').attr('data-header');
        $sliderNav.on('afterChange', function () {
          // let's do this after changing slides
          //get the value of the data-header attr of the current slide\
          var new_header = jQuery('.exhibtion-card.slick-center').attr('data-header');
          if (curr_header != new_header) {
            header_container.css('display', 'none');
            header_container.text(new_header);
            header_container.fadeIn('slow');
            curr_header = new_header;
          }
        });
      }
      // For the post sliders
      function sliderPosts() {
        //Blog and press
        var $sliderPosts = jQuery('.slider-posts');
        $sliderPosts.slick({
          dots: false,
          pauseOnHover: true,
          infinite: false,
          slidesToShow: 3,
          slidesToScroll: 3,
          lazyLoad: 'ondemand',
          responsive: [
            {
              breakpoint: 768,
              settings: {
                arrows: false,
                slidesToShow: 2,
                slidesToScroll: 2,
              },
            },
            {
              breakpoint: 576,
              settings: {
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1,
              },
            },
          ],
        });
        //https://github.com/kenwheeler/slick/issues/248
        $sliderPosts.on('lazyLoaded', function (e, slick, image, imageSource) {
          image.parent().css('opacity','0');
          image.parent().css('background-image', 'url("' + imageSource + '")');
          image.parent().fadeTo( 'slow', 1 );
          image.hide();
        });
      }
      // For the custom sliders
      function customSlider(elementId) {
        //Custom slider
        var $sliderCustom = jQuery('#'+elementId);
        $sliderCustom.slick({
          slidesToShow: 3,
          centerPadding: '0',
          slidesToScroll: 3,
          arrows: true,
          speed: 900,
          autoplaySpeed: 5000,
          autoplay: true,
          centerMode: true,
          pauseOnHover: true,
          lazyLoad: 'ondemand',
          responsive: [{
            breakpoint: 768,
            settings: {
              centerMode: true,
              centerPadding: '150',
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
            {
              breakpoint: 576,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '0',
                slidesToShow: 1,
                slidesToScroll: 1,
              },
            },
          ],
        });

        //https://github.com/kenwheeler/slick/issues/248
        $sliderCustom.on('lazyLoaded', function (e, slick, image, imageSource) {
          image.parent().css('opacity','0');
          image.parent().css('background-image', 'url("' + imageSource + '")');
          image.parent().fadeTo( 'slow', 1 );
          image.hide();
        });
        //var totalCustomSlides = $sliderCustom.slick('getSlick').slideCount;
        //console.log(totalCustomSlides);
        /*if(totalCustomSlides < 4) {
            $sliderCustom.css('padding-bottom','0');
        }*/
      }
        //for all sliders, choose desktop or mobile version of image
        //first swap out data-lazy value if it's a mobile device
        if (jQuery( window ).width() < 768) {
          jQuery('.mjh-slider img').each(function () {
            var mobilesrc = jQuery(this).attr('data-mobilesrc');
            jQuery(this).attr('data-lazy',mobilesrc);
          });
        }
        //Set up google embed map src
        //Set embed map state
        var embedMapMobile = false;
        if (jQuery(window).width() < 1200) {
          embedMapMobile = true;
        }
        //Function checks window width to determine which embed src to use, use map state so map is not constantly refreshing
        function setEmbedMap() {
          if (jQuery(window).width() < 1200 && !embedMapMobile) {
            embedMapMobile = true;
            jQuery('#museum-map-frame').attr('src', 'https://www.google.com/maps/embed/v1/place?key=AIzaSyBq67Jn1q5VZ7e3s8MgRTSI6tY6vqf359g&q=place_id:ChIJYTeZ_BFawokRe_SRVX_pKIs&zoom=16');
          } else if(jQuery(window).width() >= 1200 && embedMapMobile) {
            embedMapMobile = false;
            jQuery('#museum-map-frame').attr('src', 'https://www.google.com/maps/embed/v1/place?key=AIzaSyBq67Jn1q5VZ7e3s8MgRTSI6tY6vqf359g&q=place_id:ChIJYTeZ_BFawokRe_SRVX_pKIs&center=40.7062532,-74.0079446&zoom=16');
          }
        }
        //Call embed map on init of page
        setEmbedMap();
        //Add resize listener to set embed src
        jQuery( window ).resize(function() {
          setEmbedMap();
        });
      //Scroll magic snippet to load sliders when in viewport
      // Initiate the controller
      var controller = new ScrollMagic.Controller();
      //Add scene for the featured exhibition slider
      new ScrollMagic.Scene({
        triggerElement: '#featured-carousel',
      }).addTo(controller)
        .on('enter', function () {
          sliderFeatured();
        });
      //Add scene for the posts slider
      new ScrollMagic.Scene({
        triggerElement: '#slider-posts',
      }).addTo(controller)
        .on('enter', function () {
          sliderPosts();
        });
      //Loop through all custom sliders and add scene
      jQuery( ".slider-custom" ).each(function() {
        var elementId = jQuery( this ).attr('ID');
        new ScrollMagic.Scene({
          triggerElement: '#'+elementId,
        }).addTo(controller)
          .on('enter', function () {
            customSlider(elementId);
          });
      });
    },
    finalize() {
        // JavaScript to be fired on the home page, after the init JS
    },
};
