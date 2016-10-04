<div class="widget browse-category collapsed">
	<span class="title"><?php echo($args['label']); ?></span>
	<span><a href="#" onclick="sh_expandCollapse(event, '<?php echo($args['label']); ?>')" class="expand-collapse collapsed"></a></span>
	<div id="<?php echo($args['label'].'-widget-content'); ?>" class="widget-content collapsed">
		<ul class="browse">
		<?php $categories = get_terms('category', array('hide_empty' => false, 'parent' => $GLOBALS[$args['group']])); ?>
		<?php foreach ($categories as $cat) { ?>
			<li>
				<a href="#" onclick="sh_filterResources(event, '<?php echo($cat->name)?>')"><?php echo($cat->name)?></a>
			</li>
		<?php }?>
		</ul>
	</div>
</div>