<?php
	do_action( 'bp_before_new_topic_form' ); ?>
	
	<div class="blog-holder shadow radius-full post-250 post type-topic status-publish format-standard hentry">
	<div id="new-post-div">
	<?php if ( is_user_logged_in() ) : ?>
	
		<!-- create the tabs for the different types of posts -->
		<ul class="tab">			
		<?php foreach($args['forums'] as $forumId) { 
			$title = get_post_meta($forumId, 'sh_new_post_title', true);
			if (!$title) {
				$title = 'Post in '.get_the_title($forumId);
			}
			?> <li><a href="#" class="tablinks" onclick="switchTab(event, '<?php echo($forumId); ?>', '<?php echo($forumId); ?>')"><?php echo($title); ?></a></li>
	  	<?php } ?>
		</ul>
		
		<div id="new-topic" class="bbp-topic-form">
			<form id="new-post" name="new-post" method="post" action="<?php echo($GLOBALS['hub_url']); ?>">
				<fieldset class="bbp-form">
					<input type="hidden" id="resource-type" name="resource-type"></input>
					<input type="hidden" id="bbp_forum_id" name="bbp_forum_id" value="<?php echo($forumId); ?>"></input>
					<div>	
						<?php do_action( 'bbp_theme_before_topic_form_title' ); ?>
					
						<label for="bbp_topic_title"><?php printf( __( 'Topic:', 'bbpress' ), bbp_get_title_max_length() ); ?></label>
						<input type="text" id="bbp_topic_title" value="<?php bbp_form_topic_title(); ?>" class="required" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_title" maxlength="<?php bbp_title_max_length(); ?>" />
						
						<?php 
							if (get_post_meta($forumId, 'sh_new_post_requires_subjects', true))	{
								locate_template( array( 'content/select-subject.php'), true ); 
							}
						?>
						
						<div id="sh-new-post-url">
							<label for="sh-url"><?php printf( __( 'Link:', 'bbpress' ), bbp_get_title_max_length() ); ?></label>
							<input type="text" id="sh-url" name="studenthub-url" value="" tabindex="<?php bbp_tab_index(); ?>" size="80" />
						</div>
						
						<?php do_action( 'bbp_theme_after_topic_form_title' ); ?>
						<?php do_action( 'bbp_theme_before_topic_form_content' ); ?>
						<?php bbp_the_content( array( 'context' => 'topic' ) ); ?>
						
						<div id="attachments-section">
							<?php do_action( 'bbp_theme_after_topic_form_content' ); ?>
							<?php do_action( 'bbp_theme_before_topic_form_submit_wrapper' ); ?>
						</div>
						
						<div class="bbp-submit-wrapper">
							<?php do_action( 'bbp_theme_before_topic_form_submit_button' ); ?>
							<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_topic_submit" name="bbp_topic_submit" class="button submit" disabled="disabled"><?php _e( 'Post', 'bbpress' ); ?></button>
							<?php do_action( 'bbp_theme_after_topic_form_submit_button' ); ?>
						</div>
		
						<?php do_action( 'bbp_theme_after_topic_form_submit_wrapper' ); ?>
		
					</div>
		
					<?php bbp_topic_form_fields(); ?>
		
				</fieldset>
		
				<?php do_action( 'bbp_theme_after_topic_form' ); ?>
		
			</form>
	</div>
	</div>
	
	<?php endif; ?>
	</div>

<?php do_action( 'bp_after_new_topic_form' ); ?>