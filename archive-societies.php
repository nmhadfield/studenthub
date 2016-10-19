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
					<?php $loop = new TopicLoop();
					$loop->output(array('sh_parent' => get_page_by_title("Societies", OBJECT, "forum")->ID)); ?>
				</div>
			</div>

		</div>
	</div>
</div>