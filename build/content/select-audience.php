<?php

/**
 * This template displays the drop-down selection for subject of a post.
 * @package Student Hub
 * @since Student Hub 1.0
 */
?>
<?php 
	$sip = get_terms('audience', array('hide_empty' => false, 'parent' => "sip", 'fields' => 'all'));
	$pip = get_terms('audience', array('hide_empty' => false, 'parent' => $GLOBALS["pip"]));
	$other = get_terms('audience', array('hide_empty' => false, 'parent' => $GLOBALS["non-sip-pip"]));
?>
<label for="studenthub-subject-select">Audience</label>
<select id="studenthub-subject-select" name="studenthub-subject-select[]" multiple="multiple" class="required">

	<optgroup label="SIP">
	<?php foreach ($sip as $option) { ?>
		<option value="<?php echo($option->name); ?>"><?php echo($option->name); ?></option>
	<?php } ?>
	</optgroup>
	
	<optgroup label="PIP">
	<?php foreach ($pip as $option) { ?>
		<option value="<?php echo($option->name); ?>"><?php echo($option->name); ?></option>
	<?php } ?>
	</optgroup>
	
	<optgroup label="Other">
	<?php foreach ($other as $option) { ?>
		<option value="<?php echo($option->name); ?>"><?php echo($option->name); ?></option>
	<?php } ?>
	</optgroup>

</select>