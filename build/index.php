<?php get_header(); ?>			
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">
	<div class="row">
		<div class="menu">
			<?php sh_page_menu(); ?>
		</div>
		<div class="content">
			<div class="columns five">
				<?php sh_sidebar(); ?> 
			</div>
			
			<div class="columns eleven">
				<div id="infinite-container" class="postarea">
					<?php sh_page_content();?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>	
