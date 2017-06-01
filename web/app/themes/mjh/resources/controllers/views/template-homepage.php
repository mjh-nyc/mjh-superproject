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
                        unset($x);
                    }
                }
                $hoursHash = array_values($hoursHash);
            }
        }
        if(!empty($hoursHash)){
            if($hoursHash[0]['is_museum_closed']){
                $hoursOutput = "We’re closed today";
            }else{
                 $hoursOutput = "We’re open today</br> ".$hoursHash[0]['opening_hour'].". &mdash; ".$hoursHash[0]['closing_hour'].".";
            }
        }else{
            $hoursOutput = "We’re closed today";
        }
         return $hoursOutput;
    }
}
