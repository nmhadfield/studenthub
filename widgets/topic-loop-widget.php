<?php 
class Topic_Loop_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 
			'classname' => 'topic_loop_widget',
			'description' => 'Shows the feed for a particular context',
			'feed_type' => null,
		);
		parent::__construct( 'topic_loop_widget', 'Topic Loop Widget', $widget_ops );
	}
	
	public function __construct1($feed_type) {
		$widget_ops = array(
				'classname' => 'topic_loop_widget',
				'description' => 'Shows the feed for a particular context',
				'feed_type' => $feed_type,
		);
		parent::__construct( 'topic_loop_widget', 'Topic Loop Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		include(locate_template( array( 'widgets/topic-loop.php'), false ));
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