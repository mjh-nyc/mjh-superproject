export default {
  init() {
    // JavaScript to be fired on the home page
    jQuery('.featured-carousel').slick({
      centerMode: true,
      centerPadding: '0',
      arrows: true,
      slidesToShow: 3,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            centerMode: true,
            centerPadding: '0',
            slidesToShow: 3,
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