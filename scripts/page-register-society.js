jQuery(document).ready(function($) {
	$('#sh_register_society_add_committee_member').click(function(event) {
		var table = $("#sh_register_society_committee_table tbody");
		var rowNumber = $('#sh_register_society_committee_table tr').length;
		
		var row = "<tr><td>";
		row += "<input name='sh_register_society_role[" + rowNumber + "]' ";
		row += "value='" + $('#sh_register_society_role').val() + "'></input>";
		row += "</td><td>";
		row += "<input name='sh_register_society_email[" + rowNumber + "]' ";
		row += "value='" + $('#sh_register_society_email').val() + "'></input>";
		row += "</td></tr>";
		table.append(row);
		
		$('#sh_register_society_role').val('');
		$('#sh_register_society_email').val('');
		event.preventDefault();
	});
	
	$('#sh-register-society').submit(function(event) {
		$(this).ajaxSubmit({success: function(html) {console.log('done');}});
		event.preventDefault();
	});
});