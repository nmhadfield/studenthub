
jQuery(document).ready(function($) {
    $('#bbp_topic_content').addClass("required");
    
    $(".required").change(buttonState);
    $(".required").keyup(buttonState);
    $(".multiselect").change(buttonState);
    
    $("#new-post").submit(function(event) {
    	$("#new-post-div").addClass("posting");
        $(this).ajaxSubmit({success: refreshAfterPosting});
        return false;
    });
    
    $("#file-input").change(function(event) {
    	$("#file-name").text($('#file-input').val());
    });
});

function buttonState() {
   	empty = jQuery("#bbp_topic_id").val() == '';
   	if (jQuery(".multiselect.active").hasClass('required')) {
       	empty = jQuery(".multiselect.active").multiselect("getChecked").length == 0;
   	}
	empty = empty || jQuery("#bbp_topic_content").val() == '';
		
    if (empty) {
    	jQuery('#bbp_topic_submit').attr('disabled', 'disabled'); 
    } 
    else {
    	jQuery('#bbp_topic_submit').removeAttr('disabled');
    }
};

function switchTab(evt, forumId, requiresSubjects) {
	var active = evt.currentTarget.className.indexOf("active") >= 0;
	
	closeForm();
	
	if (!active) {
		document.getElementById("new-topic").style.display = "block";
		evt.currentTarget.className += " active";
		
		document.getElementById("bbp_forum_id").value = forumId;
		
		jQuery(".multiselect.active").multiselect("destroy");
		jQuery(".multiselect.active").attr("style", "");
		
		// reset all selects, so we can target the chosen one
		jQuery(".multiselect").addClass("hidden");
		jQuery(".multiselect").removeClass('required');
		jQuery(".multiselect").removeClass('active');
		jQuery(".multiselect").attr("name", "");
		
		// the chosen one
		var select = jQuery('#studenthub-subject-' + forumId);
		if (requiresSubjects) {
			select.addClass('required');
		}
		select.addClass("active");
		select.removeClass("hidden");
		select.attr("name", "studenthub-subject-select[]");
		select.multiselect({"header": false, "selectedList": 4, "classes": "multiselect-widget", "noneSelectedText": "Choose categories"});
		
		buttonState();
	}
	evt.preventDefault();
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
