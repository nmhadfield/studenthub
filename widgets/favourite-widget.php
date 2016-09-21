<?php 

add_action('wp_ajax_studenthub_make_favourite', 'studenthub_make_favourite');
add_action('wp_enqueue_scripts', 'favourite_js' );

function favourite_js() {
	wp_register_script ( 'studenthub-favourite', get_stylesheet_directory_uri () . '/scripts/favourite.js' );
	wp_enqueue_script ( 'studenthub-favourite' );
}

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

function sh_is_Favourite($postId) {
	$favourites = get_user_meta(get_current_user_id(), 'favourite', false);
	return in_array($postId, $favourites);
}

function studenthub_make_favourite() {
	$postId = $_POST['postId'];
	$enabled = $_POST['enabled'];
	if ($enabled == 'true') {
		add_user_meta(get_current_user_id(), 'favourite', $postId);
	}
	else {
		delete_user_meta(get_current_user_id(), 'favourite', $postId);
	}
}
?>