<?php
require_once(ABSPATH . 'wp-config.php'); 
require_once(ABSPATH . 'wp-includes/wp-db.php'); 
require_once(ABSPATH . 'wp-admin/includes/taxonomy.php'); 

add_filter( 'bbp_verify_nonce_request_url', 'my_bbp_verify_nonce_request_url', 999, 1 );
function my_bbp_verify_nonce_request_url( $requested_url )
{
	return 'http://localhost:8888' . $_SERVER['REQUEST_URI'];
}

// register Javascript
function wpb_adding_scripts() {
	wp_register_script('studenthub-tabs', get_stylesheet_directory_uri().'/scripts/switch-tab.js');
	wp_enqueue_script('studenthub-tabs');
}

add_action( 'wp_enqueue_scripts', 'wpb_adding_scripts' ); 

// make sure that the menu is created - we don't want to do this in the admin dashboard as it would need to be configured on every new installation
$menuname = "main-menu";
$menu_exists = wp_get_nav_menu_object( $menuname );

if (!$menu_exists) {
	$menu_id = wp_create_nav_menu($menuname);

	wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' =>  __('StudentHub'),
			'menu-item-classes' => 'home',
			'menu-item-url' => home_url( '/' ),
			'menu-item-status' => 'publish'));

	wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' =>  __('StudyZone'),
			'menu-item-classes' => 'studyzone',
			'menu-item-url' => home_url( '/studyzone/' ),
			'menu-item-status' => 'publish'));

	wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' =>  __('Societies'),
			'menu-item-classes' => 'societies',
			'menu-item-url' => home_url( '/societies/' ),
			'menu-item-status' => 'publish'));

	wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' =>  __('MSC'),
			'menu-item-classes' => 'msc',
			'menu-item-url' => home_url( '/MSC/' ),
			'menu-item-status' => 'publish'));

	wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' =>  __('Peer Mentors'),
			'menu-item-classes' => 'peer-mentors',
			'menu-item-url' => home_url( '/peer-mentors/' ),
			'menu-item-status' => 'publish'));

	wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' =>  __('Profile'),
			'menu-item-classes' => 'profile',
			'menu-item-url' => home_url( '/profile/' ),
			'menu-item-status' => 'publish'));

	wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' =>  __('MedBlogs'),
			'menu-item-classes' => 'medblogs',
			'menu-item-url' => home_url( 'http://medblogs.dundee.ac.uk' ),
			'menu-item-status' => 'publish'));

	$locations = get_theme_mod('nav_menu_locations');
	$locations['fixed-menu'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}
	
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
