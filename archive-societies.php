<?php

/**
 * Displays the root page for all societies.
 * @package Student Hub
 * @since Student Hub 1.0
 */
?>

<?php get_header(); ?>
			
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<div class="row">
		<div class="content">

			<div class="columns five">
				<?php the_widget('societies_widget');?>
			</div>
			
			<div class="columns eleven">
				<div id="infinite-container" class="postarea">
					<?php $feed_type = 'societies';  ?>
					<?php the_widget('topic_loop_widget', array(), array('parent' => $GLOBALS["societies"])); ?>
				</div>
			</div>

		</div>
	</div>
</div>