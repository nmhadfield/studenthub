<?php
/**
 * Show the list of societies if we are on the archive page, or the details for the specific society otherwise.
 */

if (is_archive()) {
	the_widget('societies_widget', array(), array('post-id' => get_the_ID()));
}
else {
	the_widget('society_contact_widget', array(), array('post-id' => get_the_ID()));
	the_widget('committee_widget', array(), array('post-id' => get_the_ID()));
}
?>
