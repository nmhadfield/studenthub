<?php get_header(); ?>
			
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="row">
		<div class="content">
			<div class="columns five">
				<?php the_widget('society_contact_widget', array(), array('post-id' => get_the_ID())); ?>
				<?php the_widget('committee_widget', array(), array('post-id' => get_the_ID())); ?>
			</div>
			
			<div class="columns eleven">
				<div id="infinite-container" class="postarea">
					<?php 
						$widget = new Post_Form_Widget();
						$widget->output(array('id' => get_post_meta(get_the_ID(), 'sh_parent', true)));
						
						$loop = new TopicLoop();
						$loop->output(array('sh_parent' => get_post_meta(get_the_ID(), 'sh_parent', true)));
					?>
				</div>
			</div>
		</div>
	</div>
</div>