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
			<?php wp_nav_menu(array('menu' => 'studyzone-submenu')); ?>
		</div>
		<div class="content">

			<div class="columns five">
				<?php the_widget( 'search_resources_widget' ); ?> 
			</div>
			
			<div class="columns eleven">
				<div id="infinite-container" class="postarea">
					<?php the_widget('post_form_widget'); ?>
					<?php the_widget('topic_loop_widget', array(), array('sh_parent' => $GLOBALS["hub"])); ?>
				</div>
			</div>

		</div>
	</div>
</div>

