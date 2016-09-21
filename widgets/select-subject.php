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
	$locations = get_terms('category', array('hide_empty' => false, 'parent' => $GLOBALS["locations"]));
	$assessment = get_terms('category', array('hide_empty' => false, 'parent' => $GLOBALS["assessment"]));
	$yeargroups = get_descendant_categories($GLOBALS["year_groups"]);
	
function get_descendant_categories($parentId) {
	
	$result = array();
	$children = get_terms('category', array('hide_empty' => false, 'parent' => $parentId, 'orderby' => 'term_id'));
 
	foreach ($children as $child) {
		array_push($result, $child);
		$grandchildren = get_terms('category', array('hide_empty' => false, 'parent' => $child->term_id, 'orderby' => 'term_id'));
		foreach ($grandchildren as $grandchild) {
			array_push($result, $grandchild);
		}
	}
	return $result;
}
?>
<label for="studenthub-subject-select">Subject(s)</label>
<select id="studenthub-subject-select" name="studenthub-subject-select[]" multiple="multiple" class="required">

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
	
	<optgroup label="Locations">
	<?php foreach ($locations as $option) { ?>
		<option value="<?php echo($option->name); ?>"><?php echo($option->name); ?></option>
	<?php } ?>
	</optgroup>

	<optgroup label="Assessment">
	<?php foreach ($assessment as $option) { ?>
		<option value="<?php echo($option->name); ?>"><?php echo($option->name); ?></option>
	<?php } ?>
	</optgroup>
	
	<optgroup label="Year Groups">
	<?php foreach ($yeargroups as $option) { ?>
		<option value="<?php echo($option->name); ?>"><?php echo($option->name); ?></option>
	<?php } ?>
	</optgroup>
</select>