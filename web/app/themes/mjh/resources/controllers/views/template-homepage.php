<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;

class Homepage extends Controller
{
    /**
     * Return all exhibitions posts
     *
     * @return array
     */
    public function exhibitions() {
      $exhibitions = new WP_Query( [ 'post_type' => 'exhibition' ] );
      return $exhibitions;
    }

    /**
     * Return carouselItem from Advanced Custom Fields
     *
     * @return int
     */
    public static function carouselItems()
    {
        //setup array holder
        $carousel_items = array();
        // check if the repeater field has rows of data
        if( have_rows('featured_carousel_repeater') ):
            $carousel_items = get_field('featured_carousel_repeater');
        endif;
        return $carousel_items;
    }

    /**
     * Return planDeckCarouselItems from Advanced Custom Fields
     *
     * @return array
     */
    public static function planDeckCarouselItems()
    {
        //setup array holder
        $plan_deck_carousel_items = array();
        // check if the repeater field has rows of data
        if( have_rows('plan_deck_repeater') ){
            $plan_deck_carousel_items = get_field('plan_deck_repeater');
        }
        return $plan_deck_carousel_items;
    }

    /**
     * Return all exhibitions posts
     *
     * @return array
     */
    public function getCurrentHours() {
        return "We're open today</br> 10:00 A.M. &mdash; 5:45 P.M.";
    }
}
