<?php

namespace App;

//Logo support
function theme_prefix_setup() {

	add_theme_support( 'custom-logo', array(
		'height'      => 65,
		'width'       => 330,
		'flex-width' => true,
		'flex-height' => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

}
add_action( 'after_setup_theme', 'App\\theme_prefix_setup' );


function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl','App\\my_login_logo_url' );

function my_login_logo_url_title() {
    return get_option('blogname');
}
add_filter( 'login_headertitle','App\\my_login_logo_url_title' );

//change the default WP login screen logo
function my_login_logo() {

	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	?>
    <style type="text/css">
        .login {
        	background-color: #ccc;
        }
        #login {
			width:50%  !important;
		}
		.login h1 a {
            background-image: url('<?php echo $logo[0]; ?>') !important;
			background-size:100% auto !important;
			width:340px !important;
			height:auto
        }
		@media (max-width: 768px) {
		  #login { width:100%;}
		  .login h1 a {
		  	width:240px !important;
		  }
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts','App\\my_login_logo', 1 );

/*Security measures*/
if(function_exists('remove_action')) {
	remove_action('wp_head', 'wp_generator');
}

// Redefine password from name and email, globally
add_filter( 'wp_mail_from', 'App\\wpse_new_mail_from' );
function wpse_new_mail_from( $old ) {
    return get_option('admin_email');
}

add_filter('wp_mail_from_name', 'App\\wpse_new_mail_from_name');
function wpse_new_mail_from_name( $old ) {
    return get_option('blogname');
}
//end

//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types){

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'App\\add_file_types_to_uploads');



//Unset the tag body class as it conflicts with bootstrap css
function bs4_remove_tag_body_class( $classes ) {
    if ( false !== ( $class = array_search( 'tag', $classes ) ) ) {
        unset( $classes[$class] );
    }
    return $classes;
}
add_filter( 'body_class', 'App\\bs4_remove_tag_body_class' );


//Remove emoji scripts introduced by WP 4.2
function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'App\\disable_emojicons_tinymce' );

}
add_action( 'init', 'App\\disable_wp_emojicons' );



//Add options page
if( function_exists('acf_add_options_page') ) {

 	// add sub page
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title' 	=> 'Theme Options',
		'parent_slug' 	=> 'options-general.php',
	));
 	// add sub page
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Museum Stats',
		'menu_title' 	=> 'Museum Stats',
		'parent_slug' 	=> 'options-general.php',
	));
}


/**** You can also make your custom sizes selectable from your WordPress admin. **/

add_filter( 'image_size_names_choose', 'App\\my_custom_sizes' );

function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'square@2x' => __( 'Large square' ),
        'square@1x' => __( 'Medium square' ),
        'header' => __( 'Header hero' ),
    ) );
}

/********************************************
/* Adding open graph sharing meta tags *****/
function hook_meta() {
	global $post;
	//default image, if there's no featured
	//image added via the options page under Settings --> Theme options
	$featured_img_url = get_field('social', 'option');


	//Facebook
	$output='<meta property="og:type" content="website">';
	$output.='<meta property="og:site_name" content="'.get_bloginfo("name").'">';
	//Twitter
	$twitter_handle = get_field('twitter_handle', 'option');
	$output='<meta name="twitter:site" content="@'.$twitter_handle.'">';
	$output='<meta name="twitter:creator" content="@'.$twitter_handle.'">';

	//if single post, use the content of the post
	if (is_single()) {
		//Twitter card to pull the image along with a tweet
		//check if featured image is set
		$featured = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "full" );
		if( $featured ) {
			$featured_img_url = $featured[0];
			$featured_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "thumbnail" );
			$featured_thumbnail_url = $featured_thumbnail[0];

			//use square thumbanil for twitter card
			$output.='<meta name="twitter:image" content="'.$featured_thumbnail_url.'">';
			$output.='<meta name="twitter:image:alt" content="'.str_replace('"','&quot;',get_the_title($post->ID)).'">';
		}

		//Facebook
		$output.='<meta property="og:url" content="'.get_the_permalink($post->ID).'">';
		$output.='<meta property="og:title" content="'.str_replace('"','&quot;',get_the_title($post->ID)).' | '.get_bloginfo("name").'">';
		$output.='<meta property="og:description" content="'.str_replace('"','&quot;',get_the_excerpt($post->ID)).'">';
		//Twitter
		$output.='<meta name="twitter:title" content="'.str_replace('"','&quot;',get_the_title($post->ID)).'">';
		$output.='<meta name="twitter:description" content="'.str_replace('"','&quot;',get_the_excerpt($post->ID)).'">';

	} else {
		//otherwise show general blog description and image
		$output.='<meta property="og:title" content="'.get_bloginfo("name").'">';
		$output.='<meta property="og:url" content="'.get_bloginfo("url").'">';
		$output.='<meta property="og:description" content="'.get_bloginfo("description").'">';
		//Twitter
		$output.='<meta name="twitter:card" content="summary_large_image">';
		$output.='<meta name="twitter:title" content="'.get_bloginfo("name").'">';
		$output.='<meta name="twitter:description" content="'.get_bloginfo("description").'">';
		$output.='<meta name="twitter:image" content="'.$featured_img_url.'">';
	}
	//Facebook image
	$output.='<meta property="og:image" content="'.$featured_img_url.'">';


	echo $output;
}
add_action('wp_head', 'App\\hook_meta');
/* END meta tags ****************************/


/********************************************/
//Find Us / Address widget
class find_us extends \WP_Widget {
	function __construct() {
		parent::__construct(
			'findus_widget', // Base ID
			esc_html__( 'Address widget', 'sage' ), // Name
			array( 'description' => esc_html__( 'Simple widget to display museum’s address', 'sage' ), )
		);
	}
	/**
	* Front-end display of widget.
	*
	* @see WP_Widget::widget()
	*
	* @param array $args     Widget arguments.
	* @param array $instance Saved values from database.
	*/
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		$address = get_field('street_address', 'option');
		$address .="<br>";
		$address .= get_field('secondary_street_address', 'option');
		$address .="<br>";
		$address .= get_field('city_address', 'option').", ";
		$address .= get_field('state_address', 'option')." ";
		$address .= get_field('zip_code_address', 'option');
		$address .="<br>";
		$address .= get_field('phone_number', 'option');

		echo $address;
		echo $args['after_widget'];
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'sage' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'sage' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}
}
add_action( 'widgets_init', function(){
     register_widget( 'App\\find_us' );
});

/* END find us widget  ****************************/

// hook add_query_vars function into query_vars
function mjh_add_query_vars($aVars) {
    $aVars[] = "on_exhibit";
    return $aVars;
}
add_filter('query_vars', 'App\\mjh_add_query_vars');

// hook add_rewrite_rules function into rewrite_rules_array
function mjh_add_rewrite_rules($aRules) {
    $aNewRules = array('exhibitions/on_exhibit/([^/]+)/?$' => 'index.php?post_type=exhibition&on_exhibit=$matches[1]');
    $aRules = $aNewRules + $aRules;
    return $aRules;
}
add_filter('rewrite_rules_array', 'App\\mjh_add_rewrite_rules');

// hook to modify the post query
function mjh_meta_query( $query ) {
    if ( $query->is_archive){
        switch($query->query_vars['post_type']){
            case'exhibition':
                if(isset($query->query_vars['on_exhibit'])) {
                    $on_exhibit = urldecode($query->query_vars['on_exhibit']);
                    $currentDate = strtotime('today midnight');
                    $queryHash = array();
                    switch($on_exhibit){
                        case'current':
                            $queryHash['relation'] = 'OR';
                            $queryHash[0] = array(
                                'key'	 	=> 'exhibition_type',
                                'value'	  	=> 'collection',
                                'compare' 	=> '=',
                            );

                            $queryHash[1]['relation'] = 'AND';
                            $queryHash[1][0] = array(
                                'key'	  	=> 'exhibition_start_date',
                                'value'	  	=> date('Y-m-d H:i:s', $currentDate),
                                'type'		=> 'DATETIME',
                                'compare' 	=> '<',
                            );
                            $queryHash[1][1] = array(
                                'key'	  	=> 'exhibition_end_date',
                                'value'	  	=> date('Y-m-d H:i:s', $currentDate),
                                'type'		=> 'DATETIME',
                                'compare' 	=> '>',
                            );
                        break;
                        case'upcoming':
                            $queryHash['relation'] = 'AND';
                            $queryHash[0] = array(
                                'key'	 	=> 'exhibition_type',
                                'value'	  	=> 'On View',
                                'compare' 	=> '=',
                            );
                             $queryHash[1] = array(
                                'key'	  	=> 'exhibition_start_date',
                                'value'	  	=> date('Y-m-d H:i:s', $currentDate),
                                'type'		=> 'DATETIME',
                                'compare' 	=> '>',
                            );
                        break;
                        case'past':
                            $queryHash['relation'] = 'AND';
                            $queryHash[0] = array(
                                'key'	 	=> 'exhibition_type',
                                'value'	  	=> 'On View',
                                'compare' 	=> '=',
                            );
                             $queryHash[1] = array(
                                'key'	  	=> 'exhibition_end_date',
                                'value'	  	=> date('Y-m-d H:i:s', $currentDate),
                                'type'		=> 'DATETIME',
                                'compare' 	=> '<',
                            );
                        break;
                    }
                    $query->set( 'meta_query', $queryHash );
                }
            break;
        }
    }
}
add_action( 'pre_get_posts', 'App\\mjh_meta_query', 1 );

// hook to modify the post where query for events
function mjh_events_posts_where( $where ) {
	$where = str_replace("meta_key = 'event_dates_%", "meta_key LIKE 'event_dates_%", $where);
	return $where;
}
