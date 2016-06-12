<?php

/**
 * This template displays the drop-down selection for subject of a post.
 * @package Student Hub
 * @since Student Hub 1.0
 */
?>
<?php 
	$systems = get_terms('category', array('hide_empty' => false, 'parent' => $GLOBALS["systems"]));
	$blocks = get_terms('category', array('hide_empty' => false, 'parent' => $GLOBALS["clinical_blocks"]));
	$themes = get_terms('category', array('hide_empty' => false, 'parent' => $GLOBALS["themes"]));
?>
<label for="studenthub-subject-select">Subject(s)</label>
<select id="studenthub-subject-select" name="studenthub-subject-select[]" multiple="multiple">

	<optgroup label="Systems">
	<?php foreach ($systems as $option) { ?>
		<option value="<?php echo($option->name); ?>"><?php echo($option->name); ?></option>
	<?php } ?>
	</optgroup>
	
	<optgroup label="Themes">
	<?php foreach ($themes as $option) { ?>
		<option value="<?php echo($option->name); ?>"><?php echo($option->name); ?></option>
	<?php } ?>
	</optgroup>
	
	<optgroup label="Clinical Blocks">
	<?php foreach ($blocks as $option) { ?>
		<option value="<?php echo($option->name); ?>"><?php echo($option->name); ?></option>
	<?php } ?>
	</optgroup>

</select>