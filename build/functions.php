<?php
require_once (ABSPATH . 'wp-config.php');
require_once (ABSPATH . 'wp-includes/wp-db.php');
require_once (ABSPATH . 'wp-admin/includes/taxonomy.php');
require_once (ABSPATH . 'wp-content/plugins/buddypress/bp-groups/bp-groups-functions.php');
require_once ('content/post-form-widget.php');
require_once ('content/post-reply-form-widget.php');
require_once ('content/comments-loop-widget.php');
require_once ('content/category-logo-widget.php');
require_once ('content/link-widget.php');
require_once ('content/favourite-widget.php');

add_action ( 'wp_enqueue_scripts', 'studenthub_scripts' );
add_action ( 'after_setup_theme', 'studenthub_init_globals' );
add_action ( 'wp_enqueue_scripts', 'topic_loop_js' );
add_filter( 'comment_text', 'make_clickable', 12 );
add_filter( 'the_content', 'make_clickable', 12 );
add_filter('show_admin_bar', '__return_false');

function topic_loop_js() {
	wp_register_script ( 'studenthub-topic-loop', get_stylesheet_directory_uri () . '/scripts/topic-loop.js' );
	wp_enqueue_script ( 'studenthub-topic-loop' );
}
function studenthub_scripts() {
	wp_register_script ( 'jquery', get_stylesheet_directory_uri () . '/scripts/jquery/jquery.js' );
	wp_enqueue_script ( 'jquery' );
	
	wp_register_script ( 'jquery.form', get_stylesheet_directory_uri () . '/scripts/jquery.form/jquery.form.js' );
	wp_enqueue_script ( 'jquery.form' );
	
	wp_register_script ( 'jquery-ui', get_stylesheet_directory_uri () . '/scripts/jquery/jquery-ui.js' );
	wp_enqueue_script ( 'jquery-ui' );
	
	wp_register_script ( 'jquery-multiselect', get_stylesheet_directory_uri () . '/scripts/jquery.multiselect/jquery.multiselect.js' );
	wp_enqueue_script ( 'jquery-multiselect' );
	
	wp_localize_script ( 'ajax-feed', 'ajaxfeed', array (
			'ajaxurl' => admin_url ( 'admin-ajax.php' ) 
	) );
	
	wp_register_script ( 'studenthub-groups', get_stylesheet_directory_uri () . '/scripts/groups.js' );
	wp_enqueue_script ( 'studenthub-groups' );
	
	wp_register_script ( 'studenthub-register-society', get_stylesheet_directory_uri () . '/scripts/page-register-society.js' );
	wp_enqueue_script ( 'studenthub-register-society' );
}

function studenthub_init_globals() {
	$GLOBALS ["systems"] = wp_create_category ( "systems" );
	$GLOBALS ["clinical_blocks"] = wp_create_category ( "clinical-blocks" );
	$GLOBALS ["themes"] = wp_create_category ( "themes" );
	$GLOBALS ["locations"] = wp_create_category ( "locations" );
	$GLOBALS ["assessment"] = wp_create_category ( "assessment" );
	$GLOBALS ["year_groups"] = wp_create_category ( "year-groups" );
}

function sh_header_image_uri() {
	global $post;
	
	if ($post) {
		if (has_post_thumbnail($post)) {
			return wp_get_attachment_image_src( get_post_thumbnail_id($post), 'full')[0];
		}
		if (file_exists ( get_stylesheet_directory () . '/images/header-'.$post -> post_name.'.png' )) {
			return get_stylesheet_directory_uri () . '/images/header-'.$post -> post_name.'.png';
		}
	}
	return get_stylesheet_directory_uri().'/images/header-studenthub.png';
}

function sh_sidebar() {
	if (is_front_page ()) {
		the_widget('deadlines_widget', array(), array());
	} 
	else {
		// first look for dynamic page specific sidebar
		$found = dynamic_sidebar ( 'page-' . get_the_ID () . '-sidebar' );
		
		if (! $found) {
			get_template_part ( 'content/sidebar', get_post_type () );
		}
	}
}

function sh_page_menu() {
	global $post;
	if ($post) {
		$nav_menus = wp_get_nav_menus();
		foreach ($nav_menus as $menu) {
			if ($menu -> name == $post->post_name.'-submenu') {
				wp_nav_menu(array('menu' => $post->post_name.'-submenu'));
			}
		}
	}
}

/**
 * Load the page specific template if it exists, otherwise default to the post form & topic loop.
 */
function sh_page_content() {
	global $post, $wp_query;
	
	// if there's a specific page template, then redirect to this
	$action = get_query_var ( 'sh_action' );
	$type = get_query_var ( 'sh_post_type' );
	
	if ($action == 'new') {
		$template = locate_template (array('edit/'.$type.'.php') );
		if ($template != '') {
			include ($template);
		}
		return;
	} 
	else if ($action == 'edit') {
		$template = locate_template ( array (
				'edit/' . $post->post_type . '-' . get_query_var ( 'sh_part' ) . '.php',
				'edit/' . $post->post_type . '.php' 
		) );
		if ($template != '') {
			include ($template);
		}
		return;
	} 
	else if ($post) {
		$template = locate_template ( array (
				'content/page-' . $post->post_name . '.php',
				'content/' . $post->post_type . '.php' 
		) );
		
		if ($template != '') {
			include ($template);
			return;
		}
	}
	
	// otherwise, show the new post form and feed
	sh_post_form ();
	sh_topic_loop ();
}
function sh_post_form() {
	$forumIds = array ();
	$forums = get_post_meta ( get_the_ID (), 'sh_forums', true );
	if ($forums) {
		// for a page, we have a map of forums that should be shown on the page, indicating whether we can post to them
		foreach ( $forums as $forumInfo ) {
			if (array_key_exists ( 'can_post', $forumInfo ) && $forumInfo ['can_post']) {
				if (sh_can_user_post_in_forum ( $forumInfo ['id'] )) {
					array_push ( $forumIds, $forumInfo ['id'] );
				}
			}
		}
	} 
	else {
		// for a society
		$forum = get_post_meta ( get_the_ID (), 'sh_forum', true );
		if ($forum && sh_can_user_post_in_forum ( $forum )) {
			array_push ( $forum );
		}
	}
	// include a direct check for post type... for an actual forum
	if (count ( $forumIds ) > 0) {
		$widget = new Post_Form_Widget ();
		$widget->output ( array (
				'forums' => $forumIds 
		) );
	}
}

// make this more specific later (and move to plugin)
function sh_can_user_post_in_forum($id) {
	return true;
}
function sh_topic_loop() {
	$forumIds = array ();
	
	$forums = get_post_meta ( get_the_ID (), 'sh_forums', true );
	if ($forums) {
		// for a page, we have a map of forums that should be shown on the page, indicating whether we can post to them
		foreach ( $forums as $forumInfo ) {
			array_push ( $forumIds, $forumInfo ['id'] );
		}
	} else {
		// for a society
		$forum = get_post_meta ( get_the_ID (), 'sh_forum', true );
		if ($forum) {
			array_push ( $forum );
		}
	}
	// include a direct check for post type... for an actual forum
	
	$loop = new TopicLoop ();
	$loop->output ( array (
			'forums' => $forumIds 
	) );
}
?>
