<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;

class Events extends Controller
{

    /**
     * Return upcoming events posts
     *
     * @return array
     */
    public function events() {
        $currentDate = strtotime('today midnight');
        $pParamHash = array('post_type' => 'event','post_per_page' => 3);
        add_filter('posts_where', 'App\\mjh_events_posts_where');
        $pParamHash['meta_query'] =  array(
            'relation'      => 'AND',
            '0'=> array(
                'key'	 	=> 'event_dates_%_event_start_date',
                'value'	  	=> date('Y-m-d H:i:s', $currentDate),
                'type'		=> 'DATETIME',
                'compare' 	=> '>',
		    )
	);
      $events = new WP_Query( $pParamHash);
      remove_filter('posts_where', 'App\\mjh_events_posts_where');
      if($events->posts){
         return $events->posts;
      }else{
         return false;
      }
    }

    /**
     * Return 10 recent blog posts
     *
     * @return array
     */
    private function getPosts($pParamHash) {
        $cat_id  = get_cat_ID( 'press' );
        $pParamHash['post_type'] = 'post';
        $pParamHash['post_per_page'] = 10;
        $posts = new WP_Query( $pParamHash);
        if($posts->posts){
         return $posts->posts;
      }else{
         return false;
      }
    }
}
