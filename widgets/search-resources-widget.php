<?php 

add_action('wp_enqueue_scripts', 'search_resources_js' );

function search_resources_js() {
	wp_register_script ( 'studenthub-search-resources', get_stylesheet_directory_uri () . '/scripts/search-resources-widget.js' );
	wp_enqueue_script ( 'studenthub-search-resources' );
}

class Search_Resources_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'search_resources_widget',
			'description' => 'Filters search output according to selected categories',
		);
		parent::__construct( 'search_resources_widget', 'Search Resources Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		locate_template('widgets/search-resources.php', true, false);
	}

}
?>