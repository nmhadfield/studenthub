

function showComments(evt, postId) {
	var target = jQuery("#comments-".concat(postId));
	
	if (!target.hasClass("active")) {
		target.addClass("active");
	}
	else {
		target.removeClass("active");
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

function refreshComments() {
	// passed in using bind
	var postId = this.postId;
	var feed = jQuery.get(ajaxurl, {action: 'studenthub_reload_comment_feed', postId: postId});
	
	feed.done(function (html) {
		var parent = jQuery("#comments-".concat(postId)).parent();
    	jQuery("#comments-".concat(postId)).remove();
		parent.append(html);
		jQuery("#comments-".concat(postId)).addClass("active");
		
		prepCommentsForm();	
	});
}



