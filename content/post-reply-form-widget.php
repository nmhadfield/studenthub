<?php 

add_action('wp_enqueue_scripts', 'post_reply_form_js' );

function post_reply_form_js() {
	wp_register_script ( 'studenthub-post-reply-form', get_stylesheet_directory_uri () . '/scripts/post-reply-form.js' );
	wp_enqueue_script ( 'studenthub-post-reply-form' );
}

class Post_Reply_Form_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'post_reply_form_widget',
			'description' => 'Create a new reply',
		);
		parent::__construct( 'post_reply_form_widget', 'Post Reply Form Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function output($args) {
		locate_template( array( 'content/post-reply-form.php'), true );
	}
	
}
?>