<?php 

add_action('wp_enqueue_scripts', 'comments_loop_js' );
add_action('wp_ajax_studenthub_reload_comment_feed', 'studenthub_reload_comment_feed');

function comments_loop_js() {
	wp_register_script ( 'studenthub-comments-loop', get_stylesheet_directory_uri () . '/scripts/comments-loop.js' );
	wp_enqueue_script ( 'studenthub-comments-loop' );
}

class Comments_Widget extends WP_Widget {
	
	public function __construct() {
		$widget_ops = array(
				'classname' => 'comments_widget',
				'description' => 'Shows the comments feed for a particular post',
		);
		parent::__construct( 'comments_widget', 'Comments Loop Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		if ($args && array_key_exists('post_id', $args)) {
			$GLOBALS['post'] = get_post($args['post_id']);
		}
		include(locate_template( array( 'content/comments-loop.php'), false ));
	}
}

/* Ajax function for reloading the comments after posting a new comment. */
function studenthub_reload_comment_feed() {
	the_widget('comments_widget', array(), array('post_id' => $_GET['postId']));
	die();
}
?>