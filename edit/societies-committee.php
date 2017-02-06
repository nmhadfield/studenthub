<form id='sh-register-society' method='post' action='<?php echo admin_url( 'admin-post.php', 'relative' ); ?>' name='sh_register_society'>
	<input type="hidden" name='action' value='studenthub_edit_committee'/>
	<input type='hidden' name='post_id' value='<?php echo(get_the_ID()); ?>'/>
	<div class='fieldset'>
	<fieldset>
		<legend>Committee</legend>
		<?php 
			$committee = get_post_meta(get_the_ID(), 'sh_committee', true);
			$roles = $GLOBALS ['sh_societies_roles']; 
			if (is_array($committee)) {
				
			}
		?>
		<table id='sh_register_society_committee_table' class='sh-align-top'>
			<?php for ($i = 0; $i < count($roles); $i++) { ?>
			<tr>
				<?php $role = $roles[$i]; ?>
				<td><input name='sh_committee_member_role[<?php echo($i); ?>]' value='<?php echo($role); ?>' readonly></input></td>
				<td>
					<?php $members = is_array($committee) && array_key_exists($role, $committee) ? $committee[$role] : array(''); ?>
					<?php for ($j = 0; $j < count($members); $j++) { ?>
						<input value='<?php echo($members[$j]) ?>' name='sh_register_society_committee_member[<?php echo($i); ?>][<?php echo($j); ?>]'></input>
					<?php } ?>
				</td>
				<td><input id='sh_register_society_duplicate_role[<?php echo($role); ?>]' type='button' class='sh-button-plain' value='Add another <?php echo($role); ?>'></input></td>
			</tr>
			<?php } ?>
		</table>
		<p>
		<label>Add another post to the committee:</label>
		<input id='sh_register_society_committee_new_role'></input>
		<input type='button' id='sh_register_society_committee_new_role_button' value='Add' class='sh-button-plain'></input>
		</p>
	</fieldset>
	</div>
	<p class='buttons'>
		<button type='submit' id='sh_register_society_submit' class='submit'>Save</button>
	</p>
</form>
