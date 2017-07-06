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
     * Return permalink
     *
     * @return varchar
     */
    public static function getPermalink($id = false)
    {
        if($id){
            return get_permalink($id);
        }
        return get_permalink();
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
        } elseif (get_field('testimony_platform',$id)) {
            //this is a testimony, use the video screenshot as featured image
            $image = App::featuredTestimonailImageSrc('large',$id);
        }
        if (!$image) {
            //use default image entered under social in theme toptions
            $image = get_field('social','option');
        }
        return $image;
    }

    /**
     * Return featured image of a testimononial src only
     *
     * @return string
     */
    public static function featuredTestimonailImageSrc($size='large',$id=false)
    {
        $image = "";
        if (!$id){
            $id = get_the_ID();
        }
        //is this a youtube, vimeo or other?
        $testimony_platform = get_field('testimony_platform',$id);
        //get the video ID (if set)
        $testimony_video_id = get_field('testimony_video_id',$id);

        if (has_post_thumbnail( $id ) ) {
            //if featured image set, use that
            $image = get_the_post_thumbnail_url($id, $size);
        } elseif($testimony_platform =='youtube' && $testimony_video_id) {
            $image = 'https://img.youtube.com/vi/'.$testimony_video_id.'/hqdefault.jpg';
        } elseif($testimony_platform =='vimeo' && $testimony_video_id) {
            $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$testimony_video_id.".php"));
            $image = $hash[0]['thumbnail_large'];
        }else {
            $image = get_field('social','option');
        }
        return $image;
    }

    /**
     * Return link for the video popup for testimonies
     *
     * @return url
     */
    public static function getTestimonyLink($id=false)
    {
        $url = '';
        if ($id) {
            //is this a youtube, vimeo or other?
            $testimony_platform = get_field('testimony_platform',$id);
            //get the video ID (if set)
            $testimony_video_id = get_field('testimony_video_id',$id);
            if($testimony_platform =='youtube') {
                $url = 'https://www.youtube.com/watch?v='.$testimony_video_id;
            } elseif($testimony_platform =='vimeo') {
                $url = 'https://vimeo.com/'.$testimony_video_id;
            }else {
                $url = get_the_permalink($id);
            }
        }
        return $url;
    }




    /**
     * Return featured image alt, pass post ID
     *
     * @return string
     */
    public static function featuredImageAlt($id=false)
    {
        $image_alt = "";
        if ($id) {
            $post_thumbnail_id = get_post_thumbnail_id($id);
            $image_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true);
        }
        return $image_alt;
    }

    /**
     * Return featured image description (used for photo credits)
     *
     * @return string
     */
    public static function featuredImageDesc($id=false)
    {
        $image_desc = "";
        if ($id) {
            $image_desc = get_post($id)->post_content;
        }
        return $image_desc;
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
     * Return the post terms
     *
     * @return array
     */
    public static function postTerms($id=false, $taxonomy = '')
    {
        if (!$id){
            $id = get_the_ID();
        }
        return get_the_terms($id,$taxonomy);
    }


    /**
     * Return the post categories in a string
     *
     * @return string
     */
    public static function postTermsString($id=false, $taxonomy = '')
    {
        $terms = App::postTerms($id, $taxonomy);
        $term_string = '';
        if(!empty($terms)){
            foreach ($terms as $key=> $term){
                if($key > 0){
                    $term_string.=", ";
                }
                $term_string.=$term->name;
            }
        }
        return $term_string;
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
        $excerpt = get_the_excerpt($id);
        if ($excerpt) {
            $excerpt = App::truncateString($excerpt, 16);
        }
        //also if the title is too long, hide the description
        if (strlen(get_the_title($id)) >30 && get_post_type($id)!='testimony') {
            return false;
        } else {
            return $excerpt;
        }

    }
    //used by various functions to truncate the string to specified number of words
    public static function truncateString($string, $limit=5) {
        if ($string) {
            if (str_word_count($string, 0) > $limit) {
                  $words = str_word_count($string, 2);
                  $pos = array_keys($words);
                  $string = substr($string, 0, $pos[$limit]) . '...';
              }
              return $string;
        }
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
    public static function addLayoutClasses()
    {
        $primary_sponsors_repeater = get_field('primary_sponsors_repeater');
        $secondary_sponsors_repeater = get_field('secondary_sponsors_repeater');
        $add_class = "";
        if (!$primary_sponsors_repeater && !$secondary_sponsors_repeater) {
            $add_class = 'no-sponsors';
        }
        //for exhibitions, also check if ticket is required, if not, add a free-admission class
        $exhibition_admission_required = get_field('exhibition_admission_required');
        if (!$exhibition_admission_required && get_post_type() == "exhibition") {
            $add_class .= ' free-admission';
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
        $young_friends = get_field('young_friends', 'option');

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
            $social .='<a href="'.$young_friends.'" target="_blank" onclick="return trackOutboundLink(\''.$young_friends.'\', true)" class="yf"><img src="'.get_stylesheet_directory_uri().'/dist/images/young-friends.png" alt="'.__("Young Friends","sage").'"></a>';
        }

        return $social;
    }
    /**
     * Get sticky default posts
     *
     * @return array
     */
    public static function getStickyPosts(){
        return  get_option( 'sticky_posts' );
    }

    /**
     * Get press sticky posts
     *
     * @return array
     */
    public static function getPressStickyPosts(){
        $sticky_posts = App::getStickyPosts();
        $pParamHash = array();
        if(!empty($sticky_posts)){
             foreach($sticky_posts as $post_id){
                if(has_category('press',$post_id)){
                    $pParamHash[] = $post_id;
                }
             }
        }
        return $pParamHash;
    }
    /**
     * Check current template with variable
     *
     * @return boolean
     */
    public static function isPageTemplate($page_template){
        $currentPageTemplate = get_page_template_slug();
        if($currentPageTemplate == $page_template){
            return true;
        }else{
            return false;
        }
    }
    /**
     * Get press category
     *
     * @return object
     */
    public static function getPressCategory(){
        return  get_term_by( 'slug', 'press', 'category');
    }

    /**
     * Get testimony category
     *
     * @return object
     */
    public static function getTestimonyCategory($id=false){
        
        $cats = '';
        if ($id) {
            $terms = wp_get_object_terms( $id, 'testimony_category' );

            foreach( $terms as $term )
                $term_names[] = $term->name;

            $cats = implode( ', ', $term_names );
        }
        return $cats;
    }

    /**
     * Compares start and end date and cleans output if same day
     *
     * @return string
     */
    public static function cleanDateOutput($start_date, $end_date){
        if( empty($end_date) ){
            return $start_date;
        }
        $start_date_day = date('Y-m-d', strtotime($start_date));
        $end_date_day = date('Y-m-d', strtotime($end_date));
        if($start_date_day == $end_date_day ){
            $date_output = $start_date;
        }else{
            $date_output = date('M j', strtotime($start_date))." &#8211; ".date('M j, Y', strtotime($end_date));
        }
        return $date_output;
    }
    /**
     * Evaluate if an event is PAST, returns true if past, requires start and end dates
     *
     * @return bool
     */
    public static function evalEventStatus($start_date, $end_date){
        return app::evalDateStatus($start_date, $end_date);
    }
    /**
     * Evaluate if date is in the past
     *
     * @return bool
     */
    public static function evalDateStatus($start_date, $end_date){
        //convert to timestamp 
        $start_date = strtotime($start_date);
        $end_date = strtotime($end_date);
        date_default_timezone_set('America/New_York');
        $now = strtotime('yesterday 11:59:59');
        if (!$start_date && !$end_date) {
            return false;
        } elseif($start_date == $end_date || !$end_date){
           //just look at the start date
            if ($now > $start_date) {
                return true; //passed
            } else {
                return false;
            }
        } else {
           //if the end date is in the future, this is not a past event
            //use the end date for comparison
            if ($now > $end_date) {
                return true; //passed

            } else {
                return false;
            }
        }
    }
    /**
     * Get secondary nav items, pass current page/post ID
     *
     * @return array
     */
    public static function getSubPageNav($id=false){
        if (!$id){
            $id = get_the_ID();
        }
        $pages = array();

        if (App::is_child($id) || App::is_ancestor($id)) {
            $parent_id = App::get_parent_id($id);
            $pages = App::get_submenu($parent_id);
        }
        return $pages;
    }
    //Get Parent id (used from template as well, hence public declaration)
    public static function get_parent_id( $id ) {
        $parent_id = wp_get_post_parent_id($id);
        if ($parent_id == 0) {
            //this is the parent, use its id
            $parent_id = $id;
        }
        return $parent_id;
    }

    // Check if page is direct child
    private static function is_child( $id ) {

        if( is_page() && (wp_get_post_parent_id( $id ) > 0) ) {
           return true;
        } else {
           return false;
        }
    }

    // Check if page is an ancestor
    public static function is_ancestor( $id ) {
       $children = get_pages( array( 'child_of' => $id ) );
        if( count( $children ) == 0 ) {
            return false;
        } else {
            return true;
        }
    }
    //get the subnav page links
    private static function get_submenu($parent) {
        $args = array(
            'sort_order' => 'asc',
            'sort_column' => 'post_title',
            'hierarchical' => 1,
            'exclude' => '',
            'include' => '',
            'meta_key' => '',
            'meta_value' => '',
            'authors' => '',
            'child_of' => $parent,
            'parent' => -1,
            'exclude_tree' => '',
            'number' => '',
            'offset' => 0,
            'post_type' => 'page',
            'post_status' => 'publish'
        );
        $pages = get_pages($args);
        return $pages;
    }
    /************ END Submenu *********************/

    /********** Paged navigation ******************/
    /**
     * Format pagination as numbered links
     *
     * @return string
     */
    public static function get_posts_nav() {
        $args = array(
            'mid_size'           => 4,
            'prev_next'          => false,
        );
        $pagination = get_the_posts_pagination( $args );

        return $pagination;
    }
    /**
     * Pagination for custom WP_Query executions
     *
     * @return string
     */
    public static function paginate_links ($max_num_pages){
      $big = 999999999; // need an unlikely integer
      return paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'mid_size'  => 4,
        'prev_next' => false,
        'total' => $max_num_pages
        ) );
    }
}
