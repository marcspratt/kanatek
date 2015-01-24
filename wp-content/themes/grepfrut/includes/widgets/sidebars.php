<?php
/**
 * Registers widget areas.
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 *
 */
if ( ! function_exists('tcsn_widgets_init') ) {

// Register Sidebar
function tcsn_widgets_init()  {
	
	// Blog Widgets
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'tcsn_theme' ),
		'id'            => 'widgets-blog',
		'description'   => __( 'This area will be shown as a post sidebar. Widgets will be stacked in this column.', 'tcsn_theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	// Page Widgets
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'tcsn_theme' ),
		'id'            => 'widgets-page',
		'description'   => __( 'This area will be shown as a page sidebar. Widgets will be stacked in this column.', 'tcsn_theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	// Header social icons
	register_sidebar(array(
		'name'          => __('Header Social Icons Widget Area', 'tcsn_theme'),
		'id'            => 'widget-header-social',
		'description'   => __('Area for social icons in header.', 'tcsn_theme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	));
	
	// Twitter Feed Widget
	register_sidebar(array(
		'name'          => __('Footer Twitter Feed Widget Area', 'tcsn_theme'),
		'id'            => 'widget-twitter-feed',
		'description'   => __('Area for twitter feed in footer', 'tcsn_theme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	));
	
	// Footer Social Icons
	register_sidebar(array(
		'name'          => __('Footer Social Icons Widget Area', 'tcsn_theme'),
		'id'            => 'widget-footer-social',
		'description'   => __('Area for Social Icons in footer. Alternatively, else like logo etc. can be placed via text widget.', 'tcsn_theme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	));
	
	//Footer Widgets (columns) - Dynamic
	global $smof_data;
	if(isset($smof_data['tcsn_columns_footer'])) {
		$footer_columns = $smof_data['tcsn_columns_footer'];
		for ($i=1; $i<=$footer_columns; $i++)
		{
			register_sidebar(array(
			'name' => 'Footer - column - '.$i,
			'description'   => __( 'This area is a dynamically generated footer widget column. Widgets will be stacked in here.', 'tcsn_theme' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
			));
		}
	}
	
}
// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'tcsn_widgets_init' );
}