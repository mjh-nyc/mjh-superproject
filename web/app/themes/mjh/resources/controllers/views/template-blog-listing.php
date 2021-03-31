<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;

class Blogs extends Controller
{
    var $paged = 1;
    //var $pressCategory;
    var $excludeCategories;
    var $blogs;
    /**
     * Constructor
     *
     */
    function __construct()
    {
        //$this->pressCategory= App::getPressCategory('press');
        //$this->inMemoriamCategory= App::getPressCategory('in-memoriam');
        //construct an array of items to be excluded, if any
        //these come from ACF field dropdown attached to the blog listing page template
        $this->excludeCategories = App::get_field('blog_exclude_items');

        $this->paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }

    /**
     * Return latest blog posts (excluding press and in memoriam categories)
     *
     * @return array
     */
    public function blogs()
    {     
        //if in memoriam is not in the exclude array, arrange by title
        //otherwise arrange by post date
        if(!in_array(get_category_by_slug('in-memoriam')->term_id, $this->excludeCategories)) {
            $orderby = 'title';
            $order = 'ASC';
        } else {
            $orderby = 'post_date';
            $order = 'DESC';
        }
        

        $currentDate = strtotime('today midnight');
        $pParamHash = array('post_type' => 'post','posts_per_page' => 9,'paged'=>$this->paged);
        $pParamHash['tax_query'] =  array(
            'relation'      => 'AND',
            '0'=> array(
                'taxonomy'	 => 'category',
                'field'    => 'term_id',
                'terms'    => $this->excludeCategories,
                'operator' => 'NOT IN',
                )
        );
        $pParamHash['orderby']	= $orderby;
        $pParamHash['order']	= $order;
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
