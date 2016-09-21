<?php 
class Tasks_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'tasks_widget',
			'description' => 'Shows the upcoming deadlines for the current student',
		);
		parent::__construct( 'tasks_widget', 'Tasks Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		locate_template( array( 'widgets/tasks.php'), true );
	}
}
?>