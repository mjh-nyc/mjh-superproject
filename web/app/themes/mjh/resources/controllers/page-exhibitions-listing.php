<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;

class ExhibitionListing extends Controller
{

    var $highlightedExhibition;
    /**
     * Constructor
     *
     */
    function __construct()
    {
       $this->getHighlightedExhibition();
    }

    /**
     * Set highlighted exhibition
     *
     */
    private function getHighlightedExhibition(){
        $this->highlightedExhibition = App::get_field('highlighted_exhibition');
    }

    /**
     * Return highlighted exhibition featured image
     *
     * @return string
     */
    public function highlightedExhibitionFeaturedImage ()
    {
        return App::featuredImageSrc('large',$this->highlightedExhibition->ID);
    }

    /**
     * Return highlighted exhibition post title
     *
     * @return string
     */
    public function highlightedExhibitionPostTitle()
    {
        return $this->highlightedExhibition->post_title;
    }

    /**
     * Return highlighted exhibition post excerpt
     *
     * @return string
     */
    public function highlightedExhibitionPostExcerpt()
    {
        return $this->highlightedExhibition->post_excerpt;
    }

    /**
     * Return highlighted exhibition post link
     *
     * @return string
     */
    public function highlightedExhibitionPostLink()
    {
        return get_permalink($this->highlightedExhibition->ID);
    }

    /**
     * Return random exhibitions for widget
     *
     * @return array
     */
    public function exhibitionsCurrentListings()
    {
        $exclude_id = $this->highlightedExhibition->ID;
        $exhibitions = new WP_Query( [
            'post_type' => 'exhibition',
            'post__not_in' => array($exclude_id ),
            'post_per_page'=>-1,
            'status'=>'current'
            ]
        );
        if($exhibitions->posts){
            return $exhibitions->posts;
         }else{
            return false;
        }
    }
}

