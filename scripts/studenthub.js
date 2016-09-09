jQuery(document).ready(function($) {
    $("#studenthub-subject-select").multiselect({"header": false, "selectedList": 4});
    
    $(".multi-select").multiselect({"header": false, "selectedList": 4});
    
    $('#bbp_topic_content').addClass("required");
    
    buttonState = function() {
       	empty = $("#bbp_topic_id").val() == '';
    	empty = empty || $("#studenthub-subject-select").multiselect("getChecked").length == 0;
		empty = empty || $("#bbp_topic_content").val() == '';
    		
        if (empty) {
            $('#bbp_topic_submit').attr('disabled', 'disabled'); 
        } 
        else {
            $('#bbp_topic_submit').removeAttr('disabled');
        }
    };
    
    $(".required").change(buttonState);
    $(".required").keyup(buttonState);
    
    $("#new-post").submit(function(event) {
        $(this).ajaxSubmit({success: refreshAfterPosting});
        return false;
    });
    
    prepCommentsForm();
    
    // support for infinite loading of posts
    var win = $(window);
	win.scroll(function() {
		// End of the document reached?
		if ($(document).height() - win.height() == win.scrollTop()) {
			feed();
		}
	});
});

function prepCommentsForm() {
    jQuery("form[id^='new-reply']").submit(function(event) {
    	var context = {postId: jQuery("#bbp_topic_id").val()};
    	jQuery(this).ajaxSubmit({success: refreshComments.bind(context)});
        return false;
    });	
}

function showComments(evt, postId) {
	var target = jQuery("#comments-".concat(postId));
	
	if (!target.hasClass("active")) {
		target.addClass("active");
	}
	else {
		target.removeClass("active");
	}
}

function switchTab(evt, key) {
	var active = evt.currentTarget.className.indexOf("active") >= 0;
	
	closeForm();
	
	if (!active) {
		document.getElementById("resource-type").value = key;
		
		if (key == 'resource') {
			document.getElementById("attachments-section").style.display = "block";
		}
		else {
			document.getElementById("attachments-section").style.display = "none";
		}
		
		if (key == 'link') {
			document.getElementById("sh-new-post-url").style.display = "block";
			document.getElementById("sh-url").className += " required";
		}
		else {
			document.getElementById("sh-new-post-url").style.display = "none";
			evt.currentTarget.className.replace(" required", "");
		}
		
		document.getElementById("new-topic").style.display = "block";
		evt.currentTarget.className += " active";
	}
}

function closeForm() {
	var form = document.getElementById("new-topic");
	if (form) {
		form.style.display = "none";
	}

	// Get all elements with class="tablinks" and remove the class "active"
	var tablinks = document.getElementsByClassName("tablinks");
	for (var i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
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
	return false;
}

