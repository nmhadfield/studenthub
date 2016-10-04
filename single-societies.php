<?php

/**
 * This template displays the feed from all the societies and provides a widget linking to each society.
* @package Student Hub
* @since Student Hub 1.0
*/
?>

<?php get_header(); ?>
			
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<div class="row">
		<div class="content">

			<div class="columns five">
				<?php the_widget('society_contact_widget', array(), array('post-id' => get_the_ID())); ?>
				<?php the_widget('committee_widget', array(), array('post-id' => get_the_ID())); ?>
			</div>
			
			<div class="columns eleven">
				<div id="infinite-container" class="postarea">
					<?php echo(get_page_by_title($post -> title, OBJECT, 'forum'));?>
					<?php the_widget('topic_loop_widget', array(), array('parent' => 0)); ?>
				</div>
			</div>

		</div>
	</div>
</div>