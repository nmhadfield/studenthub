<?php

/**
 * Displays the content for a single forum, or for all child forums.
 * @package Student Hub
 * @since Student Hub 1.0
 */
?>

<?php get_header(); ?>
			
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<div class="row">
		<div class="content">

			<div class="columns five">
				<div id="studenthub-deadlines" class="widget article shadow blog-holder">
					<?php echo(the_content()); ?>
				</div> 
			</div>
			
			<div class="columns eleven">
				<div id="infinite-container" class="postarea">
					<?php the_widget('topic_loop_widget', array(), array('sh_parent' => get_the_ID())); ?>
				</div>
			</div>

		</div>
	</div>
</div>