<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;
use DateTime;

class Events extends Controller
{

    var $eventDates;
    var $eventCategory;
    var $paged = 1;
    var $events;
    /**
     * Constructor
     *
     */
    function __construct()
    {
        $this->eventDates ='upcoming';
        if( !empty($_REQUEST['event-dates']) ){
            $this->eventDates = $_REQUEST['event-dates'];
        }
        $this->eventCategory ='';
        if( !empty($_REQUEST['event-category']) ){
            $this->eventCategory = (int)$_REQUEST['event-category'];
        }

        if($this->eventDates == 'live'){

        }

        $this->paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }

    /**
     * Return upcoming events posts
     *
     * @return array
     */
    public function events()
    {
        $currentDate = strtotime('yesterday 11:59');
        $pParamHash = array('post_type' => 'event','posts_per_page' => 9,'paged'=>$this->paged);
        switch($this->eventDates){
            case 'upcoming':
                $event_start_date = $event_end_date = $currentDate;
                $this->setMetaUpcomingDateQuery($pParamHash, $event_start_date, $event_end_date);
            break;
            case 'live':
                $event_start_date = $event_end_date = $currentDate;
                $this->setMetaUpcomingDateQuery($pParamHash, $event_start_date, $event_end_date);
                $pParamHash['meta_query'][] = array(
                    'key' => 'event_live',
                    'value' => '1',
                    'compare' => '='
                );
            break;
            case 'month':
                $event_start_date = new DateTime('first day of this month');
                $event_start_date->setTime(00, 00, 00);
                $event_end_date  = new DateTime('last day of this month');
                $event_end_date->setTime(23, 59, 59);
                $this->setMetaMonthlyDateQuery($pParamHash, $event_start_date->getTimestamp(), $event_end_date->getTimestamp());
            break;
            case 'next-month':
                $event_start_date = new DateTime('first day of next month');
                $event_start_date->setTime(00, 00, 00);
                $event_end_date  = new DateTime('last day of next month');
                $event_end_date->setTime(23, 59, 59);
                $this->setMetaMonthlyDateQuery($pParamHash, $event_start_date->getTimestamp(), $event_end_date->getTimestamp());
            break;
            case 'past':
                $pParamHash['meta_query'] =  array(
                    'relation'      => 'AND',
                     array(
                        'relation'      => 'OR',
                         array(
                            'relation'      => 'AND',
                            '0'=> array(
                                'key'       => 'event_end_date',
                                'value'     => date('Y-m-d H:i:s', $currentDate),
                                'type'      => 'DATETIME',
                                'compare'   => '<',
                            ),
                            '1'=> array(
                                'key'       => 'event_type',
                                'compare'   => '=',
                                'value'     => 'ongoing'
                            )
                        ),
                        array(
                            'relation'      => 'AND',
                            '0'=> array(
                                'key'       => 'event_start_date',
                                'value'     => date('Y-m-d H:i:s', $currentDate),
                                'type'      => 'DATETIME',
                                'compare'   => '<',
                            ),
                            '1'=> array(
                                'key'       => 'event_type',
                                'compare'   => '=',
                                'value'     => 'onetime'
                            )
                        ),
                    )
                );
                $pParamHash['meta_key'] = 'event_start_date';
                $pParamHash['orderby']  = 'meta_value';
                $pParamHash['order']    = 'DESC';
            break;
        }
        if (!empty($this->eventCategory) ){
            $pParamHash['tax_query'] =  array(
                'relation'      => 'AND',
                '0'=> array(
                    'taxonomy'	 => 'event_category',
                    'field'    => 'term_id',
                    'terms'    => array($this->eventCategory),
                    'operator' => 'IN',
                    )
            );
        }
	    $this->events = new WP_Query( $pParamHash);
        if($this->events->posts){
            $this->eventSortByTime();
            return $this->events->posts;
        }else{
            return false;
        }
    }

    /**
     * Set meta date query
     *
     * @return array
     */
    protected function setMetaUpcomingDateQuery(&$pParamHash, $event_start_date, $event_end_date) {
        $pParamHash['meta_query'] =  array(
            'relation'      => 'AND',
             array(
                'relation'      => 'OR',
                'q1'=> array(
                    'key'       => 'event_start_date',
                    'value'     => date('Y-m-d H:i:s', $event_start_date),
                    'type'      => 'DATETIME',
                    'compare'   => '>',
                ),
                'q2'=> array(
                    'key'       => 'event_start_date',
                    'compare'   => '=',
                    'value'     => ''
                ),
                'q3'=> array(
                    'relation'      => 'AND',
                    '0'=> array(
                        'key'       => 'event_end_date',
                        'value'     => date('Y-m-d H:i:s', $event_end_date),
                        'type'      => 'DATETIME',
                        'compare'   => '>',
                    ),
                    '1'=> array(
                        'key'       => 'event_type',
                        'compare'   => '=',
                        'value'     => 'ongoing'
                    )
                ),
            )
        );
        $pParamHash['meta_key'] = 'event_start_date';
        $pParamHash['orderby']  = 'meta_value';
        $pParamHash['order']    = 'ASC';
    }

    /**
     * Set meta date query
     *
     * @return array
     */
    protected function setMetaMonthlyDateQuery(&$pParamHash, $event_start_date, $event_end_date) {
        $pParamHash['meta_query'] =  array(
            'relation'      => 'OR',
                '0'=> array(
                    'relation'      => 'AND',
                    '0'=> array(
                        'key'       => 'event_start_date',
                        'value'     => date('Y-m-d H:i:s', $event_start_date),
                        'type'      => 'DATETIME',
                        'compare'   => '>',
                    ),
                     '1'=> array(
                        'key'       => 'event_start_date',
                        'value'     => date('Y-m-d H:i:s', $event_end_date),
                        'type'      => 'DATETIME',
                        'compare'   => '<',
                    ),
                ),
                '1'=> array(
                    'relation'      => 'AND',
                    '0'=> array(
                        'key'       => 'event_start_date',
                        'value'     => date('Y-m-d H:i:s', $event_start_date),
                        'type'      => 'DATETIME',
                        'compare'   => '>',
                    ),
                    '1'=> array(
                        'key'       => 'event_end_date',
                        'value'     => date('Y-m-d H:i:s', $event_end_date),
                        'type'      => 'DATETIME',
                        'compare'   => '<',
                    ),
                ),
        );
        $pParamHash['meta_key'] = 'event_start_date';
        $pParamHash['orderby']  = 'meta_value';
        $pParamHash['order']    = 'ASC';
    }

    /**
     * Sort events by date and time. Done manually since certain event types don't utilize times
     *
     * @return array
     */
    private function eventSortByTime() {
        $events = $this->events->posts;
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
                            $eventsPostsHash[] = array_shift($eventsSortedTimeSame);
                        }
                    }else{
                        $eventsPostsHash[] = array_shift($eventsSortedTime);
                    }
                }
            }
            unset($this->events->posts);
            $this->events->posts = $eventsPostsHash;
        }
    }

    /**
     * Return event dates
     *
     * @return array
     */
    public function eventDatesRequest() {
        return $this->eventDates;
    }

    /**
     * Return event category
     *
     * @return array
     */
    public function eventCategoryRequest() {
        return $this->eventCategory;
    }

    /**
     * Return max page for pagination
     *
     * @return int
     */
    public function getMaxNumPages() {
        return $this->events->max_num_pages;
    }
}
