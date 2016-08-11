<?php 
class Category_Filter_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'category_filter_widget',
			'description' => 'Filters search output according to selected categories',
		);
		parent::__construct( 'category_filter_widget', 'Category Filter Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		include(locate_template( array( 'widgets/category-filter.php')));
	}

}
?>