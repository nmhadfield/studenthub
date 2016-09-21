
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
    	$("#new-post-div").addClass("posting");
        $(this).ajaxSubmit({success: refreshAfterPosting});
        return false;
    });
});

function switchTab(evt, key, forumId) {
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
		
		document.getElementById("bbp_forum_id").value = forumId;
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
