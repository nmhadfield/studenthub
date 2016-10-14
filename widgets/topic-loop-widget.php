<?php 

add_action('wp_ajax_studenthub_reload_feed', 'studenthub_reload_feed');
add_action('wp_ajax_studenthub_feed', 'studenthub_reload_feed');
add_action('wp_enqueue_scripts', 'topic_loop_js' );

function topic_loop_js() {
	wp_register_script ( 'studenthub-topic-loop', get_stylesheet_directory_uri () . '/scripts/topic-loop.js' );
	wp_enqueue_script ( 'studenthub-topic-loop' );
}

function is_image($url) {
	return str_ends_with($url, '.png') || str_ends_with($url, '.jpg') || str_ends_with($url, '.gif');
}

function str_ends_with($str, $token) {
	$end = substr($str, strlen($str) - 4);
	return $end == $token;
}

class Topic_Loop_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 
			'classname' => 'topic_loop_widget',
			'description' => 'Shows the feed for a particular context',
			'feed_type' => null,
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
		$paginate = true;
		$query_args = array(
				'post_type'       => bbp_get_topic_post_type(),
				'posts_per_page'  => 20,
				'order'           => 'DESC',
				'tax_query'       => array(),
		);
		
		// loading earlier posts (infinite scrolling)
		if (array_key_exists('sh_before', $args)) {
			$query_args['date_query'] = array(array('before' => $args['sh_before']));
		}
		
		// loading newer posts (after new post, or posts from others)
		if (array_key_exists('sh_after', $args)) {
			$query_args['date_query'] = array(array('after' => $args['sh_after']));
		
			// don't want pagination if we're adding to the top of the page
			$query_args['posts_per_page'] = -1;
			$paginate = false;
		}
		
		// if there are filters supplied
		if (array_key_exists('sh_category', $args)) {
			$query_args['category_name'] = $args['sh_category'];
		}
		
		if (array_key_exists('sh_searchterms', $args)) {
			$query_args['s'] = $args['sh_searchterms'];
		}
		
		if ((array_key_exists('sh_scope', $args) && args['sh_scope'] == 'favourite') || get_query_var('sh_scope') == 'favourite') {
			$query_args['post__in'] = get_user_meta(get_current_user_id(), 'favourite', false);
		}
		
		if (array_key_exists('sh_type', $args)) {
			array_push($query_args['tax_query'], array('taxonomy' => 'topic-type', 'field' => 'slug', 'terms' => explode(',', $args['sh_type'])));
		}
		
		// which forums to include
		if (array_key_exists('sh_parent', $args) && $args['sh_parent'] != 0) {
			$query = new WP_Query(array('post_parent' => $args['sh_parent'], 'post_type' => 'forum'));
			$parents = array();
			while ($query->have_posts()) : $query->the_post();
				array_push($parents, get_the_ID());
			endwhile;
			
			if (count($parents) > 0) {
				$query_args['post_parent__in'] = $parents;
			}
			else {
				$query_args['post_parent'] = $args['sh_parent'];
			}
		}
		else {
			// exclude all private forums
			$query_args['post_parent__not_in'] = bbp_get_private_forum_ids();
		}
		
		include(locate_template( array( 'widgets/topic-loop.php'), false ));
	}
}

/* Ajax function for reloading the feed after posting. */
function studenthub_reload_feed() {
	the_widget('topic_loop_widget', array(), $_GET);
	die();
}
?>