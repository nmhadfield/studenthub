jQuery(document).ready(function($) {
    
    // support for infinite loading of posts
    var win = $(window);
	win.scroll(function() {
		// End of the document reached?
		if ($(document).height() - win.height() == win.scrollTop()) {
			feed();
		}
	});
});

function feed() {
	var link = jQuery("a.feed:last");
	if (link.length) {
		var before = link.attr('href');
		link.remove();
		
		var feed = jQuery.get(ajaxurl, {action: 'studenthub_reload_feed', before: before});
		feed.done(function(html) {
			var parent = jQuery("#topic-loop").parent();
			parent.append( html);
			prepCommentsForm();
		});
	}
}

function refreshAfterPosting() {
	var link = jQuery("input.timestamp:first");
	if (link.length) {
		var feed = jQuery.get(ajaxurl, {action: 'studenthub_reload_feed', after: link.val()});
		feed.done(function(html) {
			var parent = jQuery("#topic-loop");
			parent.prepend(html);
		});
	}
	jQuery("#new-post").trigger("reset");
	closeForm();
}
