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
   
}
