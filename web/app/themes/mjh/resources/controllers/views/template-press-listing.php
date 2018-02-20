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
    /**
     * Constructor
     *
     */
    function __construct()
    {
        //$this->pressCategory= App::getPressCategory(App::getCurrentPageSlug());
        $this->posts_per_page = 20;
        $this->paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }


    /**
     * Return press posts functioned called from the blade template
     *
     * @return array
     */
    public function press() {
        return $this->getPress(App::getCurrentPageSlug(), true);
    }

    public function coverage() {
        $slug = App::getCurrentPageSlug();
        $grouped = false;
        if($slug == 'coverage'){
            $grouped = true;
        }else{
            $this->posts_per_page = 6;
        }
        return $this->getPress('coverage', $grouped);

    }
    public function releases() {
        $slug = App::getCurrentPageSlug();
        $grouped = false;
        if($slug == 'releases'){
            $grouped = true;
        }else{
            $this->posts_per_page = 6;
        }
        return $this->getPress('releases', $grouped);
    }


    /**
     * Return press based on category requested
     *
     * @return array
     */
    private function getPress($pressCategory, $grouped)
    {
        $pressCategory_array = App::getPressCategory($pressCategory);
        $currentDate = strtotime('today midnight');
        $pParamHash = array('post_type' => 'post','posts_per_page' => $this->posts_per_page,'paged'=>$this->paged);
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

	    $this->press = new WP_Query( $pParamHash);
        if($this->press->posts){
            //should posts be grouped by date?
            if ($grouped) {
                return $this->groupPressItems($this->press->posts);
            } else {
                 return $this->press->posts;
            }
            
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
