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
				<?php the_widget( 'peer_mentors_groups_widget' ); ?> 
			</div>
			
			<div class="columns eleven">
				<div id="infinite-container" class="postarea">
					<?php the_widget('topic_loop_widget', array(), array('source' => 'peermentors')); ?>
				</div>
			</div>

		</div>
	</div>
</div>