<?php

/**
 * Template Name: BuddyPress - Activity Directory
 *
 * @package BuddyPress
 * @subpackage Theme
 */

get_header( 'buddypress' ); ?>

	<?php do_action( 'bp_before_directory_activity_page' ); ?>

	<div id="content">
		<div class="padder">

			<?php do_action( 'bp_before_directory_activity' ); ?>

			<?php if ( !is_user_logged_in() ) : ?>

				<h3><?php _e( 'Site Activity', 'buddypress' ); ?></h3>

			<?php endif; ?>

			<?php do_action( 'bp_before_directory_activity_content' ); ?>

			<?php if ( is_user_logged_in() ) : ?>

				<?php locate_template( array( 'activity/post-form.php'), true ); ?>

			<?php endif; ?>

			<?php do_action( 'template_notices' ); ?>

			<?php do_action( 'bp_before_directory_activity_list' ); ?>

			<div class="activity" role="main">

				<?php locate_template( array( 'activity/activity-loop.php' ), true ); ?>

			</div><!-- .activity -->

			<?php do_action( 'bp_after_directory_activity_list' ); ?>

			<?php do_action( 'bp_directory_activity_content' ); ?>

			<?php do_action( 'bp_after_directory_activity_content' ); ?>

			<?php do_action( 'bp_after_directory_activity' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php do_action( 'bp_after_directory_activity_page' ); ?>

<?php get_sidebar( 'buddypress' ); ?>
<?php get_footer( 'buddypress' ); ?>
