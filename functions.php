<?php
require_once (ABSPATH . 'wp-config.php');
require_once (ABSPATH . 'wp-includes/wp-db.php');
require_once (ABSPATH . 'wp-admin/includes/taxonomy.php');

add_filter ( 'bbp_verify_nonce_request_url', 'my_bbp_verify_nonce_request_url', 999, 1 );
add_action('wp_enqueue_scripts', 'wpb_adding_scripts' );

add_action('after_switch_theme', "studenthub_init");
add_action('after_setup_theme', 'studenthub_init_globals');

add_action('bbp_new_topic', 'studenthub_save_topic', 1, 4);
add_action('bbp_new_topic_pre_extras', 'studenthub_check_topic', 1);

add_action('wp_ajax_studenthub_reload_feed', 'studenthub_reload_feed');

// required for local development
function my_bbp_verify_nonce_request_url($requested_url) {
	return 'http://localhost:8888' . $_SERVER ['REQUEST_URI'];
}

// register Javascript
function wpb_adding_scripts() {
	
	wp_register_script ( 'jquery', get_stylesheet_directory_uri () . '/scripts/jquery/jquery.js' );
	wp_enqueue_script ( 'jquery' );
	
	wp_register_script ( 'jquery-ui', get_stylesheet_directory_uri () . '/scripts/jquery/jquery-ui.js' );
	wp_enqueue_script ( 'jquery-ui' );
	
	wp_register_script ( 'jquery-multiselect', get_stylesheet_directory_uri () . '/scripts/jquery.multiselect/jquery.multiselect.js' );
	wp_enqueue_script ( 'jquery-multiselect' );
	
	wp_localize_script( 'ajax-feed', 'ajaxfeed', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
	));
	
	wp_register_script ( 'studenthub-tabs', get_stylesheet_directory_uri () . '/scripts/switch-tab.js' );
	wp_enqueue_script ( 'studenthub-tabs' );
	
}

function studenthub_reload_feed() {
	locate_template( array( 'topic-loop.php'), true );
	die();	
}

// add our additional functionality into BBPress forum topic posting
function studenthub_check_topic($forum_id) {
	if (empty($_POST["studenthub-subject-select"])) {
		bbp_add_error( 'studenthub-area', __( '<strong>ERROR</strong>: No subject area(s) were indicated', 'bbpress' ) );
	}
}

function studenthub_save_topic($topic_id, $forum_id, $anonymous_data, $topic_author) {
	// set the categories for the topic
	if (!empty($_POST["studenthub-subject-select"])) {
		$categories = $_POST["studenthub-subject-select"];
		$categoryIds = [];
		foreach ($categories as $name) {
			$categoryIds[$name] = get_cat_ID($name);
		}
		
		wp_set_object_terms($topic_id, $categoryIds, "category");
	}
	
	// set the topic-type
	$type = get_term_by('name', $_POST["resource-type"], 'topic-type' );
	wp_set_object_terms($topic_id, $type -> term_id, "topic-type");
}


function studenthub_init() {
	// make sure that the menu is created - we don't want to do this in the admin dashboard as it would need to be configured on every new installation
	$menuname = "main-menu";
	$menu_exists = wp_get_nav_menu_object ( $menuname );
	
	if (! $menu_exists) {
		$menu_id = wp_create_nav_menu ( $menuname );
		
		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ( 'StudentHub' ),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url ( '/' ),
				'menu-item-status' => 'publish' 
		) );
		
		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ( 'StudyZone' ),
				'menu-item-classes' => 'studyzone',
				'menu-item-url' => home_url ( '/studyzone/' ),
				'menu-item-status' => 'publish' 
		) );
		
		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ( 'Societies' ),
				'menu-item-classes' => 'societies',
				'menu-item-url' => home_url ( '/societies/' ),
				'menu-item-status' => 'publish' 
		) );
		
		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ( 'MSC' ),
				'menu-item-classes' => 'msc',
				'menu-item-url' => home_url ( '/MSC/' ),
				'menu-item-status' => 'publish' 
		) );
		
		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ( 'Peer Mentors' ),
				'menu-item-classes' => 'peer-mentors',
				'menu-item-url' => home_url ( '/peer-mentors/' ),
				'menu-item-status' => 'publish' 
		) );
		
		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ( 'Profile' ),
				'menu-item-classes' => 'profile',
				'menu-item-url' => home_url ( '/profile/' ),
				'menu-item-status' => 'publish' 
		) );
		
		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ( 'MedBlogs' ),
				'menu-item-classes' => 'medblogs',
				'menu-item-url' => home_url ( 'http://medblogs.dundee.ac.uk' ),
				'menu-item-status' => 'publish' 
		) );
		
		$locations = get_theme_mod ( 'nav_menu_locations' );
		$locations ['fixed-menu'] = $menu_id;
		set_theme_mod ( 'nav_menu_locations', $locations );
	}
}

function studenthub_init_globals() {
	// make sure that all the categories are created
	$system = wp_create_category ( "systems" );
	wp_create_category ( "respiratory", $system );
	wp_create_category ( "cardiovascular", $system );
	wp_create_category ( "gi", $system );
	wp_create_category ( "dermatology", $system );
	wp_create_category ( "endocrine", $system );
	wp_create_category ( "child and family", $system );
	wp_create_category ( "ophthalmology", $system );
	wp_create_category ( "ent", $system );
	wp_create_category ( "renal", $system );
	wp_create_category ( "ageing", $system );
	wp_create_category ( "neurology", $system );
	wp_create_category ( "psychiatry", $system );
	wp_create_category ( "reproduction and sexual health", $system );
	wp_create_category ( "haematology", $system );
	$GLOBALS["systems"] = $system;
	
	$clinical_blocks = wp_create_category ( "clinical-blocks" );
	wp_create_category ( "general medicine", $clinical_blocks );
	wp_create_category ( "general surgery", $clinical_blocks );
	wp_create_category ( "obs and gynae", $clinical_blocks );
	wp_create_category ( "gp", $clinical_blocks );
	$GLOBALS["clinical_blocks"] = $clinical_blocks;
	
	$themes = wp_create_category ( "themes" );
	wp_create_category ( "anatomy", $themes );
	wp_create_category ( "physiology", $themes );
	wp_create_category ( "pathology", $themes );
	wp_create_category ( "public health", $themes );
	$GLOBALS["themes"] = $themes;
	
	
}
?>
