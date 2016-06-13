<?php

/**
 * This template displays the loop of topics within a block.
 *
 * @package Student Hub
 * @since Student Hub 1.0
 */
?>

<?php get_header(); ?>
			
<div id="content">
	<div class="blog-holder shadow radius-full post-250 post type-topic status-publish format-standard hentry">
		<?php locate_template( array( 'post-form.php'), true ); ?>
	</div>
		
	<?php locate_template( array( 'topic-loop.php'), true ); ?>

</div>

