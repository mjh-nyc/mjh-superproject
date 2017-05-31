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
    public static function siteName()
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
     * @return html
     */
    public static function featuredImage($size='large',$id=false)
    {
        $image = "";
        if (!$id){
            $id = get_the_ID();
        }
        if (has_post_thumbnail( $id ) ) {
		    $image = get_the_post_thumbnail( $id, $size );
		}
		return $image;
	}

    /**
     * Return featured image of post src only
     *
     * @return string
     */
    public static function featuredImageSrc($size='large',$id=false)
    {
        $image = "";
        if (!$id){
            $id = get_the_ID();
        }
        if (has_post_thumbnail( $id ) ) {
            $image = get_the_post_thumbnail_url($id, $size);
        }
        return $image;
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
     * Return the post title, if no ID provided, will use current post id
     *
     * @return string
     */
    public static function postTitle($id=false)
    {
        if (!$id){
            $id = get_the_ID();
        }
        return get_the_title($id);
    }

    /**
     * Return the post excerpt, if no ID provided, will use current post id
     *
     * @return string
     */
    public static function postExcerpt($id=false)
    {
        if (!$id){
            $id = get_the_ID();
        }
        return get_the_excerpt($id);
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

    /**
     * Return a single ACF pro field links, if $id is empty, will use current post's id
     * $fieldname must be passed
     *
     * @return varchar
     */
    public static function get_field($fieldname, $id=false)
    {
        $field_value = "";
        if (!$id){
            $id = get_the_ID();
        }
        if ($fieldname) {
            return get_field($fieldname,$id);
        } else {
            return false;
        }
    }

}
