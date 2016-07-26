<?php
require_once (ABSPATH . 'wp-config.php');
require_once (ABSPATH . 'wp-includes/wp-db.php');
require_once (ABSPATH . 'wp-admin/includes/taxonomy.php');
require_once ('template.php');
require ('widgets/search-resources-widget.php');
require ('widgets/deadlines-widget.php');
require ('widgets/events-widget.php');
require ('widgets/tasks-widget.php');
require ('widgets/societies-widget.php');
require ('widgets/topic-loop-widget.php');
require ('widgets/comments-loop-widget.php');
require ('widgets/committee-widget.php');
require ('widgets/peer-mentors-groups-widget.php');

add_action('wp_enqueue_scripts', 'wpb_adding_scripts' );

add_action('after_switch_theme', "studenthub_init_menu");
add_action('after_switch_theme', "studenthub_init_db");
add_action('after_setup_theme', 'studenthub_init_globals');

add_action('bbp_new_topic', 'studenthub_save_topic', 10, 4);
add_action('bbp_new_topic_pre_extras', 'studenthub_check_topic', 1);

add_action('wp_ajax_studenthub_reload_feed', 'studenthub_reload_feed');
add_action('wp_ajax_studenthub_reload_comment_feed', 'studenthub_reload_comment_feed');

add_action( 'widgets_init', function() {
	register_widget( 'search_resources_widget' );
	register_widget( 'deadlines_widget' );
	register_widget( 'events_widget' );
	register_widget( 'tasks_widget' );
	register_widget( 'societies_widget' );
	register_widget( 'topic_loop_widget' );
	register_widget( 'comments_widget' );
	register_widget( 'committee_widget' );
	register_widget( 'peer_mentors_groups_widget' );
});

// register Javascript
function wpb_adding_scripts() {
	
	wp_register_script ( 'jquery', get_stylesheet_directory_uri () . '/scripts/jquery/jquery.js' );
	wp_enqueue_script ( 'jquery' );
	
	wp_register_script ( 'jquery.form', get_stylesheet_directory_uri () . '/scripts/jquery.form/jquery.form.js' );
	wp_enqueue_script ( 'jquery.form' );
	
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

/* Ajax function for reloading the feed after posting. */
function studenthub_reload_feed() {
	locate_template( array( 'topic-loop.php'), true );
	die();	
}

/* Ajax function for reloading the comments after posting a new comment. */
function studenthub_reload_comment_feed() {
	the_widget('comments_widget', array(), array('post_id' => $_GET['postId'] ));
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
	
	// save link as post metadata
	if (!empty($_POST["studenthub-url"])) {
		add_post_meta($topic_id, "link", $_POST["studenthub-url"]); 
	}
}

/* Initialization performed on loading the theme. */
function studenthub_init_menu() {
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
				'menu-item-url' => 'http://medblogs.dundee.ac.uk' ,
				'menu-item-status' => 'publish' 
		) );
		
		$locations = get_theme_mod ( 'nav_menu_locations' );
		$locations ['fixed-menu'] = $menu_id;
		set_theme_mod ( 'nav_menu_locations', $locations );
	}
	
	if (get_page_by_title("StudyZone") == null) {
		wp_insert_post(array('post_title' => 'StudyZone', 'post_type' => 'page', 'post_status' => 'publish'));
	}
	
	if (get_page_by_title("Societies") == null) {
		wp_insert_post(array('post_title' => 'Societies', 'post_type' => 'page', 'post_status' => 'publish'));
	}
	
	if (get_page_by_title("MSC") == null) {
		wp_insert_post(array('post_title' => 'MSC', 'post_type' => 'page', 'post_status' => 'publish'));
	}
	
	if (get_page_by_title("Peer Mentors") == null) {
		wp_insert_post(array('post_title' => 'Peer Mentors', 'post_type' => 'page', 'post_status' => 'publish'));
	}
	
	if (get_page_by_title("Profile") == null) {
		wp_insert_post(array('post_title' => 'Profile', 'post_type' => 'page', 'post_status' => 'publish'));
	}
}

function studenthub_init_db() {
	// make sure that all the categories are created (WP won't create a new one if it exists)
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
	
	$clinical_blocks = wp_create_category ( "clinical-blocks" );
	wp_create_category ( "general medicine", $clinical_blocks );
	wp_create_category ( "general surgery", $clinical_blocks );
	wp_create_category ( "obs and gynae", $clinical_blocks );
	wp_create_category ( "gp", $clinical_blocks );

	$themes = wp_create_category ( "themes" );
	wp_create_category ( "anatomy", $themes );
	wp_create_category ( "physiology", $themes );
	wp_create_category ( "pathology", $themes );
	wp_create_category ( "public health", $themes );
	wp_create_category ( "biochemistry", $themes );
	
	// create the rest of our taxonomy
	register_taxonomy( "audience", "topic", array("hierarchical" => true));
	$sipId = wp_create_term("sip", "audience");
	createTermIfNeeded("year1", "audience", $sipId);
	createTermIfNeeded("year2", "audience", $sipId);
	createTermIfNeeded("year3", "audience", $sipId);
	
	$pipId = wp_create_term("pip", "audience");
	createTermIfNeeded("year4", "audience", $pipId);
	createTermIfNeeded("year5", "audience", $pipId);
	
	createForumIfNeeded("Resources");
	createForumIfNeeded("Announcements");
	
	register_taxonomy_for_object_type( 'category', 'topic' );
	
	register_taxonomy( "topic-type", "topic", array("hierarchical" => true));
	wp_create_term("resource", "topic-type");
	wp_create_term("question", "topic-type");
}

function createTermIfNeeded($name, $taxonomy, $parent) {
	$id = wp_create_term($name, $taxonomy);
	wp_update_term($name, $taxonomy, array("parent" => $parent));
}
	
function studenthub_init_globals() {
	
	$GLOBALS["systems"] = wp_create_category ( "systems" );
	$GLOBALS["clinical_blocks"] = wp_create_category ( "clinical-blocks" );
	$GLOBALS["themes"] = wp_create_category ( "themes" );
	
	$resources = get_page_by_title("Resources", OBJECT, "forum" );
	$GLOBALS["resources"] = $resources -> ID;
	$GLOBALS["resources_url"] = get_site_url(null, "/forums/forum/".($resources ->post_name)."/");
}

function createForumIfNeeded($forumName) {
	$forum = get_page_by_title( $forumName, OBJECT, "forum" );
	if ($forum == null) {
		return bbp_insert_forum(array('post_title' => $forumName));
	} 
	else {
		return $forum -> ID;
	}
}
?>
