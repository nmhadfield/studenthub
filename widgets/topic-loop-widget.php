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
		);
		
		// loading earlier posts (infinite scrolling)
		if (array_key_exists('before', $args)) {
			$query_args['date_query'] = array(array('before' => $args['before']));
		}
		
		// loading newer posts (after new post, or posts from others)
		if (array_key_exists('after', $args)) {
			$query_args['date_query'] = array(array('after' => $args['after']));
		
			// don't want pagination if we're adding to the top of the page
			$query_args['posts_per_page'] = -1;
			$paginate = false;
		}
		
		// if there are filters supplied
		if (array_key_exists('category', $args)) {
			$query_args['category_name'] = $args['category'];
		}
		
		if (array_key_exists('searchterms', $args)) {
			$query_args['s'] = $args['searchterms'];
		}
		
		if ((array_key_exists('scope', $args) && args['scope'] == 'favourite') || get_query_var('scope') == 'favourite') {
			$query_args['post__in'] = get_user_meta(get_current_user_id(), 'favourite', false);
		}
		
		if (array_key_exists('type', $args)) {
			$query_args['tax_query'] = array(array('taxonomy' => 'topic-type', 'field' => 'slug', 'terms' => explode(',', $args['type'])));
		}
		
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