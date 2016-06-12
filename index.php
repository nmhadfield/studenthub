<?php

/**
 * This template displays the loop of topics within a block.
 *
 * @package Student Hub
 * @since Student Hub 1.0
 */
?>

	<?php get_header(); ?>
	
<?php
	$bbp = bbpress();
	$bbp_f = bbp_parse_args('', array(
			'post_type'           => bbp_get_topic_post_type(),
			'posts_per_page'      => get_option( '_bbp_forums_per_page', 10 ),
			'order'               => 'ASC'), 'has_topics' );
	
	$query = new WP_Query( $bbp_f ); 
?>
	
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				
	<div id="content">
		<div class="blog-holder shadow radius-full post-250 post type-topic status-publish format-standard hentry">
			<?php locate_template( array( 'activity/post-form.php'), true ); ?>
		</div>
		<div class="blog-holder shadow radius-full post-250 post type-topic status-publish format-standard hentry">
			<div class="article">
				<p><b><?php the_title(); ?></b><br>
				<?php the_excerpt(); ?></p>
				<?php do_action( 'bbp_theme_before_reply_content' ); ?>
				<?php do_action( 'bbp_theme_after_reply_content' ); ?>
			</div>
		</div>

	<?php 
		endwhile;
		wp_reset_postdata();
		remove_Filter('posts_where', array(&$whereFilter, 'add_where_filter'));
	?>	
	</div>