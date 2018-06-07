<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;

class Publications extends Controller
{
    var $publications;
    var $publicationCategory;
    var $paged = 1;

     /**
     * Constructor
     *
     */
    function __construct()
    {
       
        $this->publicationCategory ='';
        if( !empty($_REQUEST['publication-category']) ){
            $this->publicationCategory = (int)$_REQUEST['publication-category'];
        }

    }


    public function publications()
    {
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $args = array( 
            'post_type' => 'publication',
            'posts_per_page' => 9,
            'post_status' => 'publish',
            'orderby' => 'post_date',
            'order' => 'DESC',
            'paged'=>$paged
        );

        if (!empty($this->publicationCategory) ){
            $args['tax_query'] =  array(
                'relation'      => 'AND',
                '0'=> array(
                    'taxonomy'   => 'publication_category',
                    'field'    => 'term_id',
                    'terms'    => array($this->publicationCategory),
                    'operator' => 'IN',
                )
            );
        }
       
	    $this->publications = new WP_Query( $args);
        if($this->publications->posts){
            return $this->publications->posts;
        }else{
            return false;
        }
    }

    /**
     * Return publication category
     *
     * @return array
     */
    public function publicationCategoryRequest() {
        return $this->publicationCategory;
    }

    /**
     * Return max page for pagination
     *
     * @return int
     */
    public function getMaxNumPages() {
        return $this->publications->max_num_pages;
    }
}
