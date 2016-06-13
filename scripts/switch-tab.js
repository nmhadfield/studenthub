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

jQuery(document).ready(function($) {
    $("#studenthub-subject-select").multiselect({"header": false, "selectedList": 4});
    
    $("#new-post-form").submit(function(event) {

        event.preventDefault();
        
        var $form = $(this);
        var url = $form.attr( 'action' );

        var posting = $.post( url, $("#new-post-form").serialize() );

        posting.done(function( data ) {
        	closeForm();
        	var parent = $("#topic-loop").parent();
        	$("#topic-loop").remove();
        });

      });
});
