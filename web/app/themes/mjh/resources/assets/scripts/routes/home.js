export default {
  init() {
    // JavaScript to be fired on the home page
    jQuery('.featured-carousel').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: true,
      centerMode: true,
      focusOnSelect: true,
    });
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
