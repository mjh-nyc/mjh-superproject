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
     * @return array
     */
    public function carouselItem()
    {
        $carousel_item = get_sub_field('carousel_item');
        return $carousel_item;
    }
}
