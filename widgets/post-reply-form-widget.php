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
	public function widget( $args, $instance ) {
		locate_template( array( 'widgets/post-reply-form.php'), true );
	}
	
	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}
?>