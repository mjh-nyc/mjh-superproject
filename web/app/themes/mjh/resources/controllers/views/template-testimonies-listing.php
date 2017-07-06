<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;

class Testimonies extends Controller
{
    var $testimonies;

    public function testimonies()
    {
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $args = array( 
            'post_type' => 'testimony',
            'posts_per_page' => 9,
            'post_status' => 'publish',
            'orderby' => 'post_date',
            'order' => 'DESC',
            'paged'=>$paged
        );
       
	    $this->testimonies = new WP_Query( $args);
        if($this->testimonies->posts){
            return $this->testimonies->posts;
        }else{
            return false;
        }
    }
    /**
     * Return max page for pagination
     *
     * @return int
     */
    public function getMaxNumPages() {
        return $this->testimonies->max_num_pages;
    }
}
