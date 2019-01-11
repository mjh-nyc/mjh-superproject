<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;

class CoreBlogsAndPress extends Controller
{
    var $paged = 1;
    var $blogCategory;
    var $blogs;

    var $press;
    var $max_num_pages_press;
    var $max_num_pages_coverage;
    var $max_num_pages_madrid;
    /**
     * Constructor
     *
     */
    function __construct()
    {
        $this->paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $this->blogCategory= App::getPressCategory('core');
        $this->pressCategory= App::getPressCategory('auschwitz');
        $this->pressMadridCategory= App::getPressCategory('madrid');
    }

    /**
     * Return core exhibition blogs
     *
     * @return array
     */
    public function blogs()
    {
        $pParamHash = array('post_type' => 'post','posts_per_page' => 9,'paged'=>$this->paged);
        $pParamHash['tax_query'] =  array(
            'relation'      => 'AND',
            '0'=> array(
                'taxonomy'	 => 'category',
                'field'    => 'term_id',
                'terms'    => array($this->blogCategory->term_id),
                'operator' => 'IN',
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
