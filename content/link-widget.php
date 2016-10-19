<?php 

class Link_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'link_widget',
			'description' => 'Displays the embedded link attached to a post',
		);
		parent::__construct( 'link_widget', 'Link Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$links = get_post_meta(get_the_ID(), "link", false);
		
		foreach ($links as $link) {
			include(locate_template( array( 'content/link.php')));
		}
	}
}
?>