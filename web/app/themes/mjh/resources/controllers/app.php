<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;

class App extends Controller
{
    /**
     * Return site name
     *
     * @return varchar
     */
    public function siteName()
    {
        return get_bloginfo('name');
    }
    /**
     * Return site logo image hash
     *
     * @return array
     */
    public function siteLogo()
    {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		return $image;
	}
    /**
     * Return featured image of post
     *
     * @return array
     */
    public static function featuredImageSrc()
    {
        $image[0] = '';
        $post_id = get_the_ID();
        if (has_post_thumbnail( $post_id ) ) {
		    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ) , 'full' );
		}
		return $image[0];
	}

    /**
     * Return the sub head custo field value (available for default page template)
     *
     * @return string
     */
    public static function pageSubHeader()
    {
        $page_subheader = get_field('page_subheader'); 
        if ($page_subheader) :
            return $page_subheader;
        endif;
    }


    /**
     * Return related links
     *
     * @return array
     */
    public static function relatedLinks()
    {
        //setup array holder
        $linkArray = array();
        // check if the repeater field has rows of data
        if( have_rows('related_link_repeater') ):
            $linkArray = get_field('related_link_repeater');      
        endif;
        return $linkArray;
    }


}
