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
        jQuery('.slider-nav').on('mouseenter', '.slick-slide', function(e) {
            var $currTarget = $(e.currentTarget),
                index = $currTarget.data('slick-index'),
                slickObj = $('.slider-for').slick('getSlick');

            slickObj.slickGoTo(index);

        });
        jQuery('.slider-plan-deck').slick({
            centerMode: true,
            centerPadding: '10px',
            slidesToShow: 1,
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
    },
    finalize() {
        // JavaScript to be fired on the home page, after the init JS
    },
};