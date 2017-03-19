jQuery(document).ready(function($) {
	$("input[id^='sh_register_society_duplicate_role']").click(function(event) {
		var row = $(event.currentTarget).parent().parent();
		var cell = row.children('td').eq(1);
		var input = cell.children('input').eq(0);
		var newInput = input.clone();
		newInput.attr('name', input.attr('name').replace('0', cell.children().length));
		cell.append('<br>');
		cell.append(newInput);
		
		event.preventDefault();
	});
	
	$("#sh_register_society_committee_new_role_button").click(function(event) {
		var role = $("#sh_register_society_committee_new_role").val();
		if (role != '') {
			var row = $('<tr></tr>');
			row.append('<td></td>');
			$("sh_register_society_committee_table")
		}
		event.preventDefault();
	});

});