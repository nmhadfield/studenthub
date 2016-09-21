<?php
require_once(ABSPATH.'wp-config.php');
require_once(ABSPATH.'wp-includes/wp-db.php');
require_once(ABSPATH.'wp-admin/includes/taxonomy.php');
require_once(ABSPATH.'wp-content/plugins/buddypress/bp-groups/bp-groups-functions.php');
require_once('widgets/search-resources-widget.php');
require_once('widgets/category-filter-widget.php');
require_once('widgets/deadlines-widget.php');
require_once('widgets/events-widget.php');
require_once('widgets/tasks-widget.php');
require_once('widgets/societies-widget.php');
require_once('widgets/topic-loop-widget.php');
require_once('widgets/comments-loop-widget.php');
require_once('widgets/committee-widget.php');
require_once('widgets/peer-mentors-groups-widget.php');
require_once('widgets/favourite-widget.php');
require_once('widgets/post-form-widget.php');
require_once('widgets/post-reply-form-widget.php');
require_once('widgets/category-logo-widget.php');
require_once('widgets/link-widget.php');

add_action('wp_enqueue_scripts', 'wpb_adding_scripts' );

add_action('after_switch_theme', "studenthub_init_menu");
add_action('after_switch_theme', "studenthub_init_db");
add_action('after_setup_theme', 'studenthub_init_globals');

add_action('bbp_new_topic', 'studenthub_save_topic', 10, 4);
add_action('bbp_new_topic_pre_extras', 'studenthub_check_topic', 1);
add_action( 'init', 'create_post_type' );

add_filter('query_vars', 'studenthub_add_query_vars_filter');

add_action('widgets_init', function() {
	register_widget('search_resources_widget' );
	register_widget('category_filter_widget' );
	register_widget('deadlines_widget' );
	register_widget('events_widget' );
	register_widget('tasks_widget' );
	register_widget('societies_widget' );
	register_widget('topic_loop_widget' );
	register_widget('comments_widget' );
	register_widget('committee_widget' );
	register_widget('peer_mentors_groups_widget' );
	register_widget('favourite_widget' );
	register_widget('post_form_widget');
	register_widget('post_reply_form_widget');
	register_widget('category_logo_widget');
	register_widget('link_widget');
});

function create_post_type() {
	if (!post_type_exists("societies")) {
		register_post_type( 
				'societies',
				array('labels' => array('name' => __('Societies'), 'singular_name' => __('Society')),'public' => true,'has_archive' => true,));
		flush_rewrite_rules(false);
	}
}

function studenthub_add_query_vars_filter($vars) {
	$vars[] = "scope";
	return $vars;
}
	
// register Javascript
function wpb_adding_scripts() {
	
	wp_register_script ('jquery', get_stylesheet_directory_uri () . '/scripts/jquery/jquery.js' );
	wp_enqueue_script ('jquery' );
	
	wp_register_script ('jquery.form', get_stylesheet_directory_uri () . '/scripts/jquery.form/jquery.form.js' );
	wp_enqueue_script ('jquery.form' );
	
	wp_register_script ('jquery-ui', get_stylesheet_directory_uri () . '/scripts/jquery/jquery-ui.js' );
	wp_enqueue_script ('jquery-ui' );
	
	wp_register_script ('jquery-multiselect', get_stylesheet_directory_uri () . '/scripts/jquery.multiselect/jquery.multiselect.js' );
	wp_enqueue_script ('jquery-multiselect' );
	
	wp_localize_script('ajax-feed', 'ajaxfeed', array(
			'ajaxurl' => admin_url('admin-ajax.php' )
	));
	
	wp_register_script ('studenthub-groups', get_stylesheet_directory_uri () . '/scripts/groups.js' );
	wp_enqueue_script ('studenthub-groups' );
}

// add our additional functionality into BBPress forum topic posting
function studenthub_check_topic($forum_id) {
	if (empty($_POST["studenthub-subject-select"])) {
		bbp_add_error('studenthub-area', __('<strong>ERROR</strong>: No subject area(s) were indicated', 'bbpress' ) );
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
	wp_set_object_terms($topic_id, $type -> name, "topic-type");
	
	// save link as post metadata
	if (!empty($_POST["studenthub-url"])) {
		add_post_meta($topic_id, "link", $_POST["studenthub-url"]); 
	}
}

/* Initialization performed on loading the theme. */
function studenthub_init_home_submenu() {
	// make sure that the menu is created - we don't want to do this in the admin dashboard as it would need to be configured on every new installation
	$menuname = "home-submenu";
	$menu_exists = wp_get_nav_menu_object ( $menuname );
	
	if (! $menu_exists) {
		$menu_id = wp_create_nav_menu ( $menuname );
		
		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ('All' ),
				'menu-item-url' => home_url ('/' ),
				'menu-item-status' => 'publish'
		) );
		
		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ('Resources' ),
				'menu-item-url' => home_url ('/?type=resource,link' ),
				'menu-item-status' => 'publish' 
		) );
		
		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ('Questions' ),
				'menu-item-url' => home_url ('/?type=question' ),
				'menu-item-status' => 'publish'
		) );
		
		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ('Announcements' ),
				'menu-item-url' => home_url ('/?type=announcement' ),
				'menu-item-status' => 'publish' 
		) );
	}
}

/* Initialization performed on loading the theme. */
function studenthub_init_studyzone_submenu() {
	// make sure that the menu is created - we don't want to do this in the admin dashboard as it would need to be configured on every new installation
	$menuname = "studyzone-submenu";
	$menu_exists = wp_get_nav_menu_object ( $menuname );

	if (! $menu_exists) {
		$menu_id = wp_create_nav_menu ( $menuname );

		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ('All' ),
				'menu-item-url' => home_url ('/studyzone/' ),
				'menu-item-status' => 'publish'
		) );
		
		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ('Favourites' ),
				'menu-item-url' => home_url ('/studyzone?favourites' ),
				'menu-item-status' => 'publish'
		) );
	}
}
function studenthub_init_menu() {
	// make sure that the menu is created - we don't want to do this in the admin dashboard as it would need to be configured on every new installation
	$menuname = "main-menu";
	$menu_exists = wp_get_nav_menu_object ( $menuname );

	if (! $menu_exists) {
		$menu_id = wp_create_nav_menu ( $menuname );

		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ('StudentHub' ),
				'menu-item-url' => home_url ('/' ),
				'menu-item-status' => 'publish'
		) );

		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ('StudyZone' ),
				'menu-item-url' => home_url ('/studyzone/' ),
				'menu-item-status' => 'publish'
		) );

		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ('Societies' ),
				'menu-item-url' => home_url ('/societies/' ),
				'menu-item-status' => 'publish'
		) );

		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ('MSC' ),
				'menu-item-url' => home_url ('/forums/forum/MSC/' ),
				'menu-item-status' => 'publish'
		) );

		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ('Peer Mentors' ),
				'menu-item-url' => home_url ('/forums/forum/peer-mentors/' ),
				'menu-item-status' => 'publish'
		) );

		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ('Profile' ),
				'menu-item-url' => home_url ('/profile/' ),
				'menu-item-status' => 'publish'
		) );

		wp_update_nav_menu_item ( $menu_id, 0, array (
				'menu-item-title' => __ ('MedBlogs' ),
				'menu-item-url' => 'http://medblogs.dundee.ac.uk' ,
				'menu-item-status' => 'publish'
		) );

		$locations = get_theme_mod ('nav_menu_locations' );
		$locations ['fixed-menu'] = $menu_id;
		set_theme_mod ('nav_menu_locations', $locations );
	}

	if (get_page_by_title("StudyZone") == null) {
		wp_insert_post(array('post_title' => 'StudyZone', 'post_type' => 'page', 'post_status' => 'publish'));
	}

	if (get_page_by_title("Peer Mentors") == null) {
		wp_insert_post(array('post_title' => 'Peer Mentors', 'post_type' => 'page', 'post_status' => 'publish'));
	}

	if (get_page_by_title("Profile") == null) {
		wp_insert_post(array('post_title' => 'Profile', 'post_type' => 'page', 'post_status' => 'publish'));
	}
	
	studenthub_init_studyzone_submenu();
	studenthub_init_home_submenu();
}

function studenthub_init_db() {
	// make sure that all the categories are created (WP won't create a new one if it exists)
	$system = wp_create_category ( "systems" );
	wp_create_category ( "respiratory", $system );
	wp_create_category ( "cardiovascular", $system );
	wp_create_category ( "gi", $system );
	wp_create_category ( "dermatology", $system );
	wp_create_category ( "msk", $system );
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
	wp_create_category ( "rheumatology", $clinical_blocks );
	wp_create_category ( "orthopaedics", $clinical_blocks );
	wp_create_category ( "acute care", $clinical_blocks );
	wp_create_category ( "infectious diseases", $clinical_blocks );
	wp_create_category ( "oncology", $clinical_blocks );
	wp_create_category ( "ageing", $clinical_blocks );
	wp_create_category ( "urology", $clinical_blocks );
	wp_create_category ( "child health", $clinical_blocks );
	wp_create_category ( "dermatology", $clinical_blocks );
	wp_create_category ( "psychiatry", $clinical_blocks );

	$themes = wp_create_category ( "themes" );
	wp_create_category ( "anatomy", $themes );
	wp_create_category ( "physiology", $themes );
	wp_create_category ( "pathology", $themes );
	wp_create_category ( "public health", $themes );
	wp_create_category ( "biochemistry", $themes );
	wp_create_category ( "doctor as a professional", $themes );
	wp_create_category ( "clinical skills", $themes );
	wp_create_category ( "communication skills", $themes );
	wp_create_category ( "iss", $themes );
	wp_create_category ( "interprofessional education", $themes );
	wp_create_category ( "immunology", $themes );
	wp_create_category ( "genetics", $themes );
	wp_create_category ( "pharmacology", $themes );
	wp_create_category ( "ethics", $themes );
	wp_create_category ( "radiology", $themes );
	wp_create_category ( "palliative care", $themes );
	wp_create_category ( "global health", $themes );
	wp_create_category ( "nutrition", $themes );
	wp_create_category ( "prescribing", $themes );
	
	$locations = wp_create_category("locations");
	wp_create_category("medical school", $locations);
	wp_create_category("ninewells", $locations);
	wp_create_category("pri", $locations);
	wp_create_category("kirkcaldy", $locations);
	wp_create_category("murray royal", $locations);
	wp_create_category("stracathro", $locations);
	wp_create_category("livingston", $locations);
	wp_create_category("forth valley", $locations);
	wp_create_category("loch gilphead", $locations);
	wp_create_category("ayr", $locations);
	wp_create_category("dumfries", $locations);
	wp_create_category("cupar", $locations);
	wp_create_category("oban", $locations);
	
	$assessment = wp_create_category("assessment");
	wp_create_category("portfolio", $assessment);
	wp_create_category("online exams", $assessment);
	wp_create_category("osce", $assessment);
	wp_create_category("cap test", $assessment);
	
	$societies = wp_create_category("societies");
	wp_create_category("msc", $societies);
	wp_create_category("peer mentors", $societies);

	$yearGroup = wp_create_category("year-groups");
	$sipId = wp_create_category("sip", $yearGroup);
	wp_create_category("year1", $sipId);
	wp_create_category("year2", $sipId);
	wp_create_category("year3", $sipId);
	
	$pipId = wp_create_category("pip", $yearGroup);
	wp_create_category("year4", $pipId);
	wp_create_category("year5", $pipId);
	
	wp_create_category("gateway to medicine", $yearGroup);
	wp_create_category("bmsc", $yearGroup);
	
	$hub = createForumIfNeeded("StudentHub");
	createForumIfNeeded("Resources", $hub);
	createForumIfNeeded("Links", $hub);
	createForumIfNeeded("Questions", $hub);
	createForumIfNeeded("Announcements");
	
	$societies = createForumIfNeeded("Societies");
	createForumIfNeeded("MSC", $societies);
	createForumIfNeeded("Peer Mentors", $societies);
	
	createForumIfNeeded("Suggestions");
	
	register_taxonomy( "topic-type", "topic", array("hierarchical" => true));
	wp_create_term("resource", "topic-type");
	wp_create_term("question", "topic-type");
	wp_create_term("link", "topic-type");
}

function createTermIfNeeded($name, $taxonomy, $parent) {
	wp_create_term($name, $taxonomy);
	wp_update_term($name, $taxonomy, array("parent" => $parent));
}
	
function studenthub_init_globals() {
	
	register_taxonomy_for_object_type('category', 'topic' );
	
	$GLOBALS["systems"] = wp_create_category ( "systems" );
	$GLOBALS["clinical_blocks"] = wp_create_category ( "clinical-blocks" );
	$GLOBALS["themes"] = wp_create_category ( "themes" );
	$GLOBALS["locations"] = wp_create_category ( "locations" );
	$GLOBALS["assessment"] = wp_create_category ( "assessment" );
	$GLOBALS["year_groups"] = wp_create_category ( "year-groups" );
	
	$hub = get_page_by_title("StudentHub", OBJECT, "forum");
	if ($hub) {
		$GLOBALS["hub"] = $hub -> ID;
		$GLOBALS["hub_url"] = get_site_url(null, "/forums/forum/".($hub ->post_name)."/");
	}
	
	$links = get_page_by_title("Links", OBJECT, "forum" );
	if ($links) {
		$GLOBALS["links"] = $links -> ID;
		$GLOBALS["links_url"] = get_site_url(null, "/forums/forum/".($links ->post_name)."/");
	}
	
	$questions = get_page_by_title("Questions", OBJECT, "forum" );
	if ($questions){
		$GLOBALS["questions"] = $questions -> ID;
		$GLOBALS["questions_url"] = get_site_url(null, "/forums/forum/".($questions ->post_name)."/");
	}
	
	$resources = get_page_by_title("Resources", OBJECT, "forum" );
	if ($resources) {
		$GLOBALS["resources"] = $resources -> ID;
		$GLOBALS["resources_url"] = get_site_url(null, "/forums/forum/".($resources ->post_name)."/");
	}
	
	$announcements = get_page_by_title("Announcements", OBJECT, "forum" );
	if ($announcements) {
		$GLOBALS["announcements"] = $announcements -> ID;
		$GLOBALS["announcements_url"] = get_site_url(null, "/forums/forum/".($announcements ->post_name)."/");
	}
	
	$societies = get_page_by_title("Societies", OBJECT, "forum" );
	if ($societies) {
		$GLOBALS["societies"] = $societies -> ID;
	}
	
	$msc = get_page_by_title("MSC", OBJECT, "forum" );
	if ($msc) {
		$GLOBALS["msc"] = $msc -> ID;
		$GLOBALS["msc_url"] = get_site_url(null, "/forums/forum/".($msc ->post_name)."/");
	}
	
	$peer_mentors = get_page_by_title("Peer Mentors", OBJECT, "forum" );
	if ($peer_mentors) {
		$GLOBALS["peer_mentors"] = $peer_mentors -> ID;
		$GLOBALS["peer_mentors_url"] = get_site_url(null, "/forums/forum/".($peer_mentors ->post_name)."/");
	}
}

function createForumIfNeeded($forumName, $parent = NULL) {
	$forum = get_page_by_title( $forumName, OBJECT, "forum" );
	if ($forum == null) {
		$data = array('post_title' => $forumName);
		if ($parent) {
			$data['post_parent'] = $parent;
		}
		return bbp_insert_forum($data);
	} 
	else {
		return $forum -> ID;
	}
}
?>
