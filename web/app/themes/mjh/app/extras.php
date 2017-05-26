<?php

namespace App;

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
        #login {
			width:50%  !important;
		}
		.login h1 a {
            background-image: url('<?php echo $logo[0]; ?>') !important;
            padding-bottom: 30px !important;
			background-size:100% auto !important;
			width:340px !important;
			height:130px !important;
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
