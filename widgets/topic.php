<!--  displays an individual post -->
<div class="blog-holder shadow radius-full post-250 post format-standard hentry">		
	<div id="post-<?php echo(get_the_ID())?>" class="article">
		<!-- this is used for updating the feed -->
		<input type="hidden" class="timestamp" value="<?php echo(get_the_date("Y-m-d H:i:s")); ?>"></input>
		
		<?php $tmp_post = $GLOBALS['post']; ?>
		
		<div class="post-main">
			<div class="left">
				<?php the_widget('category_logo_widget', array(), array('forum' => $tmp_post -> post_parent)); ?>
			</div>
			
			<div class="middle">
				<a href="<?php the_permalink(); ?>"><span class="title"><?php the_title(); ?></span></a>
				<div class="post-categories">
				<?php 
				$categories = wp_get_object_terms(get_the_ID(), 'category', array('fields' => 'all'));
				foreach ($categories as $cat) { 
					the_widget('category_logo_widget', array(), array('category' => $cat));
				}
				?>
			</div>
				<p><?php echo($tmp_post -> post_content); ?></p>
				<?php the_widget("link_widget") ?>
				<?php 
						$attachments = get_posts( array('post_type' => 'attachment', 'posts_per_page' => 1, 'post_parent' => get_the_ID(), 'exclude' => get_post_thumbnail_id()));
					
		        		if ( $attachments ) { ?> 
		        			<div> 
		        			<?php 
			            	foreach ( $attachments as $attachment ) {
			            		$url = wp_get_attachment_url($attachment -> ID);
			            		if (is_image($url)) { ?>
			            			<img src="<?php echo($url); ?>" class="embed"></img>
			            		<?php }
			            		else {
			                		echo(do_shortcode("[gview file ='".$url."']"));
			            		}
			            	} 
			            	?>
			            	</div> <?php 
		        		}
				?>
			</div>
		</div>
		
		<div class="post-footer">
			<!-- div class="author">Posted by <?php echo(get_the_author_meta('first_name').' '.get_the_author_meta('last_name')); ?></div-->
			<div class="article-functions">
				<?php do_action( 'bbp_theme_before_reply_content' ); ?>
				<?php do_action( 'bbp_theme_after_reply_content' ); ?>
				<?php the_widget('favourite_widget', array(), array('postId' => get_the_ID())); ?>
				<a href="#" onclick="showComments(event, '<?php echo(get_the_ID())?>')">Comments</a>
			</div>
		</div>
	
		<?php the_widget( 'comments_widget' ); ?>
	</div>
</div>
