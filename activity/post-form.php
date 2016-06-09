<?php
/**
 * Fires before the display of the new topic form.
 *
 * @since 1.5.0
 */
do_action( 'bp_before_new_topic_form' ); ?>

<?php 
	$groups = array();
	$groups["question"] = array("key"=>"question", "url"=>"qa", "label"=>"Ask a Question");
	$groups["resource"] = array("key"=>"resource", "url"=>"resources", "label"=>"Upload Resource");
	$groups["link"] = array("key"=>"link", "url"=>"links", "label"=>"Share a Link");
?>

<div id="new-post">
<?php if ( is_user_logged_in() ) : ?>

		<!-- create the tabs for the different types of posts -->
		<ul class="tab">			
		<?php foreach($groups as $key => $group) { ?>
		  	<li><a href="#" class="tablinks" onclick="switchTab(event, '<?php echo($key)?>')"><?php echo($group['label'])?></a></li>
	  	<?php } ?>
		</ul>
		
		<!-- create the forms for the different types of posts -->
		<?php foreach($groups as $key => $group) { ?>
			<div id="tab-<?php echo($key) ?>" class="tabcontent">
			
				<div id="new-topic-<?php bbp_topic_id(); ?>" class="bbp-topic-form">

					<?php $fullUrl = "http://localhost:8888/wordpress/forums/forum/".$group['url'].'/'?>
					<form id="new-post" name="new-post" method="post" action="<?php echo($fullUrl) ?>">
			
						<?php do_action( 'bbp_theme_before_topic_form' ); ?>
			
						<fieldset class="bbp-form">
			
							<?php do_action( 'bbp_theme_before_topic_form_notices' ); ?>
							<?php do_action( 'bbp_template_notices' ); ?>
			
							<div>
								<?php bbp_get_template_part( 'form', 'anonymous' ); ?>
			
								<?php do_action( 'bbp_theme_before_topic_form_title' ); ?>
			
								<p>
									<label for="bbp_topic_title"><?php printf( __( 'Title (Maximum Length: %d):', 'bbpress' ), bbp_get_title_max_length() ); ?></label><br />
									<input type="text" id="bbp_topic_title" value="<?php bbp_form_topic_title(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_title" maxlength="<?php bbp_title_max_length(); ?>" />
								</p>
			
								<?php do_action( 'bbp_theme_after_topic_form_title' ); ?>
								<?php do_action( 'bbp_theme_before_topic_form_content' ); ?>
								<?php bbp_the_content( array( 'context' => 'topic' ) ); ?>
								<?php do_action( 'bbp_theme_after_topic_form_content' ); ?>
			
								<?php if ( bbp_allow_topic_tags() && current_user_can( 'assign_topic_tags' ) ) : ?>
			
									<?php do_action( 'bbp_theme_before_topic_form_tags' ); ?>
			
									<p>
										<label for="bbp_topic_tags"><?php _e( 'Topic Tags:', 'bbpress' ); ?></label><br />
										<input type="text" value="<?php bbp_form_topic_tags(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_tags" id="bbp_topic_tags" <?php disabled( bbp_is_topic_spam() ); ?> />
									</p>
			
									<?php do_action( 'bbp_theme_after_topic_form_tags' ); ?>
			
								<?php endif; ?>
	
								<?php if ( bbp_is_subscriptions_active() && !bbp_is_anonymous() && ( !bbp_is_topic_edit() || ( bbp_is_topic_edit() && !bbp_is_topic_anonymous() ) ) ) : ?>
			
									<?php do_action( 'bbp_theme_before_topic_form_subscriptions' ); ?>
			
									<p>
										<input name="bbp_topic_subscription" id="bbp_topic_subscription" type="checkbox" value="bbp_subscribe" <?php bbp_form_topic_subscribed(); ?> tabindex="<?php bbp_tab_index(); ?>" />
			
										<?php if ( bbp_is_topic_edit() && ( bbp_get_topic_author_id() !== bbp_get_current_user_id() ) ) : ?>
			
											<label for="bbp_topic_subscription"><?php _e( 'Notify the author of follow-up replies via email', 'bbpress' ); ?></label>
			
										<?php else : ?>
			
											<label for="bbp_topic_subscription"><?php _e( 'Notify me of follow-up replies via email', 'bbpress' ); ?></label>
			
										<?php endif; ?>
									</p>
			
									<?php do_action( 'bbp_theme_after_topic_form_subscriptions' ); ?>
			
								<?php endif; ?>
			
								<?php do_action( 'bbp_theme_before_topic_form_submit_wrapper' ); ?>
			
								<div class="bbp-submit-wrapper">
			
									<?php do_action( 'bbp_theme_before_topic_form_submit_button' ); ?>
			
									<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_topic_submit" name="bbp_topic_submit" class="button submit"><?php _e( 'Submit', 'bbpress' ); ?></button>
			
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
		<?php } ?>

<?php endif; ?>
</div><!-- #new-topic-post -->

<?php do_action( 'bp_after_new_topic_form' ); ?>