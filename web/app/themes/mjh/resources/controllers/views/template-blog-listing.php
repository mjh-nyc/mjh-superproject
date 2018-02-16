<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;

class Blogs extends Controller
{
    var $paged = 1;
    var $pressCategory;
    var $blogs;
    /**
     * Constructor
     *
     */
    function __construct()
    {
        $this->pressCategory= App::getPressCategory('press');
        $this->paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }

    /**
     * Return upcoming events posts
     *
     * @return array
     */
    public function blogs()
    {
        $currentDate = strtotime('today midnight');
        $pParamHash = array('post_type' => 'post','posts_per_page' => 9,'paged'=>$this->paged);
        $pParamHash['tax_query'] =  array(
            'relation'      => 'AND',
            '0'=> array(
                'taxonomy'	 => 'category',
                'field'    => 'term_id',
                'terms'    => array($this->pressCategory->term_id),
                'operator' => 'NOT IN',
                )
        );
        $pParamHash['orderby']	= 'post_date';
        $pParamHash['order']	= 'DESC';
        $stickyHash = App::getPressStickyPosts();
        if(!empty($stickyHash)){
            $pParamHash['post__not_in'] = $stickyHash;
        }
	    $this->blogs = new WP_Query( $pParamHash);
        if($this->blogs->posts){
            return $this->blogs->posts;
        }else{
            return false;
        }
    }
    /**
     * Return max page for pagination
     *
     * @return int
     */
    public function getMaxNumPages() {
        return $this->blogs->max_num_pages;
    }
}
