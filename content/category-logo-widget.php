<?php
class Category_Logo_Widget extends WP_Widget {
	
	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array (
				'classname' => 'category_logo_widget',
				'description' => 'Displays the logo for a category' 
		);
		parent::__construct ( 'category_logo_widget', 'Category Logo Widget', $widget_ops );
	}
	
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args        	
	 * @param array $instance        	
	 */
	public function widget($args, $instance) {
		if (array_key_exists ( 'category', $args )) {
			$category = $args ['category'];
			
			if ($category->parent) {
				$dir = get_category ( $category->parent )->slug;
				
				$filename = $category->slug . ".png";
				$file = '/images/icons/' . $dir . '/' . $filename;
				
				// note we need to look for the file on the file system, but obviously we need the uri for deployed server
				if (file_exists ( get_stylesheet_directory () . $file )) {
					include (locate_template ( array (
							'content/category-logo.php' 
					) ));
				}
			}
		}
		
		if (array_key_exists ( 'forum', $args )) {
			$file = sh_get_forum_icon ( $args ['forum'] );
			if ($file != null && file_exists ( get_stylesheet_directory () . $file )) {
				include (locate_template ('content/category-logo.php' ));
			}
		}
	}
}

function sh_get_forum_icon($forum_id) {
	$forum = get_post($forum_id, OBJECT);
	$filename = "forums/".$forum->post_name.".png";
	$file = '/images/icons/'.$filename;
	
	// note we need to look for the file on the file system, but obviously we need the uri for deployed server
	if (file_exists(get_stylesheet_directory().$file)) {
		return $file;
	}
	else if ($forum -> post_parent != 0) {
		return sh_get_forum_icon($forum -> post_parent);
	}
	return null;
}
?>