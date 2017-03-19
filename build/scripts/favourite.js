function toggleFavourite(event, postId) {
	button = jQuery(event.target);
	enabled = false;
	
	if (button.hasClass('favourite-false')) {
		jQuery(event.target).removeClass("favourite-false");
		jQuery(event.target).addClass("favourite-true");
		enabled = true;
	}
	else {
		jQuery(event.target).removeClass("favourite-true");
		jQuery(event.target).addClass("favourite-false");
	}
	
	jQuery.post(ajaxurl, {action: 'studenthub_make_favourite', enabled: enabled, postId: postId});
	
	
	// do this so that the page doesn't scroll back to the top
	event.preventDefault();
}