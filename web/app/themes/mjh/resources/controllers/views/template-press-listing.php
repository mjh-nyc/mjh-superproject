<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;

class Press extends Controller
{
    var $paged = 1;
    var $pressCategory;
    var $press;
    var $posts_per_page;
    var $max_num_pages_press;
    var $max_num_pages_coverage;
    var $max_num_pages_releases;

    /**
     * Constructor
     *
     */
    function __construct()
    {
        //$this->pressCategory= App::getPressCategory(App::getCurrentPageSlug());
        $this->posts_per_page = 21;
        $this->paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }


    /**
     * Return press posts functioned called from the blade template
     *
     * @return array
     */
    public function press() {
        $grouped = false;
        $press = $this->getPressQuery(App::getCurrentPageSlug(), $grouped);
        if(!empty($press)){
            $this->max_num_pages_press = $this->press->max_num_pages;
        }
        return $press;
    }

    public function coverage() {
        $slug = App::getCurrentPageSlug();
        $grouped = false;
        if($slug == 'coverage'){
            //$grouped = true;
        }else{
            $this->posts_per_page = 6;
        }
        $press = $this->getPressQuery('coverage', $grouped);
        if(!empty($press)){
            $this->max_num_pages_coverage = $this->press->max_num_pages;
        }
        return $press;
    }
    public function releases() {
        $slug = App::getCurrentPageSlug();
        $grouped = false;
        if($slug == 'releases'){
            //$grouped = true;
        }else{
            $this->posts_per_page = 6;
        }
        $press = $this->getPressQuery('releases', $grouped);
        if(!empty($press)){
            $this->max_num_pages_releases = $this->press->max_num_pages;
        }
        return $press;
    }
	/**
	 * Set up query for press items
	 *
	 * @return object
	 */
    private function getPressQuery($pressCategory, $grouped){
		$pParamHash = array('post_type' => 'post','posts_per_page' => $this->posts_per_page,'paged'=>$this->paged);
		$this->press = Press::getPress($pressCategory,$pParamHash);
		if ($grouped) {
			return Press::groupPressItems($this->press->posts);
		} else {
			return $this->press->posts;
		}
	}

    /**
     * Return press based on category requested
     *
     * @return object
     */
    public static function getPress($pressCategory, $pParamHash)
    {
        $pressCategory_array = App::getPressCategory($pressCategory);
        $currentDate = strtotime('today midnight');
        $pParamHash['tax_query'] =  array(
            'relation'      => 'AND',
            '0'=> array(
                'taxonomy'	 => 'category',
                'field'    => 'term_id',
                'terms'    => array($pressCategory_array->term_id),
                'operator' => 'IN',
                )
        );
        $pParamHash['orderby']	= 'post_date';
        $pParamHash['order']	= 'DESC';
        $stickyHash = App::getPressStickyPosts();
        if(!empty($stickyHash)){
            $pParamHash['post__not_in'] = $stickyHash;
        }

        return new WP_Query( $pParamHash);
    }
    /**
     * Group Press Items
     *
     * @return array
     */
    public static function groupPressItems($posts) {
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
    public function getMaxNumPagesPress() {
        return $this->max_num_pages_press;
    }
    /**
     * Return max page for pagination
     *
     * @return int
     */
    public function getMaxNumPagesCoverage() {
        return $this->max_num_pages_coverage;
    }
    /**
     * Return max page for pagination
     *
     * @return int
     */
    public function getMaxNumPagesReleases() {
        return $this->max_num_pages_releases;
    }

}
