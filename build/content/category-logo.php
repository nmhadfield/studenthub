<?php if ($file) { ?>
<img class="<?php echo($class)?>" src="<?php echo(get_stylesheet_directory_uri().$file); ?>"></img>
<?php } ?>
<?php if ($uri) { ?>
<img class="<?php echo($class)?>" src="<?php echo($uri); ?>"></img>
<?php } ?>

