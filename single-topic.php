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
			</div>
			
			<div class="columns eleven">
				<div id="infinite-container" class="postarea">
					<?php $GLOBALS['post'] = get_post(get_the_ID()); ?>
					<?php locate_template("widgets/topic.php", true, false); ?>
				</div>
			</div>
		</div>
	</div>
</div>