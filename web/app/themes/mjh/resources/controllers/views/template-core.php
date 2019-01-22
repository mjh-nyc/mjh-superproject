<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;

class CoreBlogsAndPress extends Controller
{
    var $paged;
	var $posts_per_page;
    var $blogCategory;
    var $blogs;

    var $press;
    var $max_num_pages_coverage;
    var $max_num_pages_madrid;

    /**
     * Constructor
     *
     */
    function __construct()
    {
        $this->paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$this->posts_per_page = 21;
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

    public function getFilter() {
        if (isset($_GET['filter'])) {
            return $_GET['filter'];
        } else {
            return false;
        }
    }

	public function auschwitzPress() {
		$pParamHash = array('post_type' => 'post','posts_per_page' => 6, 'paged'=>$this->paged);
		$this->press = Press::getPress('auschwitz',$pParamHash);
        if(!empty($this->press->posts)){
            $this->max_num_pages_coverage = $this->press->max_num_pages;
        }
        if($this->press->posts){
            return $this->press->posts;
        }else{
            return false;
        }
	}

	public function madridPress() {
		$pParamHash = array('post_type' => 'post','posts_per_page' => 6,'paged'=>$this->paged);
		$this->press = Press::getPress('madrid',$pParamHash);
		if(!empty($this->press->posts)){
            $this->max_num_pages_madrid = $this->press->max_num_pages;
        }
        if($this->press->posts){
            return $this->press->posts;
        }else{
            return false;
        }
	}

    /**
     * Return max page for blog pagination
     *
     * @return int
     */
    public function getMaxNumPages() {
        return $this->blogs->max_num_pages;
    }

    /**
     * Return max page for pagination for auschwitz coverage
     *
     * @return int
     */
    public function getPressMaxPages() {
        return $this->max_num_pages_coverage;
    }

    /**
     * Return max page for pagination for auschwitz coverage
     *
     * @return int
     */
    public function getMadridPressMaxPages() {
        return $this->max_num_pages_madrid;
    }


}
