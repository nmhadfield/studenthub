/** Show the feed for an individual group */
function openGroup(groupId) {
	var feed = jQuery.get(ajaxurl, {action: 'studenthub_reload_feed', parent: groupId});
	
	feed.done(function (html) {
		var parent = jQuery("#topic-loop").parent();
    	jQuery("#topic-loop").remove();
		parent.append(html);
	});
	
	return false;
}