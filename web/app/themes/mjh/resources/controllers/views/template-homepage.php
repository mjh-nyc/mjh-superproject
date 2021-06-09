<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;
use DateTime;
use DateTimeZone;

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
     * Return aspecial feature components
     *
     * @return array
     */
    public function specialFeature() {
        $special_feature = App::get_field('homepage_special_feature');

        if( $special_feature ){
            return $special_feature;
        } else {
            false;
        }

    }


    /**
     * Return upcoming events posts
     *
     * @return array
     */
    public function upcomingEvents()
    {
        $total_posts = 6;
        $currentDate = strtotime('yesterday 11:59');
        $pParamHash = array('post_type' => 'event','posts_per_page' => $total_posts);
        $pParamHash['meta_query'] =  array(
            'relation'      => 'AND',
             array(
                'relation'      => 'OR',
                '0'=> array(
                    'key'	 	=> 'event_start_date',
                    'value'	  	=> date('Y-m-d H:i:s', $currentDate),
                    'type'		=> 'DATETIME',
                    'compare' 	=> '>',
                ),
                '1'=> array(
                    'relation'      => 'AND',
                    '0'=> array(
                        'key'	 	=> 'event_end_date',
                        'value'	  	=> date('Y-m-d H:i:s', $currentDate),
                        'type'		=> 'DATETIME',
                        'compare' 	=> '>',
                    ),
                    '1'=> array(
                        'key'	 	=> 'event_type',
                        'compare' 	=> '=',
                        'value'     => 'ongoing'
                    )
                ),
            )
        );
        $eventsHash = $events = array();
        // check if the featured_events repeater field has event to pull out
        $eventsRepeater = array();
        // need to check if flexible layout for events is set up and get the subfields of the event ids
        if( have_rows('flexible_homepage_content_sections')){
            $layouts = get_field('flexible_homepage_content_sections');
            foreach($layouts as $layout){
                if($layout['acf_fc_layout'] == 'events_section'){
                    if(!empty($layout['featured_events_repeater'])){
                        $eventsRepeater = $layout['featured_events_repeater'];
                    }
                    break;
                }
            }
        }
        if( !empty($eventsRepeater) ){
            $eventIdHash = array();
            foreach($eventsRepeater as $featureEvent){
                $eventIdHash[] = $featureEvent['event_item'];
            }
            $pParamHash['post__in'] = $eventIdHash;
            $events = new WP_Query($pParamHash);
            if(empty($events->posts)){
                unset($pParamHash['post__in']);
            }else{
                foreach($events->posts as $event_posts){
                    $eventsHash[] = $event_posts;
                }
                $pParamHash['posts_per_page'] = $total_posts - $events->post_count;
                unset($pParamHash['post__in']);
            }
            unset($events);
            $pParamHash['post__not_in'] = $eventIdHash;
        }

        // if posts per page is still above 0, add on remainder events of total events to display
        if( $pParamHash['posts_per_page'] > 0  ){
            $pParamHash['meta_key']	= 'event_start_date';
            $pParamHash['orderby']	= 'meta_value';
            $pParamHash['order']	= 'ASC';
            $events = new WP_Query( $pParamHash);
            if($events->posts){
                foreach($events->posts as $event_posts){
                    $eventsHash[] = $event_posts;
                }
            }
        }
        if( !empty( $eventsHash ) ) {
            return $this->eventSortByTime($eventsHash);
        }else{
            return false;
        }
    }

    /**
     * Sort events by date and time. Done manually since certain event types don't utilize times
     *
     * @return array
     */
    private function eventSortByTime($eventsHash) {
        $events = $eventsHash;
        if(!empty($events)){
            $eventHash = array();
            foreach($events AS $event){
                $event_type = get_field( "event_type", $event->ID );
                switch($event_type){
                    // Always set date/time keys to zero since it is top of the list
                    case 'recurring':
                        $eventHash[0][0][] = $event;
                    break;
                    // Set array hash to date and time for the keys, then sort by time key
                    case'onetime':
                        $event_start_date = get_field( "event_start_date", $event->ID );
                        $event_start_time = get_field( "event_start_time", $event->ID );
                        if(empty($event_start_time)){
                            $event_start_time=0;
                        }
                        $eventHash[strtotime($event_start_date)][strtotime($event_start_time)][]= $event;
                        ksort($eventHash[strtotime($event_start_date)]);
                    break;
                    // Set array hash to date only for the keys, then sort by time key, which is set to zero for ongoing
                    case'ongoing':
                        $event_start_date = get_field( "event_start_date", $event->ID );
                        $eventHash[strtotime($event_start_date)][0][]= $event;
                        ksort($eventHash[strtotime($event_start_date)]);
                    break;
                }
            }
            // Set up posts hash
            $eventsPostsHash = array();
            foreach($eventHash AS $key => $eventsSorted){
                foreach($eventsSorted AS $eventsSortedTime){
                    if(count($eventsSortedTime) > 1){
                        foreach($eventsSortedTime As $eventsSortedTimeSame){
                            $eventsPostsHash[] = $eventsSortedTimeSame;
                        }
                    }else{
                        $eventsPostsHash[] = array_shift($eventsSortedTime);
                    }
                }
            }
            return $eventsPostsHash;
        }
    }

    /**
     * Return 10 non press/in memoriam blog posts
     *
     * @return array
     */
    public function blogPosts() {
        $catPress = App::getPressCategory('press');
        $catInMemoriam = App::getPressCategory('in-memoriam');
        //TODO: Replace the above with ACF field, currently set as draft
        //construct an array of items to be excluded, if any
        //these come from ACF field dropdown attached to the homepage layout builder (clone)
        //$excludePosts = get_sub_field('blog_exclude_items');
        //array($catPress->term_id,$catInMemoriam->term_id)
        $pParamHash = array('category__not_in'=>array($catPress->term_id,$catInMemoriam->term_id));
        $stickyHash = App::getPressStickyPosts();
        if(!empty($stickyHash)){
            $pParamHash['post__not_in'] = $stickyHash;
        }
        return $this->getPosts($pParamHash);

    }

    /**
     * Return 10 press posts
     *
     * @return array
     */
    public function pressPosts() {
        $cat = App::getPressCategory('press');
        $pParamHash = array('category__in'=>$cat->term_id);
        $stickyHash = App::getPressStickyPosts();
        // Hackish method to include sticky press posts to top of list.
        if(!empty($stickyHash)){
            $pParamHash['post__not_in'] = $stickyHash;
            $press_count =10;
            $pressHash = array();
            foreach($stickyHash AS $post_id){
                $pressHash[] = get_post($post_id);
            }
            $pParamHash['posts_per_page'] = $press_count - count($stickyHash);
            $posts = $this->getPosts($pParamHash);
            if($posts){
                foreach($posts AS $post){
                    $pressHash[] = $post;
                }
            }
            return $pressHash;
        }else{
          return $this->getPosts($pParamHash);
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
        if(empty($pParamHash['posts_per_page'])){
            $pParamHash['posts_per_page'] = 10;
        }
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
        /*$regularHours =  get_field('regular_hours_repeater', 'option');
        $holidays =  get_field('holiday_hours_repeater', 'option');
        $currentTimeZone = get_option('timezone_string');
        $currentDay = date('l', strtotime('today midnight'.$currentTimeZone));
        $currentDate = strtotime('today midnight '.$currentTimeZone);
        $currentTomarrow = strtotime('today midnight '.$currentTimeZone.' + 1day');
        $hoursHash = array();
        $hoursOutput ='';
        // Holiday hour schedule
        $holidayHash = array();
        if(!empty($holidays)){
            foreach($holidays as $key => $holiday){
				//Get the timezone offset since acf date does not store the timezone
				$holidayTimestamp = strtotime($holiday['holiday_date']);
				// If empty, set it to current time
				if(empty($holidayTimestamp)){
                    $holidayTimestamp = strtotime('Now');
                }
				$dt = new DateTime("@".$holidayTimestamp);
				$dt->setTimeZone(new DateTimeZone($currentTimeZone));
				$holidayTimestamp = $holidayTimestamp - $dt->getOffset();
                $holidayHash[$holidayTimestamp] =$key ;
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
        }*/
         return do_shortcode('[hours]');
    }
}
