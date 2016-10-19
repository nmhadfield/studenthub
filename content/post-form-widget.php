<?php 

add_action('wp_enqueue_scripts', 'post_form_js' );

function post_form_js() {
	wp_register_script ( 'studenthub-post-form', get_stylesheet_directory_uri () . '/scripts/post-form.js' );
	wp_enqueue_script ( 'studenthub-post-form' );
}

class Post_Form_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'post_form_widget',
			'description' => 'Create a new post',
		);
		parent::__construct( 'post_form_widget', 'Post Form Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		locate_template( array( 'content/post-form.php'), true );
	}

}
?>