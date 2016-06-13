<div class="blog-holder shadow radius-full post-250 post type-topic status-publish format-standard hentry">		
	<div class="article">
		<?php $categories = wp_get_object_terms(get_the_ID(), 'category', array('fields' => 'all')); ?>
		<?php foreach ($categories as $cat) { ?>
			<img class="logo" src="<?php echo(get_stylesheet_directory_uri()."/img/".$cat->slug.".png"); ?>"></img>
		<?php } ?>
		
		<b><?php the_title(); ?></b><br>
		<?php the_excerpt(); ?>
		<?php do_action( 'bbp_theme_before_reply_content' ); ?>
		<?php do_action( 'bbp_theme_after_reply_content' ); ?>
	</div>
</div>