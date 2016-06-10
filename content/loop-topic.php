<?php

/**
 * This template displays the loop of topics within a block.
 *
 * @package Student Hub
 * @since Student Hub 1.0
 */
?>

<?php 	$bbp = bbpress();
$bbp_f = bbp_parse_args('', array(
		'post_type'           => bbp_get_topic_post_type(),
		'post_parent'         => '',
		'posts_per_page'      => get_option( '_bbp_forums_per_page', 5 ),
		'ignore_sticky_posts' => true,
		'orderby'             => 'menu_order title',
		'order'               => 'ASC'
), 'has_topics' );

$query = new WP_Query( $bbp_f );
while ( $query->have_posts() ) : $query->the_post();
?>						
	<div class="blog-holder shadow radius-full post-250 post type-topic status-publish format-standard hentry">
		<div class="article">
			<p> class="headline"><?php the_title(); ?></p>
			<p><?php the_excerpt(); ?></p>
			<?php do_action( 'bbp_theme_before_reply_content' ); ?>
			<?php do_action( 'bbp_theme_after_reply_content' ); ?>
		</div>
	</div>

<?php endwhile; 
	 wp_reset_postdata();
?>
