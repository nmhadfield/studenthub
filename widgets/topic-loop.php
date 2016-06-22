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
		<div id="post<?php echo(get_the_ID())?>" class="article">
			<?php 
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
			
			<?php /*<div class="article-functions"><a href="#" onclick="showComments(event, '<?php echo(get_the_ID())?>')">Show Comments</a></div> */ ?>
		</div>
		<?php if (false) {?>
		<div id="comments<?php echo(get_the_ID())?>" class="comments">
			
			<?php $bbp_comments = bbp_parse_args('', array(
			'post_parent'		  => get_the_ID(),	
			'post_type'           => bbp_get_reply_post_type(),
			'order'               => 'ASC'), 'has_topics' );
	
			$commentsquery = new WP_Query( $bbp_comments ); ?>
			<?php while ($commentsquery->have_posts()) : $commentsquery->the_post();?>
			<div id="comment<?php echo(get_the_ID())?>" class="comment">
				<?php the_content(); ?>
			</div>
			<?php endwhile; ?>
			<?php locate_template( array( 'post-reply-form.php'), true ); ?>
		</div>
		<?php } ?>
	</div>

<?php endwhile; ?>
</div>

<?php	wp_reset_postdata(); ?>
<?php	remove_Filter('posts_where', array(&$whereFilter, 'add_where_filter')); ?>	