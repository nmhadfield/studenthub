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
					<?php $loop = new TopicLoop(); ?>
					<?php $loop->output(array('sh_parent' => get_post_meta(get_the_ID(), 'sh_parent', true))); ?>
				</div>
			</div>
		</div>
	</div>
</div>