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

<div id="new-post-div">
<?php if ( is_user_logged_in() ) : ?>

	<!-- create the tabs for the different types of posts -->
	<ul class="tab">			
	<?php foreach($groups as $key => $group) { ?>
	  	<li><a href="#" class="tablinks" onclick="switchTab(event, '<?php echo($key)?>')"><?php echo($group['label'])?></a></li>
  	<?php } ?>
	</ul>
	
	<div id="new-topic" class="bbp-topic-form">

		<form id="new-post" name="new-post" method="post" action="<?php echo($GLOBALS['resources_url']); ?>">
		
			<fieldset class="bbp-form">
				<input type="hidden" id="resource-type" name="resource-type"></input>
				<input type="hidden" id="bbp_forum_id" name="bbp_forum_id" value="<?php echo($GLOBALS['resources']); ?>"></input>
				<div>	
					<?php do_action( 'bbp_theme_before_topic_form_title' ); ?>
				
					<label for="bbp_topic_title"><?php printf( __( 'Topic:', 'bbpress' ), bbp_get_title_max_length() ); ?></label>
					<input type="text" id="bbp_topic_title" value="<?php bbp_form_topic_title(); ?>" class="required" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_title" maxlength="<?php bbp_title_max_length(); ?>" />
					
					<?php locate_template( array( 'activity/subject-select.php'), true ); ?>
					
					<?php do_action( 'bbp_theme_after_topic_form_title' ); ?>
					<?php do_action( 'bbp_theme_before_topic_form_content' ); ?>
					<?php bbp_the_content( array( 'context' => 'topic' ) ); ?>
					
					<div id="attachments-section">
						<?php do_action( 'bbp_theme_after_topic_form_content' ); ?>
						<?php do_action( 'bbp_theme_before_topic_form_submit_wrapper' ); ?>
					</div>
					
					<div class="bbp-submit-wrapper">
						<?php do_action( 'bbp_theme_before_topic_form_submit_button' ); ?>
						<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_topic_submit" name="bbp_topic_submit" class="button submit" disabled="true"><?php _e( 'Post', 'bbpress' ); ?></button>
						<?php do_action( 'bbp_theme_after_topic_form_submit_button' ); ?>
					</div>
	
					<?php do_action( 'bbp_theme_after_topic_form_submit_wrapper' ); ?>
	
				</div>
	
				<?php bbp_topic_form_fields(); ?>
	
			</fieldset>
	
			<?php do_action( 'bbp_theme_after_topic_form' ); ?>
	
		</form>
</div>

<?php endif; ?>
</div><!-- #new-topic-post -->

<?php do_action( 'bp_after_new_topic_form' ); ?>