<?php
	$id = get_the_ID();
	$selected = sh_is_Favourite($id);
	$iconstate = $selected ? 'true' : 'false';
	$class = 'favourite-'.$iconstate;
?>

<a href="#" onclick="toggleFavourite(event, '<?php echo($id)?>')" class="<?php echo($class)?>"></a>
