export default {
    init() {
        // JavaScript to be fired on the home page
        jQuery('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            draggable: false,
            asNavFor: '.slider-nav',
        });
        jQuery('.slider-nav').slick({
            slidesToShow: 3,
            centerPadding: '0',
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            arrows: true,
            speed: 900,
            autoplaySpeed:5000,
            autoplay: true,
            centerMode: true,
            pauseOnHover: true,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        centerMode: true,
                        centerPadding: '150',
                        slidesToShow: 1,
                    },
                },
                {
                    breakpoint: 576,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '0',
                        slidesToShow: 1,
                    },
                },
            ],
        });
        // there are less then 4 slides, create a rollover that highlights and loads the bg above
        jQuery('.slider-nav').on('mouseenter', '.slick-slide', function(e) {
            var $currTarget = $(e.currentTarget),
                index = $currTarget.data('slick-index'),
                slickObj = $('.slider-for').slick('getSlick');
            if (slickObj.slideCount < 4) {
                slickObj.slickGoTo(index);
            }

        });
        //update the header title based on slide loaded
        var header_container = jQuery('.onview h1');
        var curr_header = jQuery('.exhibtion-card.slick-center').attr('data-header');
        jQuery('.slider-nav').on('afterChange', function(){
            // let's do this after changing slides
            //get the value of the data-header attr of the current slide\
            var new_header = jQuery('.exhibtion-card.slick-center').attr('data-header');
            if (curr_header!=new_header) {
                header_container.css('display','none');
                header_container.text( new_header );
                header_container.fadeIn('slow');
                curr_header = new_header;
            }
        });



        jQuery('.slider-plan-deck').slick({
            centerMode: true,
            centerPadding: '30px',
            slidesToShow: 1,
            //autoplay: true,
            pauseOnHover: true,
            speed: 100,
            autoplaySpeed:5000,
            responsive: [
                {
                  breakpoint: 768,
                  settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1,
                  },
                },
                {
                  breakpoint: 576,
                  settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1,
                  },
                },
              ],
        });

        jQuery('.slider-posts').slick({
            dots: false,
            pauseOnHover: true,
            infinite: false,
            responsive: [
                {
                  breakpoint: 768,
                  settings: {
                    arrows: false,
                  },
                },
                {
                  breakpoint: 576,
                  settings: {
                    arrows: false,
                  },
                },
              ],
        });

    },
    finalize() {
        // JavaScript to be fired on the home page, after the init JS


    },
};
