<?php 
class Deadlines_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'deadlines_widget',
			'description' => 'Shows the upcoming deadlines for the current student',
		);
		parent::__construct( 'deadlines_widget', 'Deadlines Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		locate_template( array( 'widgets/deadlines.php'), true );
	}

}
?>