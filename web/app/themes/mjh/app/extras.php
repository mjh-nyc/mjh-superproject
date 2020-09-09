<?php

namespace App;
use DateInterval;
use DateTime;
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

/**
* Add the site logo max-width option to the Site Identity section.
*/
/*function mjh_customize_register($wp_customize){
    $wp_customize->add_setting( 'custom_logo_max_width', array(
        'default'           => '363',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control(
        'custom_logo_max_width',
        array(
            'default'           => '363',
            'type'              => 'custom-range',
            'label'             => esc_html__( 'Logo Max Width', 'sage' ),
            'description'       => 'Enter the maximum width of the logo in px',
            'section'           => 'title_tagline',
            'priority'          => 8,
            'input_attrs'       => array(
                'min'           => 0,
                'max'           => 200,
                'step'          => 2,
            ),
        )
    );
}
add_action('customize_register', 'App\\mjh_customize_register');

//code to output the css into the header
function mjh_customize_css(){
    ?>
         <style type="text/css">
             .banner .custom-logo-link img { max-width: <?php echo get_theme_mod('custom_logo_max_width', '363') ."px"; ?>; }
         </style>
    <?php
}
add_action( 'wp_head', 'App\\mjh_customize_css');*/



function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl','App\\my_login_logo_url' );

function my_login_logo_url_title() {
    return get_option('blogname');
}
add_filter( 'login_headertext','App\\my_login_logo_url_title' );

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


//Update styles for the ACFPRO dropdown that was blowing up the layout
add_action('admin_head', 'App\\update_acfpro_dropdown_style');

function update_acfpro_dropdown_style() {
  echo '<style>
    .select2-container .select2-selection--single .select2-selection__rendered {
      white-space: normal;
    }
    .select2-selection.select2-selection--single {
        overflow:hidden;
    }
  </style>';
}

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
    // add sub page
    acf_add_options_sub_page(array(
        'page_title'    => 'Exhibition Options',
        'menu_title'    => 'Exhibition Options',
        'parent_slug'   => 'edit.php?post_type=exhibition',
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
/*function hook_meta() {
	global $post;
	//default image, if there's no featured
	//image added via the options page under Settings --> Theme options
	$featured_img_url = get_field('social', 'option');
	$site_description = get_field('site_description', 'option');

	//Facebook
	$output='<meta property="og:type" content="website">';
	$output.='<meta property="og:site_name" content="'.get_bloginfo("name").'">';

	//Twitter
	$twitter_handle = get_field('twitter_handle', 'option');
	$output.='<meta name="twitter:card" content="summary_large_image">';
	$output.='<meta name="twitter:site" content="@'.$twitter_handle.'">';
	$output.='<meta name="twitter:creator" content="@'.$twitter_handle.'">';


	//if single post, use the content of the post
	if (is_single() || is_page()) {
		//check if featured image is set
		$featured = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "large" );
		if( $featured ) {
			$featured_img_url = $featured[0];
		}
		//See if excerpt is set for this page or post
		$desc = get_the_excerpt($post->ID);
		if ($desc) {
			$desc = str_replace('"','&quot;',$desc);
		} else {
			//if not set, use generic one
			$desc = $site_description;
		}

		//Facebook
		$output.='<meta property="og:url" content="'.get_the_permalink($post->ID).'">';
		$output.='<meta property="og:title" content="'.str_replace('"','&quot;',get_the_title($post->ID)).' | '.get_bloginfo("name").'">';
		$output.='<meta name="description" property="og:description" content="'.$desc.'">';

		//Twitter
		$output.='<meta name="twitter:title" content="'.get_the_title($post->ID).' | '.get_bloginfo("name").'">';
		$output.='<meta name="twitter:description" content="'.$desc.'">';

	} else {
		//otherwise show general blog description and image
		//Facebook
		$output.='<meta property="og:title" content="'.get_bloginfo("name").'">';
		$output.='<meta property="og:url" content="'.get_bloginfo("url").'">';
		$output.='<meta property="description" content="'.$site_description.'">';
		$output.='<meta name="description" property="og:description" content="'.$site_description.'">';

		//Twitter
		$output.='<meta name="twitter:title" content="'.get_bloginfo("name").'">';
		$output.='<meta name="twitter:description" content="'.$site_description.'">';
	}
	//Facebook image
	$output.='<meta property="og:image" content="'.$featured_img_url.'">';

	//Twitter
	$output.='<meta name="twitter:image" content="'.$featured_img_url.'">';


	echo $output;
}
add_action('wp_head', __NAMESPACE__ . '\\hook_meta');*/
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
		$address = '<p>'.get_address().'</p>';
        if ( ! empty( $instance['link_label'] ) && ! empty( $instance['link_url'] ) ) {
            $address .= '<a href="'.$instance['link_url'].'" class="cta">'.$instance['link_label'].'</a>';
        }

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
        $link_label = ! empty( $instance['link_label'] ) ? $instance['link_label'] : '';
        $link_url = ! empty( $instance['link_url'] ) ? $instance['link_url'] : '';
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'sage' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'link_label' ) ); ?>"><?php esc_attr_e( 'Link label:', 'sage' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_label' ) ); ?>" type="text" value="<?php echo esc_attr( $link_label ); ?>">
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'link_url' ) ); ?>"><?php esc_attr_e( 'Link URL:', 'sage' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url' ) ); ?>" type="text" value="<?php echo esc_attr( $link_url ); ?>">
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
        $instance['link_label'] = ( ! empty( $new_instance['link_label'] ) ) ? strip_tags( $new_instance['link_label'] ) : '';
        $instance['link_url'] = ( ! empty( $new_instance['link_url'] ) ) ? strip_tags( $new_instance['link_url'] ) : '';

		return $instance;
	}
}
add_action( 'widgets_init', function(){
     register_widget( 'App\\find_us' );
});

/* END find us widget  ****************************/


//Redirect listing pages from archive template to custom templates
function redirect_listing_pages() {
    $path = '';
    if( !empty( $_SERVER['REDIRECT_URL'] ) ){
        $path =  $_SERVER['REDIRECT_URL'];
        $root_url = get_bloginfo('url');
        switch($path){
            case'/events/':
                wp_redirect( $root_url.'/current-events' );
                exit;
            case'/publications/':
                wp_redirect( $root_url.'/mjh-publications' );
                exit;
            case'/testimonies/':
                wp_redirect( $root_url.'/survivor-testimonies' );
                exit;
            break;
        }
    }
}
add_action( 'init', 'App\\redirect_listing_pages' );

// hook add_query_vars function into query_vars
function mjh_add_query_vars($aVars) {
    $aVars[] = "status";
    return $aVars;
}
add_filter('query_vars', 'App\\mjh_add_query_vars');

// hook add_rewrite_rules function into rewrite_rules_array
function mjh_add_rewrite_rules($aRules) {
    $aNewRules = array('exhibitions/status/([^/]+)/?$' => 'index.php?post_type=exhibition&status=$matches[1]');
    $aNewRulesPage = array('exhibitions/status/([^/]+)/page/?([0-9]{1,})/?$' => 'index.php?post_type=exhibition&status=$matches[1]&paged=$matches[2]');
    $aRules = $aNewRules + $aNewRulesPage + $aRules;
    return $aRules;
}
add_filter('rewrite_rules_array', 'App\\mjh_add_rewrite_rules');

// hook to modify the post query
function mjh_meta_query( $query ) {
    if ( $query->is_archive && empty($query-> is_admin) && !empty($query->query_vars['post_type'])){
        switch($query->query_vars['post_type']){
            case'exhibition':
                $currentDate = strtotime('today midnight');
                $queryHash = array();
                if(isset($query->query_vars['status'])) {
                    $status = urldecode($query->query_vars['status']);
                    switch($status){
                        case'upcoming':
                            $query->set('posts_per_page', 9);
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
                            $query->set('meta_key', 'exhibition_start_date');
                            $query->set('orderby', 'meta_value');
                            $query->set('order', 'ASC');
                        break;
                        case'past':
                            $query->set('posts_per_page', 9);
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
                            $query->set('meta_key', 'exhibition_start_date');
                            $query->set('orderby', 'meta_value');
                            $query->set('order', 'DESC');
                        break;
                        default:
                            $query->query_vars['status']='';
                            mjh_exhbitions_default( $queryHash );
                        break;
                    }
                }else{
                    mjh_exhbitions_default( $queryHash );
                }
                $query->set( 'meta_query', $queryHash );
            break;
        }
    }
}
add_action( 'pre_get_posts', 'App\\mjh_meta_query', 1 );

// helper function to set default exhibition list query
function mjh_exhbitions_default( &$queryHash ) {
	$currentDate = strtotime('today');
	$queryHash['relation'] = 'OR';
    $queryHash[0] = array(
        'key'	 	=> 'exhibition_type',
        'value'	  	=> 'collection',
        'compare' 	=> '=',
    );

    $queryHash[1]['relation'] = 'AND';
    $queryHash[1][0] = array(
        'key'	  	=> 'exhibition_start_date',
        'value'	  	=> date('Ymd', $currentDate),
        'type'		=> 'NUMERIC',
        'compare' 	=> '<=',
    );
    $queryHash[1][1] = array(
        'key'	  	=> 'exhibition_end_date',
        'value'	  	=> date('Ymd', $currentDate),
        'type'		=> 'NUMERIC',
        'compare' 	=> '>=',
    );
}
function mjh_acf_save_post( $post_id ) {
    // bail early if no ACF data
    if( empty($_POST['acf']) || empty($_POST['post_type'])) {
        return;
    }
     switch( $_POST['post_type'] ){
        case 'event':
            if(!isset($_POST['acf']['field_5930950a5dfdb'])){
                $_POST['acf']['field_5930950a5dfdb']='';
            }
        break;
    }
}

add_action('acf/save_post', 'APP\\mjh_acf_save_post', 1);


//Update tites of the listing pages, using archives wp template
add_filter( 'get_the_archive_title', function ( $title ) {
   if ( is_category() ) {
        /* translators: Category archive title. 1: Category name */
        $title = sprintf( __( 'Category: %s' ), single_cat_title( '', false ) );
    } elseif ( is_tag() ) {
        /* translators: Tag archive title. 1: Tag name */
        $title = sprintf( __( 'Tag: %s' ), single_tag_title( '', false ) );
    } elseif ( is_author() ) {
        /* translators: Author archive title. 1: Author name */
        $title = sprintf( __( 'Stories by %s' ), '<span class="vcard">' . get_the_author() . '</span>' );
    } elseif ( is_year() ) {
        /* translators: Yearly archive title. 1: Year */
        $title = sprintf( __( 'Year: %s' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) );
    } elseif ( is_month() ) {
        /* translators: Monthly archive title. 1: Month name and year */
        $title = sprintf( __( 'Month: %s' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) );
    } elseif ( is_day() ) {
        /* translators: Daily archive title. 1: Date */
        $title = sprintf( __( 'Day: %s' ), get_the_date( _x( 'F j, Y', 'daily archives date format' ) ) );
    } elseif ( is_post_type_archive() ) {
        /* translators: Post type archive title. 1: Post type name */
        $title = sprintf( __( ''.get_query_var('status').' %s' ), post_type_archive_title( '', false ) );
    } elseif ( is_tax() ) {
        $tax = get_taxonomy( get_queried_object()->taxonomy );
        /* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
        $title = sprintf( __( '%1$s: %2$s' ), $tax->labels->singular_name, single_term_title( '', false ) );
    } else {
        $title = __( 'Archives' );
    }
    return $title;
});


/******************************/
/*** Set up shortcodes ********/
//Get phone number
function get_phone( $atts="" ) {
	return get_field('phone_number', 'option');
}
add_shortcode( 'phone', 'App\\get_phone' );

//Get address
function get_address( $atts="" ) {
	$address = get_field('street_address', 'option');
	$address .="<br>";
	$address .= get_field('secondary_street_address', 'option');
	$address .="<br>";
	$address .= get_field('city_address', 'option').", ";
	$address .= get_field('state_address', 'option')." ";
	$address .= get_field('zip_code_address', 'option');
	$address .="<br>";
	return $address;
}
add_shortcode( 'address', 'App\\get_address' );

//Get openning hours
function get_hours( $atts="" ) {
    // Set up variables
    $regularHours =  get_field('regular_hours_repeater', 'option');
    $holidays =  get_field('holiday_hours_repeater', 'option');
    $currentTimeZone = get_option('timezone_string');
    date_default_timezone_set($currentTimeZone);
    $currentDay = date('l', strtotime('today midnight'.$currentTimeZone));
    $hours = '';
    //Get current week date span
    $date = new DateTime(date('Y-m-d',strtotime('last sunday')));
    $weekDatesHash = array();
    $weekDatesHash[$date->format('l')] = array('date'=>$date->format('Y-m-d'));
    for($i=0; $i < 6; $i++){
        $date->add(new DateInterval('P1D'));
        $weekDatesHash[$date->format('l')] = array('date'=>$date->format('Y-m-d'));
    }
    if(!empty($regularHours)) {
        //Set hours to respective date of the week and add additional information
        foreach ($regularHours as $hour) {
            $weekDatesHash[$hour['day_of_week']]['hours'] = $hour;
            if ($currentDay == $hour['day_of_week']) {
                $weekDatesHash[$hour['day_of_week']]['active_date'] = true;
            } else {
                $weekDatesHash[$hour['day_of_week']]['active_date'] = false;
            }
            //Loop through holidays
            if (!empty($holidays)) {
                $tomorrowDate = date('Y-m-d', strtotime($weekDatesHash[$hour['day_of_week']]['date'] . ' +1day'));
                foreach ($holidays as $key => $holiday) {
                    $holidayDate = date('Y-m-d', strtotime($holiday['holiday_date']));
                    // Check if date is a holiday
                    if ($holidayDate == $weekDatesHash[$hour['day_of_week']]['date']) {
                        $weekDatesHash[$hour['day_of_week']]['holiday'] = $holiday;
                    }
                    //Check if date is an eve of a holiday
                    if ($holidayDate == $tomorrowDate) {
                        $weekDatesHash[$hour['day_of_week']]['holiday_eve'] = true;
                    }
                }
            }
        }
        if (!empty($weekDatesHash)):
            $hours = '<div class="schedule row">';
            // loop through weekly data hash
            $prev_exception = ""; //keep track of prev day in case the next in loop repeats, just print an asterisk and move the hours into the footnote
            $exception_notice = false;
            foreach ($weekDatesHash as $day => $weekDay) :
                $exception_start = $weekDay['hours']['hours_start_date_range'];
                $exception_end = $weekDay['hours']['hours_end_date_range'];
                $opening_hour = $weekDay['hours']['opening_hour'];
                $closing_hour = $weekDay['hours']['closing_hour'];
                $activeClass = '';
                //Check if this date is today to set an active class
                if (!empty($weekDay['active_date'])) {
                    $activeClass = ' active ';
                }
                if (!$exception_start) {
                    $hours .= '<div class="col-4 day' . $activeClass . '">';
                    $hours .= $day;
                    $hours .= $prev_exception;
                    $prev_exception = "";
                    $hours .= '</div>';
                    $hours .= '<div class="col-8 hours' . $activeClass . '">';
                    //Set hours based on ruleset
                    if ($weekDay['hours']['is_museum_closed']) {
                        $hours .= __("Closed", "sage");
                    } elseif (!empty($weekDay['holiday'])) {
                        if ($weekDay['holiday']['is_museum_closed']) {
                            $hours .= __("Closed", "sage");
                        } else {
                            $hours .= $weekDay['holiday']['opening_hour'];
                            $hours .= ' &#8211; ';
                            $hours .= $weekDay['holiday']['closing_hour'];
                        }
                    } elseif (!empty($weekDay['holiday_eve'])) {
                        $hours .= get_field('holiday_eve_opening_hour', 'option');
                        $hours .= ' &#8211; ';
                        $hours .= get_field('holiday_eve_closing_hour', 'option');
                    } else {
                        $hours .= $opening_hour;
                        $hours .= ' &#8211; ';
                        $hours .= $closing_hour;
                    }
                    $hours .= '</div>';
                } else {
                    $prev_exception = " *";
                    $exception_notice .= '<br><span style="display: block; margin-left: 14px;">From <strong>' . $exception_start . '</strong> through <strong>' . $exception_end . '</strong>, we will be open from <strong>' . $opening_hour . '</strong> to <strong>' . $closing_hour . '</strong> on <strong>' . $day . 's.</strong></span>';
                }
            endforeach;
            $hours .= '</div>';
            //add exceptions notes if encountered
            if ($exception_notice) {
                $hours .= '<div class="alert alert-warning">';
                $hours .= __("* Note that our hours change during these times:", "sage");
                $hours .= $exception_notice;
                $hours .= '</div>';
            }
        endif;
    }

	return $hours;
}
add_shortcode( 'hours', 'App\\get_hours' );

//Get holidays opening hours
function get_holiday_hours( $atts="" ) {
	// check if the repeater field has rows of data
	$hours = '';
    if( have_rows('holiday_hours_repeater','options') ):
		$hours = '<div class="schedule row">';
	 	// loop through the rows of data
		while ( have_rows('holiday_hours_repeater','options') ) : the_row();

	        $holiday = get_sub_field('holiday_name');
	        $holiday_date = get_sub_field('holiday_date');
	        $opening_hour = get_sub_field('opening_hour');
	        $closing_hour = get_sub_field('closing_hour');

	        $hours .= '<div class="col-sm-7">';
		        $hours .= '<strong>';
		        $hours .= $holiday_date;
		        $hours .= '</strong>';
		        $hours .= ', ';
		        $hours .= $holiday;

		    $hours .= '</div>';
		    $hours .= '<div class="col-sm-5 hours">';

		        if (get_sub_field('is_museum_closed')) {
		        	$hours .= __("Closed","sage");
		        } else {
			        $hours .= $opening_hour;
			        $hours .= ' &#8211; ';
			        $hours .= $closing_hour;
			    }

		    $hours .= '</div>';
	    endwhile;
	    $hours .='</div>';
	endif;

	return $hours;
}
add_shortcode( 'holidays', 'App\\get_holiday_hours' );

//Get schedule notes
function get_hours_notes( $atts="" ) {
	return get_field('regular_hours_additional_notes', 'option');
}
add_shortcode( 'hours-notes', 'App\\get_hours_notes' );

//Get holiday notes
function get_holiday_notes( $atts="" ) {
	return get_field('holiday_additional_notes', 'option');
}
add_shortcode( 'holiday-notes', 'App\\get_holiday_notes' );

//Create a sitemap of pages
//https://developer.wordpress.org/reference/functions/wp_list_pages/
function make_sitemap( $atts="" ) {
	$sitemap = "";
	/*$args = array(
		'child_of' => 0,
		'authors' => '',
		'depth' => 0,
		'echo' => false,
		'exclude' => '',
		'include' => '',
		'link_after' => '',
		'link_before' => '',
		'post_type' => 'page',
		'post_status' => 'publish',
		'sort_column' => 'post_title',
		'title_li' => '<h2 class="sitemap-header">Pages</h2>',
	);

	$sitemap = "<ul>" . wp_list_pages($args) . "</ul>";*/
	$sitemap = wp_nav_menu(get_nav_args('primary_navigation'));
	$sitemap .= wp_nav_menu(get_nav_args('minitop_navigation'));
	$sitemap .= wp_nav_menu(get_nav_args('buttontop_navigation'));
	$sitemap .= wp_nav_menu(get_nav_args('footer_navigation'));

	return $sitemap;
}
function get_nav_args($nav) {
	$args = array(
		'theme_location' => $nav,
		'menu_class' => 'sitemap-tree',
		'menu_id' => 'sitemap_'.$nav,
		'container' => '',
		'container_class' => '',
		'container_id' => '',
		'echo' => false,
	);
	return $args;
}
add_shortcode( 'sitemap', 'App\\make_sitemap' );

//Get emma signup form
function get_emma_signup_form( ) {
    $signup_form = '<div class="signup-form">';
    $signup_form.= '<div class="signup-form--message" style="display: none"></div>';
    $signup_form.= '<div class="signup-form--fields">';
    $signup_form.= '<div class="signup-form--field"><label for="email">'.__('Email','sage').'</label><span class="required">*</span>';
    $signup_form.= '<input id="email" name="email" type="text" /></div>';
    $signup_form.= '</div>';
    $signup_form.= '<div class="signup-form--fields">';
    $signup_form.= '<div class="signup-form--field"><label for="first_name">'.__('First Name','sage').'</label><span class="required">*</span>';
    $signup_form.= '<input id="first_name" name="first_name" type="text" /></div>';
    $signup_form.= '<div class="signup-form--field"><label for="last_name">'.__('Last Name','sage').'</label><span class="required">*</span>';
    $signup_form.= '<input id="last_name" name="last_name" type="text" /></div>';
    $signup_form.= '</div>';
    $signup_form.= '<div class="signup-form--fields">';
    $signup_form.= '<div class="signup-form--field"><label for="zip">'.__('Zip','sage').'</label><span class="required">*</span>';
    $signup_form.= '<input id="zip" name="zip" type="text" /></div>';
    $signup_form.= '</div>';
    $signup_form.= '<div class="signup-form--fields">';
    $signup_form.='<a id="signup-btn" class="cta-round cta-arrow cta-secondary" href="#">'.__('Sign Up!','sage').'</a>';
    $signup_form.= '</div>';
    $signup_form.= '</div>';
    return $signup_form;
}
add_shortcode( 'emma_signup_form', 'App\\get_emma_signup_form' );

/***** //END Shortcodes ********/

/*** Set up ajax requests ********/
// Set up ajax function listener
add_action('wp_ajax_mjhAjaxEvents', 'App\\mjh_ajax_events');
add_action('wp_ajax_nopriv_mjhAjaxEvents', 'App\\mjh_ajax_events');

function mjh_ajax_events(){
    //Array hash to return to browser
    $pParamHash = array();
    //Get variables from ajax request
    $request = (string) $_REQUEST['request'];
    $email = (string)$_REQUEST['email'];
    $first_name = (string)$_REQUEST['first_name'];
    $last_name = (string)$_REQUEST['last_name'];
    $zip = (string)$_REQUEST['zip'];
    // Check the referrer for the ajax call (setup.php creates nonce)
    check_ajax_referer('mjh_ajax_nonce', 'mjh_nonce');
    switch ($request) {
        case 'signupEmail':
            //Get account credentials and group data
            $account_id = get_field('emma_account_id','options');
            $public_api_key = get_field('emma_public_api_key','options');
            $private_api_key = get_field('emma_private_api_key','options');
            $groups = explode(',',get_field('emma_groups','options'));
            //Set up user data
            $member_data = array(
                "email" => $email,
                "fields" => array(
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "postal_code" => $zip
                ),
                "group_ids" => $groups
            );
            //Api Endpoint
            $url = "https://api.e2ma.net/".$account_id."/members/add";
            //Execute the api call to add a member to the emma api
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_USERPWD, $public_api_key . ":" . $private_api_key);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, count($member_data));
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($member_data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSLVERSION, 6);
            $head = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            //Check the response code and return boolean
            if($http_code > 200) {
                $pParamHash['signupSuccess'] = false;
            } else {
                $pParamHash['signupSuccess'] = true;
            }
        break;
    }
    //Return to browser with data hash
    wp_send_json_success($pParamHash);
}
/***** //END ajax request ********/
