<?php 
class Favourite_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'favourite_widget',
			'description' => 'Toggle button to favourite a post',
		);
		parent::__construct( 'favourite_widget', 'Favourite Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		include(locate_template( array( 'widgets/favourite.php')));
	}

}
?>