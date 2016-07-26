<?php 
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
		if ($instance && $instance['post_id']) {
			get_post($instance[post_id]);
		}
		include(locate_template( array( 'widgets/comments-loop.php'), true ));
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