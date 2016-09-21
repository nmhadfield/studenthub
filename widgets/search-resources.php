<div class="widget">	
	<div id="sh-search-div" class="article shadow blog-holder">
		<form id="sh-search-form">
			<label>Search</label>
			<input id="sh-new-search-term" name="sh-new-search-term"></input>
			<div id="sh-search-terms"></div>
			<?php the_widget('category_filter_widget', array(), array('label' => 'Systems', 'group' => 'systems')); ?>
			<?php the_widget('category_filter_widget', array(), array('label' => 'Clinical Blocks', 'group' => 'clinical_blocks')); ?>
			<?php the_widget('category_filter_widget', array(), array('label' => 'Themes', 'group' => 'themes')); ?>	
			<?php the_widget('category_filter_widget', array(), array('label' => 'Locations', 'group' => 'locations')); ?>		
		</form>
	</div>
</div>
