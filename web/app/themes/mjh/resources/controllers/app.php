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
     * Return site description
     *
     * @return varchar
     */
    public static function siteDescription()
    {
        return get_bloginfo('description');
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
     * Return the post categories
     *
     * @return array
     */
    public static function postCategories($id=false)
    {
        if (!$id){
            $id = get_the_ID();
        }
        return wp_get_post_categories($id);
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
     * Return repeater field from Advanced Custom Fields
     *
     * @return array
     */
    public static function get_repeater_field($fieldname, $id=false)
    {
        //setup array holder
        $repeater_items = array();
        if (!$id){
            $id = get_the_ID();
        }
        // check if the repeater field has rows of data
        if( $fieldname && have_rows($fieldname,$id) ):
            $repeater_items = get_field($fieldname,$id);
        endif;
        return $repeater_items;
    }

    /**
     * Return a single ACF pro field, if $id is empty, will use current post's id
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


    

    /**
     * Decide if we should add a no-sponsor class name to article element
     *
     * @return string
     */
    public static function addSponsorsClass()
    {
        $primary_sponsors_repeater = get_field('primary_sponsors_repeater');
        $secondary_sponsors_repeater = get_field('secondary_sponsors_repeater');
        $add_class = "";
        if (!$primary_sponsors_repeater && !$secondary_sponsors_repeater) {
            $add_class = 'no-sponsors';
        }
        return $add_class;

    }

    /**
     * Return image thumbnail with attachmend id
     *
     * @return string
     */
    public static function getAttachmentById($attachment_id=false,$size='large')
    {
        if($attachment_id){
            return wp_get_attachment_image_url( $attachment_id, $size );
        }
    }

    /**
     * Return global site announcement (if exists)
     *
     * @return string
     */
    public static function getAnnouncement()
    {
        return get_field('annoucements','option');
    }

    /**
     * Get social channels, these come from the ACF options page under Settings-->Theme Options
     *
     * @return varchar
     */
    public static function get_social()
    {
        $social="";
        $facebook = get_field('facebook_link', 'option');
        $twitter = get_field('twitter_handle', 'option');
        $instagram = get_field('instagram_handle', 'option');
        $youtube = get_field('youtube_link', 'option');
        $young_friends = get_field('young_friends_link', 'option');

        if ($facebook) {
            $social .='<a href="'.$facebook.'" target="_blank" onclick="return trackOutboundLink(\''.$facebook.'\', true)"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
        }
        if ($twitter) {
            $social .='<a href="https://twitter.com/'.$twitter.'" target="_blank" onclick="return trackOutboundLink(\'https://twitter.com/'.$twitter.'\', true)"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
        }
        if ($instagram) {
            $social .='<a href="https://www.instagram.com/'.$instagram.'" target="_blank" onclick="return trackOutboundLink(\'https://www.instagram.com/'.$instagram.'\', true)"><i class="fa fa-instagram" aria-hidden="true"></i></a>';
        }
        if ($youtube) {
            $social .='<a href="'.$youtube.'" target="_blank" onclick="return trackOutboundLink(\''.$youtube.'\', true)"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>';
        }
        if ($young_friends) {
            $social .='<a href="'.$young_friends.'" target="_blank" onclick="return trackOutboundLink(\''.$young_friends.'\', true)" class="yf"><img src="../app/themes/mjh/dist/images/young-friends.svg" alt="'.__("Young Friends","sage").'"></a>';
        }

        return $social;
    }

}
