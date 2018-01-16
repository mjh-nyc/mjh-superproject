<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;
use DateTimeZone;
use DateTime;

class Event extends Controller
{

    var $event_start_date;
    var $event_start_time;

    /**
     * Constructor
     *
     */
    function __construct()
    {
        $tz = get_option('gmt_offset');
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz));
        $dt->setTimestamp($timestamp);


        if(!empty(App::get_field('event_start_date'))){
            $d = new DateTime(App::get_field('event_start_date'));
            $this->event_start_date = $d->format('Y-m-d');
        }else{
            $this->event_start_date = $dt->format('Y-m-d');
        }

        if(!empty(App::get_field('event_start_time'))){
            $t = new DateTime(App::get_field('event_start_time'));
            $this->event_start_time = $t->format('H:i:s');
        }else{
            $this->event_start_time = $dt->format('H:i:s');
        }
    }

    /**
     * Return next event
     *
     * @return object
     */
    public function getNextEvent() {
        $event = $this->events('next');
        if(!$event){
            $event = $this->events('next',false);
        }

        if($event){
            return get_permalink($event);
        }else{
            return false;
        }
    }

    /**
     * Return previous event
     *
     * @return object
     */
    public function getPreviousEvent() {
        $event = $this->events('previous');
        if(!$event){
            $event = $this->events('previous',false);
        }

        if($event){
            return get_permalink($event);
        }else{
            return false;
        }
    }

    /**
     * Return next/previous event post
     *
     * @return object
     */
    protected function events($post_direction='next', $same_day=true)
    {
        $pParamHash = array('post_type' => 'event','posts_per_page' => 1);
        if($post_direction=='next'){
            $compare = ">";
            $compare_equal_to = ">";
            $pParamHash['order']    = 'ASC';
        }elseif($post_direction=='previous'){
            $compare = "<";
            $compare_equal_to = "<";
            $pParamHash['order']    = 'DESC';
        }

        if($same_day){
            $compare_equal_to.="=";
            $start_time = $this->event_start_time;
        }else{
            $start_time = '00:00:00';

        }

        $pParamHash['meta_key'] = 'event_start_date';
        $pParamHash['orderby']  = 'meta_value';
        $pParamHash['meta_query'] =  array(
            'relation'      => 'AND',
            array(
                'key'       => 'event_start_date',
                'value'     => $this->event_start_date,
                'type'      => 'DATETIME',
                'compare'   => $compare_equal_to,
            ),
            array(
                'key'       => 'event_start_time',
                'value'     => $start_time,
                'type'      => 'TIME',
                'compare'   => $compare,
            ),
        );
        $this->events = new WP_Query($pParamHash);
        if($this->events->posts){
            return $this->events->posts[0];
        }else{
            return false;
        }
    }
}
