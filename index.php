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
				<?php dynamic_sidebar('home-sidebar'); ?> 
			</div>
			
			<div class="columns eleven">
				<div id="infinite-container" class="postarea">
					<?php the_widget('post_form_widget'); ?>
					<?php $loop = new TopicLoop();
					$loop->output(array()); ?>
				</div>
			</div>

		</div>
	</div>
</div>

