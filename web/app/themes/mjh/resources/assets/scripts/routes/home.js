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
      dots: true,
      autoplay: true,
      mobileFirst: true,
      centerMode: true,
      focusOnSelect: true,
      responsive: [
        {
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