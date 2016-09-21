<?php
	$groups = groups_get_groups()['groups'];
?>
<div id="studenthub-peer-mentor-groups" class="widget article shadow blog-holder">
	<h2>Peer Mentor Communities</h2>
	<ul class="browse">
		<?php for ($i = 0; $i < count($groups); $i++) { ?>
			<li><a href="#" onClick="openGroup('<?php echo(groups_get_groupmeta($groups[$i] -> id, 'forum_id')[0]); ?>')"><?php echo($groups[$i] -> name); ?></a></li>
		<?php } ?>
	</ul>
</div>