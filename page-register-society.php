<?php
	get_header(); 
?>			
<div id="page-<?php the_ID(); ?>">

	<div class="row">
		<div class="menu">
			<?php wp_nav_menu(array('menu' => 'studyzone-submenu')); ?>
		</div>
		<div class="content">

			<div class="columns five">
				<?php dynamic_sidebar('page-'.get_the_ID().'-sidebar'); ?> 
			</div>
			
			<div class="columns eleven">
				<form id='sh-register-society' method='post' action='<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>' name='sh_register_society'>
					<fieldset>
						<input type="hidden" name='action' value='studenthub_register_society'/>
					</fieldset>
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
						
						<p>
							<label class='field' for='sh_register_society_role'>What is your role in the society?</label>
							<select id='sh_register_society_role' name='sh_register_society_role'>
								<option value='President'>President</option>
								<option value='Co-President'>Co-President</option>
								<option value='Vice President'>Vice President</option>
								<option value='Secretary'>Secretary</option>
								<option value='Treasurer'>Treasurer</option>
								<option value='1st Year Rep'>1st Year Re</option>
								<option value='2nd Year Rep'>2nd Year Rep</option>
								<option value='3rd Year Rep'>3rd Year Rep</option>
								<option value='4th Year Rep'>4th Year Rep</option>
								<option value='5th Year Rep'>5th Year Rep</option>
								<option value='BMSc Rep'>BMSc Rep</option>
								<option value='General Member'>General Member</option>
								<option value='Events Co-ordinator'>Events Co-ordinator</option>
							</select>
						</p>
					</fieldset>
					</div>
					<div class='fieldset'>
					<!-- fieldset>
						<legend>Committee</legend>
						<table id='sh_register_society_committee_table'>
							<tbody>
							</tbody>
						</table>
						<p>
							<label>Email</label>
							<input id='sh_register_society_email' name='sh_register_society_email'></input>
							<input id='sh_register_society_add_committee_member' type='button' value='Add'></input>
					</fieldset-->
					</div>
					<p class='buttons'>
						<button type='submit' id='sh_register_society_submit' class='submit'>Register</button>
					</p>
				</form>
			</div>
		</div>
	</div>
</div>