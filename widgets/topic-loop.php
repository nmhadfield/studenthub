<div id="topic-loop">
<?php

	$paginate = true;
	$args = array(
			'post_type'       => bbp_get_topic_post_type(),
			'posts_per_page'  => 3,
			'order'           => 'DESC',
	);
	
	// loading earlier posts (infinite scrolling)
	if (array_key_exists('before', $_GET)) {
		$args['date_query'] = array(array('before' => $_GET['before']));
	}
	
	// loading newer posts (after new post, or posts from others)
	if (array_key_exists('after', $_GET)) {
		$args['date_query'] = array(array('after' => $_GET['after']));
		
		// don't want pagination if we're adding to the top of the page
		$args['posts_per_page'] = -1;
		$paginate = false;
	}
	
	// if there's a filter supplied
	if ($_POST && $_POST['category']) {
		$args['category_name'] = $_POST['category'];
	}
	if ($instance && array_key_exists('feed_type', $instance)) {
		$args['category_name'] = $instance['feed_type'];
	}
	
	$query = new WP_Query( $args );
	
	while ( $query->have_posts() ) : $query->the_post();
		locate_template("widgets/topic.php", true, false);
	endwhile;
?>
</div>

<!-- links for pagination -->
<?php if ($paginate && $query->max_num_pages > 1) { ?>
<a href="<?php echo(get_the_date("Y-m-d H:i:s"))?>" class="feed">Load More</a>
<?php } ?>


<?php	wp_reset_postdata(); ?>
<?php	remove_Filter('posts_where', array(&$whereFilter, 'add_where_filter')); ?>	