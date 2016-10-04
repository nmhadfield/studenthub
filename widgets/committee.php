<div id="studenthub-deadlines" class="widget article shadow blog-holder">
	<h2>Committee</h2>
	<ul class='browse'>
		<?php foreach ($results as $person) { ?>
			<li class="title"><?php echo($person['role']); ?></li>
			<li><a href='mailto:<?php echo($person['email']); ?>'><?php echo($person['name']); ?></a></li>
		<?php } ?>
	</ul>
</div>