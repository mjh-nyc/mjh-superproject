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


}
