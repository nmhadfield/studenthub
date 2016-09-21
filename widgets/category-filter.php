<div class="browse-category">
	<h2><?php echo($args['label']); ?></h2>
		<ul class="browse">
		
		<?php $categories = get_terms('category', array('hide_empty' => false, 'parent' => $GLOBALS[$args['group']])); ?>
		<?php foreach ($categories as $cat) { ?>
			<li>
				<a href="#" onclick="sh_filterResources(event, '<?php echo($cat->name)?>')"><?php echo($cat->name)?></a>
			</li>
		<?php }?>
</ul>
</div>