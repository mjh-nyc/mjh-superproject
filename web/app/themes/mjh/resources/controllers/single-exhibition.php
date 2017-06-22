<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;

class Exhibition extends Controller
{

    /**
     * Return random exhibitions for widget
     *
     * @return array
     */
    public function exhibitionsWidgetListings()
    {
        $exclude_id = get_the_ID();
        $exhibitions = new WP_Query( [
            'post_type' => 'exhibition',
            'post__not_in' => array($exclude_id ),
            'orderby'  => 'rand',
            'posts_per_page'=>2,
            'status'=>'current' ]
        );
        if($exhibitions->posts){
            return $exhibitions->posts;
         }else{
            return false;
        }
    }
    /**
     * Check if current exhibition is in the past
     *
     * @return boolean
     */
    public function isExhibtionPast()
    {
        //Collections have no dates, always false
        if( App::get_field('exhibition_type') == 'Collection'){
            return false;
        }else{
            return App::evalDateStatus(App::get_field('exhibition_start_date'),App::get_field('exhibition_end_date'));
        }
    }
}
