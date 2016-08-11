<div class="browse-category">
	<h2><?php echo($args['label']); ?></h2>
		<ul class="browse">
		
		<?php 
			$categories = get_terms('category', array('hide_empty' => false, 'parent' => $GLOBALS[$args['group']]));
			foreach ($categories as $cat) {
				if ($cat->count >0) { ?>
			<li>
				<a href="#" onclick="filterResources(event, '<?php echo($cat->name)?>')"><?php echo($cat->name)?></a>
			</li>
				<?php }
			}
		?>
</ul>
</div>