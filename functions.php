<?php
require_once(ABSPATH . 'wp-config.php'); 
require_once(ABSPATH . 'wp-includes/wp-db.php'); 
require_once(ABSPATH . 'wp-admin/includes/taxonomy.php'); 

add_filter( 'bbp_verify_nonce_request_url', 'my_bbp_verify_nonce_request_url', 999, 1 );
function my_bbp_verify_nonce_request_url( $requested_url )
{
	return 'http://localhost:8888' . $_SERVER['REQUEST_URI'];
}

function wpb_adding_scripts() {
	wp_register_script('studenthub-tabs', get_stylesheet_directory_uri().'/scripts/switch-tab.js');
	wp_enqueue_script('studenthub-tabs');
}

add_action( 'wp_enqueue_scripts', 'wpb_adding_scripts' ); 

function register_my_menus() {
	register_nav_menus(
			array(
					'fixed-menu' => __( 'Fixed Menu' ),
			)
			);
}
add_action( 'init', 'register_my_menus' );

// make sure that all the categories are created

wp_create_category( "systems" );
wp_create_category( "respiratory", "systems" );
wp_create_category( "cardiovascular", "systems" );
wp_create_category( "gi", "systems" );
wp_create_category( "dermatology", "systems" );
wp_create_category( "endocrine", "systems" );
wp_create_category( "child and family", "systems" );
wp_create_category( "ophthalmology", "systems" );
wp_create_category( "ent", "systems" );
wp_create_category( "renal", "systems" );
wp_create_category( "ageing", "systems" );
wp_create_category( "neurology", "systems" );
wp_create_category( "psychiatry", "systems" );
wp_create_category( "reproduction & sexual health", "systems" );
wp_create_category( "haematology", "systems" );

wp_create_category( "clinical-blocks" );
wp_create_category( "general medicine", "clinical-blocks" );
wp_create_category( "general surgery", "clinical-blocks" );
wp_create_category( "obs & gynae", "clinical-blocks" );
wp_create_category( "gp", "clinical-blocks" );

wp_create_category( "themes");

?>
