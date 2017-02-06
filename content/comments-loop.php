<?php 
$tmp_post = $GLOBALS['post'];

$bbp_comments = bbp_parse_args('', array(
	'post_parent'		  => get_the_ID(),	
	'post_type'           => bbp_get_reply_post_type(),
	'posts_per_page'	  => -1,	
	'order'               => 'ASC'), 'has_topics' );
	
$commentsquery = new WP_Query( $bbp_comments );
?>
	
<div id="comments-<?php echo(get_the_ID());?>" class="comments">
	
	<?php while ($commentsquery->have_posts()) : $commentsquery->the_post();?>
	<div id="comment-<?php echo(get_the_ID())?>" class="comment">
		<?php 
			$userYear = get_post_meta(get_the_ID(), 'sh_user_group', true);
			$icon = new Category_Logo_Widget();
		?>
		<div class='left'><?php $icon -> widget(array('sh_user_group' => $userYear), array()); ?></div>
		<div class='middle'><?php the_content();  ?></div>
	</div>
	<?php endwhile; ?>
	 
	<div class='comment newcomment'> 
		<?php 
			$userYear = array_key_exists('mbchbYearOfStudyInLatestAcademicYear', $_COOKIE) ? $_COOKIE['mbchbYearOfStudyInLatestAcademicYear'] : null;
			$icon = new Category_Logo_Widget();
		?>
		<div class='left'><?php $icon -> widget(array('sh_user_group' => $userYear), array()); ?></div>
		<div class='middle'>
		<?php 
			$GLOBALS['post'] = $tmp_post;
			$form = new Post_Reply_Form_Widget();
			$form->output(array());
		?>
		</div>
	</div>
</div>
