<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;

class Press extends Controller
{
    var $paged = 1;
    var $pressCategory;
    var $press;
    /**
     * Constructor
     *
     */
    function __construct()
    {
        $this->pressCategory= App::getPressCategory();
        $this->paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }

    /**
     * Return upcoming events posts
     *
     * @return array
     */
    public function press()
    {
        $currentDate = strtotime('today midnight');
        $pParamHash = array('post_type' => 'post','posts_per_page' => 20,'paged'=>$this->paged);
        $pParamHash['tax_query'] =  array(
            'relation'      => 'AND',
            '0'=> array(
                'taxonomy'	 => 'category',
                'field'    => 'term_id',
                'terms'    => array($this->pressCategory->term_id),
                'operator' => 'IN',
                )
        );
        $pParamHash['orderby']	= 'post_date';
        $pParamHash['order']	= 'DESC';
        $stickyHash = App::getPressStickyPosts();
        if(!empty($stickyHash)){
            $pParamHash['post__not_in'] = $stickyHash;
        }

	    $this->press = new WP_Query( $pParamHash);
        if($this->press->posts){
            return $this->groupPressItems($this->press->posts);
        }else{
            return false;
        }
    }
    /**
     * Group Press Items
     *
     * @return array
     */
    private function groupPressItems($posts) {
        $pressGroupHash = array();
        foreach($posts as $post){
            $date_year_month = date('Y-m',strtotime($post->post_date));

            if (!array_key_exists($date_year_month,$pressGroupHash)){
                $pressGroupHash[$date_year_month]['display_date'] = date('F Y',strtotime($date_year_month));
            }
            $pressGroupHash[$date_year_month]['posts'][] = $post;
        }
        return $pressGroupHash;
    }
    /**
     * Return max page for pagination
     *
     * @return int
     */
    public function getMaxNumPages() {
        return $this->press->max_num_pages;
    }
}
