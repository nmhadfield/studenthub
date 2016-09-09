<?php 
$tmp_post = $GLOBALS['post'];

$bbp_comments = bbp_parse_args('', array(
	'post_parent'		  => get_the_ID(),	
	'post_type'           => bbp_get_reply_post_type(),
	'posts_per_page'	  => -1,	
	'order'               => 'ASC'), 'has_topics' );
	
$commentsquery = new WP_Query( $bbp_comments );
?>
	
<div id="comments-<?php echo(get_the_ID());?>" class="comments">
	
	<?php while ($commentsquery->have_posts()) : $commentsquery->the_post();?>
	<div id="comment-<?php echo(get_the_ID())?>" class="comment">
		<?php the_content(); ?>
	</div>
	<?php endwhile; ?>
	 
	<?php $GLOBALS['post'] = $tmp_post;
	locate_template( 'post-reply-form.php', true, false); ?>
</div>
