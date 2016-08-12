<?php

/**
 * This template displays the loop of topics within a block.
 *
 * @package Student Hub
 * @since Student Hub 1.0
 */
?>

<?php get_header(); ?>
			
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<div class="row">
		<div class="menu">
			<?php wp_nav_menu(array('menu' => 'home-submenu')); ?>
		</div>
		<div class="content">

			<div class="columns five">
				<?php the_widget( 'deadlines_widget' ); ?>
				<?php the_widget( 'events_widget' ); ?>
				<?php the_widget( 'tasks_widget' ); ?>
			</div>
			
			<div class="columns eleven">
				<div id="infinite-container" class="postarea">
					<?php include(locate_template( array( 'post-form.php'), false )); ?>
					<?php the_widget('topic_loop_widget'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

