<?php
?>

<?php get_header(); ?>
			
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<div class="row">
		<div class="content">

			<div class="columns five">
				<?php the_widget( 'deadlines_widget' ); ?>
				<?php the_widget( 'tasks_widget' ); ?>
			</div>
			
			<div class="columns eleven">
				<div id="infinite-container" class="postarea">
					This is where you'll be able to upload a photo and customise your news feed
				</div>
			</div>
		</div>
	</div>
</div>