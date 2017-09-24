<div id="topic-loop" class='topic-loop'>
<!-- send back the args used for the loop so they can be re-used in another query -->
<?php 
	foreach ($args as $key => $value) {
		if (substr($key, 0, 3) == 'sh_') { 
			if (is_array($value)) { ?>
				<input type="hidden" id="<?php echo($key); ?>" value="<?php echo(implode(',', $value)); ?>"></input> <?php
			} 
			else { ?>
				<input type="hidden" id="<?php echo($key); ?>" value="<?php echo($value); ?>"></input> <?php
			}
   		} 
	} 

	$query = new WP_Query( $query_args );
	
	while ( $query->have_posts() ) : $query->the_post();
		locate_template("content/topic.php", true, false);
	endwhile;
?>
</div>

<!-- links for pagination -->
<?php if ($paginate && $query->max_num_pages > 1) { ?>
<a href="<?php echo(get_the_date("Y-m-d H:i:s"))?>" class="feed">Load More</a>
<?php } ?>


<?php	wp_reset_postdata(); ?>
<?php	remove_Filter('posts_where', array(&$whereFilter, 'add_where_filter')); ?>	