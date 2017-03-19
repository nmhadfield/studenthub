<?php do_action( 'bp_before_new_topic_form' ); ?>
	
<div class="blog-holder shadow radius-full post-250 post type-topic status-publish format-standard hentry">
	<div id="new-post-div">
	<?php if ( is_user_logged_in() ) : ?>
	
		<!-- create the tabs for the different types of posts -->
		<ul class="tab">			
		<?php foreach($forms as $form) { ?> 
			<li><a href="#" class="tablinks" onclick="switchTab(event, '<?php echo($form['forumId']); ?>', <?php echo($form['requiresSubjects']); ?>)"><?php echo($form['title']); ?></a></li>
	  	<?php } ?>
		</ul>
		
		<div id="new-topic" class="bbp-topic-form">
			<form id="new-post" name="new-post" method="post">
				<fieldset class="bbp-form">
					<input type="hidden" id="resource-type" name="resource-type"></input>
					<input type="hidden" id="bbp_forum_id" name="bbp_forum_id" value="<?php echo($forms[0]['forumId']); ?>"></input>
					<div>	
						<?php do_action( 'bbp_theme_before_topic_form_title' ); ?>
						<div>
							<label for="bbp_topic_title"><?php printf( __( 'Topic:', 'bbpress' ), bbp_get_title_max_length() ); ?></label>
							<input type="text" id="bbp_topic_title" value="<?php bbp_form_topic_title(); ?>" class="required" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_title" maxlength="<?php bbp_title_max_length(); ?>" />
						</div>
						
						<?php 
							do_action( 'bbp_theme_after_topic_form_title' );
							do_action( 'bbp_theme_before_topic_form_content' );
							bbp_the_content( array( 'context' => 'topic' ) );
						?>

						<div class="columns section">
							<img src="<?php echo(get_stylesheet_directory_uri().'/images/icons/tags.png'); ?>"/>

							<?php foreach($forms as $form) { ?> 
								<select id="studenthub-subject-<?php echo($form['forumId'])?>" class="hidden multiselect" multiple="multiple">
								<?php foreach ($form['groups'] as $groupName => $categories) { ?>
									<optgroup label="<?php echo($groupName)?>">
									<?php foreach ($categories as $option) { ?>
										<option value="<?php echo($option->name); ?>"><?php echo($option->name); ?></option>
									<?php } ?>
									</optgroup>
								<?php } ?>
								</select>	
	  						<?php } ?>
							
						</div>
						<div class='columns section'>
							<div class='left image-upload'>
							    <label for="file-input" class='image-upload'>
							        <img class='image-upload' src="<?php echo(get_stylesheet_directory_uri().'/images/icons/attachment.png'); ?>"/>
							        <span id='file-name'></span>
							    </label>
							    <input id="file-input" type="file" name="d4p_attachment[]"/>
							</div>
							<div class="bbp-submit-wrapper">
								<div class='middle'>
								<?php do_action( 'bbp_theme_before_topic_form_submit_button' ); ?>
								<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_topic_submit" name="bbp_topic_submit" class="button submit" disabled="disabled"><?php _e( 'Post', 'bbpress' ); ?></button>
								<?php do_action( 'bbp_theme_after_topic_form_submit_button' ); ?>
								</div>
							</div>
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