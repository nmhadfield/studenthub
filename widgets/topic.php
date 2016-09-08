<!--  displays an individual post -->
<div class="blog-holder shadow radius-full post-250 post type-topic status-publish format-standard hentry">		
	<div id="post-<?php echo(get_the_ID())?>" class="article">
		<!-- this is used for updating the feed -->
		<input type="hidden" class="timestamp" value="<?php echo(get_the_date("Y-m-d H:i:s")); ?>"></input>
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
		
		<?php 
				$attachments = get_posts( array('post_type' => 'attachment', 'posts_per_page' => 1, 'post_parent' => get_the_ID(), 'exclude' => get_post_thumbnail_id()));
			
        		if ( $attachments ) { ?> 
        			<div> <?php 
	            	foreach ( $attachments as $attachment ) {
	                	echo(do_shortcode("[gview file ='".wp_get_attachment_url($attachment -> ID)."']"));
	            	} ?>
	            	</div> <?php 
        		}
		?>
			
		<div class="article-functions">
			<?php do_action( 'bbp_theme_before_reply_content' ); ?>
			<?php do_action( 'bbp_theme_after_reply_content' ); ?>
			<?php the_widget('favourite_widget', array(), array('postId' => get_the_ID())); ?>
			<a href="#" onclick="showComments(event, '<?php echo(get_the_ID())?>')">Comments</a>
		</div>
	
		<?php the_widget( 'comments_widget' ); ?>
	</div>
</div>