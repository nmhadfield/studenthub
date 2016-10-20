<?php

/**
 * Default page template, shows a loop of posts.
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
				<?php dynamic_sidebar('page-'.get_the_ID().'-sidebar'); ?> 
			</div>
			
			<div class="columns eleven">
				<div id="infinite-container" class="postarea">
					<?php 
					$form = new Post_Form_Widget();
					$form->output(array());
					
					$loop = new TopicLoop();
					$loop->output(array('sh_parent' => get_post_meta(get_the_ID(), 'sh_parent', true))); 
					?>
				</div>
			</div>

		</div>
	</div>
</div>

