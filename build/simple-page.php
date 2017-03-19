<?php /* Template Name: Simple Content Page */ ?>
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
					<div class="article">
						<?php wp_reset_postdata(); ?>
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


