<?php

/**
 * Displays the content for a single group.
 * @package Student Hub
 * @since Student Hub 1.0
 */
?>

<?php get_header(); ?>
			
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<div class="row">
		<div class="content">

			<div class="columns five">
				 <div class="widget">
				 	<span class="title"><?php echo(get_post(get_the_ID()) -> post_title); ?></span>
				 	<?php echo(get_post(get_the_ID()) -> post_content) ?>
				 </div>
			</div>
			
			<div class="columns eleven">
				<div id="infinite-container" class="postarea">
					<?php 
						if (groups_is_user_member( bp_loggedin_user_id(), bp_get_current_group_id() )) {
					 		the_widget('topic_loop_widget', array(), array('sh_parent' => groups_get_groupmeta( $bp->groups->current_group->id, 'forum_id' )[0])); 
						}
						else {
							echo("not a member of group");
						}
					 ?>
				</div>
			</div>

		</div>
	</div>
</div>