<?php
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
?>
