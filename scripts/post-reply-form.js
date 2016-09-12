jQuery(document).ready(function($) {
    prepCommentsForm();
});

function prepCommentsForm() {
    jQuery("form[id^='new-reply']").submit(function(event) {
    	var context = {postId: jQuery("#bbp_topic_id").val()};
    	jQuery(this).ajaxSubmit({success: refreshComments.bind(context)});
        return false;
    });	
}