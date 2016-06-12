function switchTab(evt, key) {
	var active = evt.currentTarget.className.indexOf("active") >= 0;
	
	closeTabs();

	// If the tab was not already active, now show it and tab, and add an "active" class to the link that opened the tab
	if (!active) {
		document.getElementById("tab-" + key).style.display = "block";
		evt.currentTarget.className += " active";
	}
}

function closeTabs() {
	// Get all elements with class="tabcontent" and hide them
	var tabcontent = document.getElementsByClassName("tabcontent");
	for (var i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
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
        	closeTabs();
        });

      });
});
