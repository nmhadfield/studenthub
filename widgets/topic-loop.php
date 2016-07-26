<?php
$bbp = bbpress();

$bbp_f = bbp_parse_args('', array(
		'post_type'           => bbp_get_topic_post_type(),
		'posts_per_page'      => get_option( '_bbp_forums_per_page', 20 ),
		'order'               => 'DESC'), 'has_topics' );

// if there's a filter supplied
if ($_POST && $_POST['category']) {
	$bbp_f['category_name'] = $_POST['category'];
}
if ($instance && array_key_exists('feed_type', $instance)) {
	$bbp_f['category_name'] = $instance['feed_type'];
}
$query = new WP_Query( $bbp_f );
?>

<div id="topic-loop">


<?php while ( $query->have_posts() ) : $query->the_post(); ?>
	<div class="blog-holder shadow radius-full post-250 post type-topic status-publish format-standard hentry">		
		<div id="post-<?php echo(get_the_ID())?>" class="article">
			<?php 
			// first keep a reference to the current post as we'll need this after inner comment loops
			$tmp_post = $GLOBALS['post'];
			$categories = wp_get_object_terms(get_the_ID(), 'category', array('fields' => 'all'));
			foreach ($categories as $cat) {
				do_logo($cat);
			}
			?> 
			
			<b><?php the_title(); ?></b>
			<?php the_content(); ?>
			<?php include(locate_template('embed-link.php', false )); ?>
			
			<div>
			<?php 
				$attachments = get_posts( array('post_type' => 'attachment', 'posts_per_page' => 1, 'post_parent' => get_the_ID(), 'exclude' => get_post_thumbnail_id()));
			
        		if ( $attachments ) {
	            	foreach ( $attachments as $attachment ) {
	                	echo(do_shortcode("[gview file ='".wp_get_attachment_url($attachment -> ID)."']"));
	            	}
        		}
        		
			?>
			</div>
			<?php do_action( 'bbp_theme_before_reply_content' ); ?>
			<?php do_action( 'bbp_theme_after_reply_content' ); ?>
			
			<div class="article-functions"><a href="#" onclick="showComments(event, '<?php echo(get_the_ID())?>')">Comments</a></div>
		
			<?php the_widget( 'comments_widget' ); ?>
		</div>
	</div>

<?php endwhile; ?>
</div>

<?php	wp_reset_postdata(); ?>
<?php	remove_Filter('posts_where', array(&$whereFilter, 'add_where_filter')); ?>	