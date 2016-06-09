function switchTab(evt, key) {
	
	console.log("here we are");
	var active = evt.currentTarget.className.indexOf("active") >= 0;
	
	
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

	// If the tab was not already active, now show it and tab, and add an "active" class to the link that opened the tab
	if (!active) {
		document.getElementById("tab-" + key).style.display = "block";
		evt.currentTarget.className += " active";
	}
}