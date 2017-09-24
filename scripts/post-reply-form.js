jQuery(document).ready(function($) {
    prepCommentsForm();
});

function prepCommentsForm() {
	// not very elegant, but should work for now
	jQuery("form[id^='new-reply']").off("submit");
    jQuery("form[id^='new-reply']").submit(function(event) {
    	jQuery(event.currentTarget).closest('div.article').addClass("posting");
    	var id = jQuery(event.currentTarget).find("#bbp_topic_id");
    	var context = {postId: id.val()};
    	jQuery(this).ajaxSubmit({success: refreshComments.bind(context)});
        event.preventDefault();
    });	
}