<?php
$bbp = bbpress();
$bbp_f = bbp_parse_args('', array(
		'post_type'           => bbp_get_topic_post_type(),
		'posts_per_page'      => get_option( '_bbp_forums_per_page', 10 ),
		'order'               => 'DESC'), 'has_topics' );

$query = new WP_Query( $bbp_f );
?>

<div id="topic-loop">
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
	<div class="blog-holder shadow radius-full post-250 post type-topic status-publish format-standard hentry">		
		<div class="article">
			<?php $categories = wp_get_object_terms(get_the_ID(), 'category', array('fields' => 'all')); ?>
			<?php foreach ($categories as $cat) { ?>
				<img class="logo" src="<?php echo(get_stylesheet_directory_uri()."/img/".$cat->slug.".png"); ?>"></img>
			<?php } ?>
			
			<b><?php the_title(); ?></b><br>
			<?php the_content(); ?>
			
			<?php 
			$attachments = get_posts( array('post_type' => 'attachment', 'posts_per_page' => 1, 'post_parent' => get_the_ID(), 'exclude' => get_post_thumbnail_id()));
        		if ( $attachments ) {
	            	foreach ( $attachments as $attachment ) {
	                	do_shortcode("[gview file ='".get_attached_file($attachment -> ID)."']");
	            	}
        		}
			?>
			<?php do_action( 'bbp_theme_before_reply_content' ); ?>
			<?php do_action( 'bbp_theme_after_reply_content' ); ?>
		</div>
	</div>

<?php endwhile; ?>
</div>

<?php	wp_reset_postdata(); ?>
<?php	remove_Filter('posts_where', array(&$whereFilter, 'add_where_filter')); ?>	