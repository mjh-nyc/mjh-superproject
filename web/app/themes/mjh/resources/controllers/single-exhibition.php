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
        $status = 'current';
        if( $this->isExhibtionUpcoming() ){
            $status = 'upcoming';
        }
        $exhibitions = new WP_Query( [
            'post_type' => 'exhibition',
            'post__not_in' => array($exclude_id ),
            'orderby'  => 'rand',
            'posts_per_page'=>2,
            'status'=>$status ]
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
    /**
     * Check if  exhibition is upcoming
     *
     * @return boolean
     */
    public function isExhibtionUpcoming()
    {
        if( App::get_field('exhibition_type') != 'Collection'){
            $start_date = strtotime(App::get_field('exhibition_start_date'));
            if($start_date > time() ){
                return true;
            }
        }
        return false;
    }

}
