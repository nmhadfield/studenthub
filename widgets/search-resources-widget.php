<?php 
class Search_Resources_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'search_resources_widget',
			'description' => 'Filters search output according to selected categories',
		);
		parent::__construct( 'search_resources_widget', 'Search Resources Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$html = '<div class="widget">';
		
		$html.= '<div class="article shadow blog-holder">';

		$html.= '<form id="sh-search-form">';
		$html.= 'Search';
		$html.= '<input id="sh-new-search-term" name="sh-new-search-term">';
		$html.= '<div id="sh-search-terms">';
		$html.= '</div>';
		$html.= '</div>';
		
		$html.= self::doSection('Systems ', 'systems');
		$html.= self::doSection('Clinical Blocks', 'clinical_blocks');
		$html.= self::doSection('Themes', 'themes');
		
		$html.= '</form>';

		$html.= '</div>';
		
		echo($html);
	}
	
	public function doSection($label, $group) {
		$html = '<div id="browse-'.$group.'" class="article shadow blog-holder browse-category">';
		$html.= '<h2>'.$label.'</h2>';
		$html.='<ul class="browse">';
		
		$categories = get_terms('category', array('hide_empty' => false, 'parent' => $GLOBALS[$group]));
		foreach ($categories as $cat) {
			if ($cat->count >0) {
				$html.= '<li>';
				$html.= '<a href="#" onclick="filterResources(event, \''.($cat->name).'\')">'.($cat->name).'</a>';
				//$html.= '<span>';
				//$html.= $cat->count;
				//$html.= '</span>';
				$html.= '</li>';
			}
		}
		$html.='</ul>';
		$html.= '</div>';
		
		return $html;
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}
?>