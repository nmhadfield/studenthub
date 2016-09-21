<div id="studenthub-societies" class="widget article shadow blog-holder">
	<h2>Societies</h2>
	<ul class="browse">
		<?php $query = new WP_Query( array('post_type' => 'forum', 'post_parent' => $GLOBALS["societies"]) ); ?>
				
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			<li><a href="<?php echo(the_permalink());?>"><?php echo(the_title()); ?></a></li>
		<?php endwhile; ?>
	</ul>
</div>