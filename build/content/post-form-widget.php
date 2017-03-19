<?php
add_action ( 'wp_enqueue_scripts', 'post_form_js' );
function post_form_js() {
	wp_register_script ( 'studenthub-post-form', get_stylesheet_directory_uri () . '/scripts/post-form.js' );
	wp_enqueue_script ( 'studenthub-post-form' );
}
class Post_Form_Widget extends WP_Widget {
	
	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array (
				'classname' => 'post_form_widget',
				'description' => 'Create a new post' 
		);
		parent::__construct ( 'post_form_widget', 'Post Form Widget', $widget_ops );
	}
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args        	
	 * @param array $instance        	
	 */
	public function output($args) {
		$forms = array();
		foreach ($args['forums'] as $forumId) {
			$title = get_post_meta($forumId, 'sh_new_post_title', true);
			if (!$title) {
				$title = 'Post in '.get_the_title($forumId);
			}
			$requiresSubjects = get_post_meta($forumId, 'sh_new_post_requires_subjects', true) == 1 ? 'true' : 'false';
			$categories = get_post_meta($forumId, 'sh_forum_subject_areas', true);
			$groups = array();
			if ($categories) {
				foreach ($categories as $id) {
					$groups[get_category($id) -> name] = get_descendant_categories($id);
				}
			}
			$forms[] = array(
					'forumId' => $forumId, 
					'title' => $title, 
					'requiresSubjects' => $requiresSubjects, 
					'groups' => $groups);
		}

		include (locate_template ( 'content/post-form.php' ));
	}
}

function get_descendant_categories($parentId) {
	$result = array();
	$children = get_terms('category', array('hide_empty' => false, 'parent' => $parentId, 'orderby' => 'term_id'));

	foreach ($children as $child) {
		array_push($result, $child);
		$grandchildren = get_terms('category', array('hide_empty' => false, 'parent' => $child->term_id, 'orderby' => 'term_id'));
		foreach ($grandchildren as $grandchild) {
			array_push($result, $grandchild);
		}
	}
	return $result;
}
?>