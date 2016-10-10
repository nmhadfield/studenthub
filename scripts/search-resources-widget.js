jQuery(document).ready(function($) {
    $("form[id^='sh-search-form']").submit(function(event) {
    	sh_filterResources(event);
        return false;
    });
});

function sh_filterResources(event, category) {
	// add the newly selected category to the existing search terms
	var categories = category ? category : "";
	jQuery(".sh-search-cat label").each(function() {
		if (categories.length) {
			categories += "+";
		}
		categories += jQuery(this).val();
	});
	if (category) {
		jQuery("#sh-search-terms").append("<div class='sh-search-cat'><a href='' onclick='sh_removeSearchTerm(event)' class='remove'></a><label>" + category + "</label></div>");
	}
	
	// any search terms within the title or content of a post
	var term = jQuery("#sh-new-search-term").val();
	var terms = term ? term : "";
	jQuery(".sh-search-term label").each(function() {
		if (terms.length) {
			terms += "+";
		}
		terms += jQuery(this).val();
	});
	if (term) {
		jQuery("#sh-search-terms").append("<div class='sh-search-term'><a href='' onclick='sh_removeSearchTerm(event)' class='remove'></a><label>" + term + "</label></div>");
		jQuery("#sh-new-search-term").val("");
	}
	
	var feed = jQuery.get(ajaxurl, {action: 'studenthub_reload_feed', sh_category: categories, sh_searchterms: terms, sh_parent: jQuery("#sh_parent").val()});
	
	feed.done(function (html) {
		var parent = jQuery("#topic-loop").parent();
    	jQuery("#topic-loop").remove();
		parent.append(html);
	});
	
	event.preventDefault();
}

function sh_removeSearchTerm(event) {
	jQuery(event.currentTarget).parent().remove();
	sh_filterResources(event);
}

function sh_expandCollapse(event, id) {
	var button = jQuery(event.currentTarget);
	var div = jQuery('#' + id + '-widget-content');
	if (button.hasClass("collapsed")) {
		button.removeClass("collapsed");
		div.removeClass("collapsed");
	}
	else {
		button.addClass("collapsed");
		div.addClass("collapsed");
	}
	event.preventDefault();
}
