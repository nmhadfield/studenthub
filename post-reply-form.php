<?php
/**
 * Fires before the display of the new topic form.
 *
 * @since 1.5.0
 */
?>

<div id="new-reply-<?php echo(get_the_ID()); ?>" class="bbp-reply-form">

		<form id="new-reply-<?php echo(get_the_ID()); ?>" name="new-reply" method="post" action="<?php the_permalink(); ?>" class="new-reply">

			<fieldset class="bbp-form">
				<input type="hidden" id="bbp_topic_id" name="bbp_topic_id" value="<?php echo(get_the_ID()); ?>"></input>
				<input type="hidden" id="bbp_reply_to" name="bbp_reply_to" value="0"></input>
				<input type="hidden" name="action"     id="bbp_post_action" value="bbp-new-reply" />
				<?php wp_nonce_field( 'bbp-new-reply' );?>
			
				<?php bbp_the_content( array( 'context' => 'reply' ) ); ?>
					<div class="bbp-submit-wrapper">

						<?php do_action( 'bbp_theme_before_reply_form_submit_button' ); ?>

						<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_reply_submit" name="bbp_reply_submit" class="button submit"><?php _e( 'Post', 'bbpress' ); ?></button>

						<?php do_action( 'bbp_theme_after_reply_form_submit_button' ); ?>

					</div>

					<?php do_action( 'bbp_theme_after_reply_form_submit_wrapper' ); ?>

			</fieldset>

			<?php do_action( 'bbp_theme_after_reply_form' ); ?>

		</form>
	</div>