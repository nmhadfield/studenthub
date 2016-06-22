<?php
 	$link = get_post_meta(get_the_ID(), "link", true);

 	if (!empty($link)) { ?>
 		<p>
 			<a href="<?php echo($link)?>" target="_blank"><?php echo($link)?></a>
 		</p>
<?php 
 	}
?>