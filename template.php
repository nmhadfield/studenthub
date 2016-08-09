<?php

/* only create the img tag if we have a logo for this category. */
function do_logo($category) {
	
	// all our categories are organised into hierarchy so if there's no parent, we're not interested
	
	if ($category->parent) {
		$dir = get_category($category->parent)->slug;

		$filename = $category->slug.".png";
		$file = '/images/icons/'.$dir.'/'.$filename;
		
		// note we need to look for the file on the file system, but obviously we need the uri for deployed server
		if (file_exists(get_stylesheet_directory().$file)) {
			echo('<img class="logo" src="');
			echo(get_stylesheet_directory_uri().$file);
			echo('"></img>');
		}
	}
}

function do_categories($categories) {
	foreach ($categories as $cat) {
		echo($cat->name);
	}
}

?>