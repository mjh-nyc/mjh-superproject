/** import external dependencies */
import 'jquery';
import 'bootstrap';
import 'slick-carousel/slick/slick';

// Import Parallax js
import 'jquery-parallax.js/parallax.min';

//Import waypoints
import 'waypoints/lib/jquery.waypoints.min';
import 'waypoints/lib/shortcuts/sticky.min';

//Import animsition library
import 'animsition/dist/js/animsition.min';

/** import local dependencies */
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';

/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
  /** All pages */
  common,
  /** Home page */
  home,
  /** About Us page, note the change from about-us to aboutUs. */
  aboutUs,
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());
