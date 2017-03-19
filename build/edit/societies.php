<form id='sh-register-society' method='post' action='<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>' name='sh_register_society'>
	<input type="hidden" name='action' value='studenthub_register_society'/>
	<div class='fieldset'>
	<fieldset>
		<legend>Society Details</legend>
		<p>
			<label class='field' for='sh_register_society_name'>Name</label><input name='sh_register_society_name' required></input>
		</p>
		<p>
			<label class='field' for='sh_register_society_desc'>Description</label>
			<textarea name='sh_register_society_desc' required></textarea>
		</p>
		<p>
			<label class='field' for='sh_register_society_email'>Email</label><input name='sh_register_society_email'></input>
		</p>
		<p>
			<label class='field' for='sh_register_society_fb'>Facebook</label><input name='sh_register_society_fb'></input>
		</p>
		<p>
			<label class='field' for='sh_register_society_twitter'>Twitter</label><input name='sh_register_society_twitter'></input>
		</p>
	</fieldset>
	</div>

	<p class='buttons'>
		<button type='submit' id='sh_register_society_submit' class='submit'>Save</button>
	</p>
</form>
