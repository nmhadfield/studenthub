<div class="widget">	
	<span class="title">Search</span>
	<div id="sh-search-div" class="widget-content">
		<form id="sh-search-form">
			<input id="sh-new-search-term" name="sh-new-search-term"></input>
			<div id="sh-search-terms"></div>
		</form>
	</div>
</div>

<?php the_widget('category_filter_widget', array(), array('label' => 'Systems', 'group' => 'systems')); ?>		
<?php the_widget('category_filter_widget', array(), array('label' => 'Clinical Blocks', 'group' => 'clinical_blocks')); ?>
<?php the_widget('category_filter_widget', array(), array('label' => 'Themes', 'group' => 'themes')); ?>	
<?php the_widget('category_filter_widget', array(), array('label' => 'Locations', 'group' => 'locations')); ?>		