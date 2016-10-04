<div id="topic-loop">
<?php

	foreach ($args as $key => $value) { 
	?>
		<input type="hidden" id="<?php echo($key); ?>" value="<?php echo($value); ?>"></input> 
	<?php 
	}
	
	$query = new WP_Query( $query_args );
	
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