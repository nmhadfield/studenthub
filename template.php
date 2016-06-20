<?php

/* only create the img tag if we have a logo for this category. */
function do_logo($category) {
	
	$filename = "/img/".$category->slug.".png";
	$file = get_stylesheet_directory().$filename;
	
	if (file_exists($file)) {
		echo('<img class="logo" src="');
		echo(get_stylesheet_directory_uri().$filename);
		echo('"></img>');
	}
}

?>