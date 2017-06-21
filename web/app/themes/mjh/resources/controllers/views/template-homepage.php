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
     * Return upcoming events posts
     *
     * @return array
     */
    public function upcomingEvents()
    {
        $currentDate = strtotime('today midnight');
        $pParamHash = array('post_type' => 'event','posts_per_page' => 3);
        $pParamHash['meta_query'] =  array(
            'relation'      => 'AND',
            '0'=> array(
                'key'	 	=> 'event_start_date',
                'value'	  	=> date('Y-m-d H:i:s', $currentDate),
                'type'		=> 'DATETIME',
                'compare' 	=> '>',
            )
        );
        $pParamHash['meta_key']	= 'event_start_date';
        $pParamHash['orderby']	= 'meta_value';
        $pParamHash['order']	= 'ASC';
        $events = new WP_Query( $pParamHash);
        if($events->posts){
         return $events->posts;
        }else{
         return false;
        }
    }

    /**
     * Return 10 non press blog posts
     *
     * @return array
     */
    public function blogPosts() {
        $cat = App::getPressCategory();
        $pParamHash = array('category__not_in'=>$cat->term_id);
        return $this->getPosts($pParamHash);
    }

    /**
     * Return 10 press posts
     *
     * @return array
     */
    public function pressPosts() {
        $cat = App::getPressCategory();
        $pParamHash = array('category__in'=>$cat->term_id);
        return $this->getPosts($pParamHash);
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
     * Returns textual output of schedule
     *
     * @return string
     */
    public function getCurrentScheduleText() {
        $regularHours =  get_field('regular_hours_repeater', 'option');
        $holidays =  get_field('holiday_hours_repeater', 'option');
        $currentDay = date('l');
        $currentDate = strtotime('today midnight');
        $currentTomarrow = strtotime('today midnight + 1day');
        $hoursHash = array();
        $hoursOutput ='';
        // Holiday hour schedule
        $holidayHash = array();
        if(!empty($holidays)){
            foreach($holidays as $key => $holiday){
                $holidayHash[strtotime($holiday['holiday_date'])] =$key ;
            }
            // Check if today is a holiday
            if(array_key_exists($currentDate,$holidayHash)){
                $hoursHash[0] = $holidays[$holidayHash[$currentDate]];
            }

            // Check if tomarrow is a holiday
            if(empty($hoursHash)){
                if(array_key_exists($currentTomarrow,$holidayHash)){
                    $hoursHash[0] = array(
                        'is_museum_closed' => false,
                        'opening_hour' => get_field('holiday_eve_opening_hour', 'option'),
                        'closing_hour' => get_field('holiday_eve_closing_hour', 'option'),
                    );
                }
            }
        }
        if( empty($hoursHash) && !empty($regularHours) ){
            // Regular hour schedules
            foreach($regularHours as $regularHour){
                if($regularHour['day_of_week'] != $currentDay ){
                    continue;
                }
                $hoursHash[] = $regularHour;
            }
            if(count($hoursHash) > 1){
                for($x=0;$x < count($hoursHash); $x++){
                    if( empty($hoursHash[$x]['hours_start_date_range']) && empty($hoursHash[$x]['hours_end_date_range'])){
                        continue;
                    }
                    if( ( !empty($hoursHash[$x]['hours_start_date_range']) && $currentDate >= strtotime($hoursHash[$x]['hours_start_date_range'] ) ) && (!empty($hoursHash[$x]['hours_end_date_range']) && $currentDate <= strtotime($hoursHash[$x]['hours_end_date_range']) ) ){
                        $hoursHash[0] = $hoursHash[$x];
                        break;
                    }else{
                        unset($hoursHash[$x]);
                    }
                }
                $hoursHash = array_values($hoursHash);
            }
        }
        if(!empty($hoursHash)){
            if($hoursHash[0]['is_museum_closed']){
                $hoursOutput = "We’re closed today";
            }else{
                 $hoursOutput = "We’re open today</br> ".$hoursHash[0]['opening_hour']." &#8211; ".$hoursHash[0]['closing_hour'];
            }
        }else{
            $hoursOutput = "We’re closed today";
        }
         return $hoursOutput;
    }
}
