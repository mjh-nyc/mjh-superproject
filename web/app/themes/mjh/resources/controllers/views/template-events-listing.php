<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;

class Events extends Controller
{

    var $eventDates;
    var $eventCategory;
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

    }

    /**
     * Return upcoming events posts
     *
     * @return array
     */
    public function events()
    {
        $currentDate = strtotime('today midnight');
        $pParamHash = array('post_type' => 'event','posts_per_page' => -1);
        if($this->eventDates=='upcoming'){
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
	    }elseif($this->eventDates=='past'){
            $pParamHash['meta_query'] =  array(
                'relation'      => 'AND',
                '0'=> array(
                    'key'	 	=> 'event_end_date',
                    'value'	  	=> date('Y-m-d H:i:s', $currentDate),
                    'type'		=> 'DATETIME',
                    'compare' 	=> '<',
                )
            );
            $pParamHash['meta_key']	= 'event_end_date';
            $pParamHash['orderby']	= 'meta_value';
            $pParamHash['order']	= 'DESC';
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

	    $events = new WP_Query( $pParamHash);
        if($events->posts){
            return $events->posts;
        }else{
            return false;
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

}
