<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}

		//Background Images Reader for header and footer
		$bg_images_path = get_template_directory() . '/img/patterns/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri() .'/img/patterns/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); //Sorts the array into a natural order
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		
		//Background Images Reader for page header and body
		$body_bg_images_path = get_template_directory() . '/img/patterns/pat-body/'; // change this to where you store your bg images
		$body_bg_images_url = get_template_directory_uri() .'/img/patterns/pat-body/'; // change this to where you store your bg images
		$body_bg_images = array();
		
		if ( is_dir($body_bg_images_path) ) {
		    if ($body_bg_images_dir = opendir($body_bg_images_path) ) { 
		        while ( ($body_bg_images_file = readdir($body_bg_images_dir)) !== false ) {
		            if(stristr($body_bg_images_file, ".png") !== false || stristr($body_bg_images_file, ".jpg") !== false) {
		            	natsort($body_bg_images); //Sorts the array into a natural order
		                $body_bg_images[] = $body_bg_images_url . $body_bg_images_file;
		            }
		        }    
		    }
		}
		
		//Background Images Reader for slider
		$slider_bg_images_path = get_template_directory() . '/img/slider-bg/'; // change this to where you store your slider bg images
		$slider_bg_images_url = get_template_directory_uri() .'/img/slider-bg/'; // change this to where you store your slider bg images
		$slider_bg_images = array();
		
		if ( is_dir($slider_bg_images_path) ) {
		    if ($slider_bg_images_dir = opendir($slider_bg_images_path) ) { 
		        while ( ($slider_bg_images_file = readdir($slider_bg_images_dir)) !== false ) {
		            if(stristr($slider_bg_images_file, ".png") !== false || stristr($slider_bg_images_file, ".jpg") !== false) {
		            	natsort($slider_bg_images); //Sorts the array into a natural order
		                $slider_bg_images[] = $slider_bg_images_url . $slider_bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 
		
/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Prefix
$prefix = "tcsn_";
	
// Set the Options Array
global $of_options;
$of_options = array();

/**
 * General Options
 *
 */
$of_options[] = array( 
	"name" => "General",
	"type" => "heading",
	);
				
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Favicon / Touch Icons",
	"type" => "info",
	);

$of_options[] = array( 	
	"name" => "Favicon",
	"desc" => __( "Upload Favicon ( 16px x 16px ico/png/jpg ).", "tcsn_theme" ),
	"id"   => $prefix . "favicon",
	"std"  => "",
	"type" => "upload",
	);

$of_options[] = array( 
	"name" => "Standard iPhone Touch Icon",
	"desc" => __( "Upload Icon ( 57px x 57px png ).", "tcsn_theme" ),
	"id"   => $prefix . "favicon_iphone",
	"std"  => "",
	"type" => "upload",
	);

$of_options[] = array( 
	"name" => "Retina iPhone Touch Icon",
	"desc" => __( "Upload Icon ( 114px x 114px png ).", "tcsn_theme" ),
	"id"   => $prefix . "favicon_iphone_retina",
	"std"  => "",
	"type" => "upload",
	);
	
$of_options[] = array( 
	"name" => "Standard iPad Touch Icon",
	"desc" => __( "Upload Icon ( 72px x 72px png ).", "tcsn_theme" ),
	"id"   => $prefix . "favicon_ipad",
	"std"  => "",
	"type" => "upload",
	);

$of_options[] = array( 
	"name" => "Retina iPad Touch Icon",
	"desc" => __( "Upload Icon ( 144px x 144px png ).", "tcsn_theme" ),
	"id"   => $prefix . "favicon_ipad_retina",
	"std"  => "",
	"type" => "upload",
	);

$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Responsive",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name" => "",
	"desc" => __( "Check to enable responsiveness.", "tcsn_theme" ),
	"id"   => $prefix . "layout_responsive",
	"std"  => 1,
	"type" => "checkbox",
	); 

$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Tracking Code",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name" => "",
	"desc" => __( "Paste Google Analytics (or other) tracking code here. This will be added into the footer of theme.", "tcsn_theme" ),
	"id" => $prefix . "tracking",
	"std" => "",
	"type" => "textarea"
	); 

$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Comments on Pages (other than posts)",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name" => "",
	"desc" => __( "Check to enable comments on pages.", "tcsn_theme" ),
	"id"   => $prefix . "page_comments",
	"std"  => 0,
	"type" => "checkbox",
	); 

$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Icon for Title",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name" => "Icon for Archives Title",
	"desc" => __( "Check to enable icon for Archives title.", "tcsn_theme" ),
	"id"   => $prefix . "show_archives_icon",
	"std"  => 1,
	"type" => "checkbox",
	); 

$of_options[] = array( 
	"name" => "Icon for Blog Title",
	"desc" => __( "Check to enable icon for blog title.", "tcsn_theme" ),
	"id"   => $prefix . "show_blog_icon",
	"std"  => 1,
	"type" => "checkbox",
	); 

$of_options[] = array( 
	"name" => "Icon for Portfolio Title",
	"desc" => __( "Check to enable icon for portfolio page title and porfolio details page title", "tcsn_theme" ),
	"id"   => $prefix . "show_portfolio_icon",
	"std"  => 1,
	"type" => "checkbox",
	);
	
/**
 * Typography and Styling options
 *
 */
$of_options[] = array( 
	"name" => "Typography and Styling",
	"type" => "heading",
	);

// Color scheme
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Predefined Color Schemes",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name"    => "",
	"desc" => __( "Select color skin.", "tcsn_theme" ),
	"id"      => $prefix . "color_scheme",
	"std"     => "yellow",
	"type"    => "select",
	"options" => array( 
		'cyan'   => 'Cyan', 
		'green'  => 'Green',  
		'orange' => 'Orange', 
		'purple' => 'Purple', 	
		'red'    => 'Red', 
		'yellow' => 'Yellow',   
		),
	);

// Body typography
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Body Typography",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name" => "",
	"desc" => __( "Set body text. <br/>  ( Defaults: 14px, Raleway, normal, #767676 )", "tcsn_theme" ),
	"id"   => $prefix . "font_body",
	"std"  => array( 
		'size'  => '14px', 
		'face'  => 'Raleway', 
		'style' => 'normal', 
		'color' => '#767676',
		),
	"type" => "typography",
	);
	
// Headings typography
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Headings",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name" => "H1",
	"desc" => __( "Set H1. <br/>  ( Defaults: 36px, Raleway, normal, #646464 )", "tcsn_theme" ),
	"id"   => $prefix . "font_h1",
	"std"  => array( 
		'size'  => '36px', 
		'face'  => 'Raleway', 
		'style' => 'normal', 
		'color' => '#646464',
		),
	"type" => "typography",
	);

$of_options[] = array( 
	"name" => "H2",
	"desc" => __( "Set H2. <br/>  ( Defaults: 24px, Raleway, bold, #646464 )", "tcsn_theme" ),
	"id"   => $prefix . "font_h2",
	"std"  => array( 
		'size'  => '24px', 
		'face'  => 'Raleway', 
		'style' => 'bold', 
		'color' => '#646464',
		),
	"type" => "typography",
	);
	
$of_options[] = array( 
	"name" => "H3",
	"desc" => __( "Set H3. <br/>  ( Defaults: 20px, Raleway, bold, #646464 )", "tcsn_theme" ),
	"id"   => $prefix . "font_h3",
	"std"  => array( 
	'size'  => '20px', 
		'face'  => 'Raleway', 
		'style' => 'bold', 
		'color' => '#646464',
		),
	"type" => "typography",
);
	
$of_options[] = array( 
	"name" => "H4",
	"desc" => __( "Set H4. <br/>  ( Defaults: 18px, Raleway, bold, #646464 )", "tcsn_theme" ),
	"id"   => $prefix . "font_h4",
	"std"  => array( 
		'size'  => '18px', 
		'face'  => 'Raleway', 
		'style' => 'bold', 
		'color' => '#646464',
		),
	"type" => "typography",
);
	
$of_options[] = array( 
	"name" => "H5",
	"desc" => __( "Set H5. <br/>  ( Defaults: 14px, Raleway, bold, #646464 )", "tcsn_theme" ),
	"id"   => $prefix . "font_h5",
	"std"  => array( 
		'size'  => '14px', 
		'face'  => 'Raleway', 
		'style' => 'bold', 
		'color' => '#646464',
		),
	"type" => "typography",
);
	
$of_options[] = array( 
	"name" => "H6",
	"desc" => __( "Set H6. <br/>  ( Defaults: 12px, Raleway, bold, #646464 )", "tcsn_theme" ),
	"id"   => $prefix . "font_h6",
	"std"  => array( 
		'size'  => '12px', 
		'face'  => 'Raleway', 
		'style' => 'bold', 
		'color' => '#646464',
		),
	"type" => "typography",
);

// Page header typography
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Page Header Typography",
	"type" => "info",
	);

$of_options[] = array( 
	"name" => "Page Title / Heading",
	"desc" => __( "Set heading / page title. <br/> ( Defaults: 18px, Raleway, bold, #727272 ).", "tcsn_theme" ),
	"id"   =>  $prefix . "font_title",
	"std"  => array(
		'size'  => '18px',
		'face'  => 'Raleway',
		'style' => 'bold',
		'color' => '#727272',
		),
	"type" => "typography",
	);
			
$of_options[] = array( 
	"name" => "Page Header / Breadcrumb",
	"desc" => __( "Set page header text. <br/> ( Defaults: 12px, Raleway, normal, #727272 ). Will work for breadcrumb text.", "tcsn_theme" ),
	"id"   =>  $prefix . "font_header_btm",
	"std"  => array(
		'size'  => '12px',
		'face'  => 'Raleway',
		'style' => 'normal',
		'color' => '#727272',
		),
	"type" => "typography",
	);

$of_options[] = array( 	
	"name" => "Link Color",
	"desc" => __( "Page header link color.", "tcsn_theme" ),
	"id"   => $prefix . "link_color_header_btm",
	"std"  => "#727272",
	"type" => "color",
	);

$of_options[] = array( 	
	"name" => "Link Hover Color",
	"desc" => __( "Page header link hover color.", "tcsn_theme" ),
	"id"   => $prefix . "link_hover_header_btm",
	"std"  => "#d9b444",
	"type" => "color",
	);
	
// Footer typography
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Footer Typography",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name" => "",
	"desc" => __( "Set footer text. <br/> ( Defaults : 14px, Raleway, normal, #767676 )", "tcsn_theme" ),
	"id"   => $prefix . "font_footer",
	"std"  => array( 
		'size'  => '14px', 
		'face'  => 'Raleway', 
		'style' => 'normal', 
		'color' => '#767676', 
		),
	"type" => "typography",
	);

$of_options[] = array( 	
	"name" => "Headings Color",
	"desc" => __( "Color of headings in footer (h1 to h6).", "tcsn_theme" ),
	"id"   => $prefix . "color_footer_headings",
	"std"  => "#646464",
	"type" => "color",
	);

$of_options[] = array( 	
	"name" => "Links Color",
	"desc" => __( "Color of links in footer.", "tcsn_theme" ),
	"id"   => $prefix . "color_footer_link",
	"std"  => "#d9b444",
	"type" => "color",
	);

$of_options[] = array( 	
	"name" => "Links Color",
	"desc" => __( "Link hover color.", "tcsn_theme" ),
	"id"   => $prefix . "color_footer_link_hover",
	"std"  => "#767676",
	"type" => "color",
	);

// Copyright typography
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Copyright Typography",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name" => "",
	"desc" => __( "Set copyright text. <br/> ( Defaults : 11px, Raleway, normal, #242424 )", "tcsn_theme" ),
	"id"   =>  $prefix . "font_copyright",
	"std"  => array(
		'size'  => '11px',
		'face'  => 'Raleway',
		'style' => 'normal',
		'color' => '#242424',
		),
	"type" => "typography",
	);
	
$of_options[] = array( 	
	"name" => "Link Color",
	"desc" => __( "Link color.", "tcsn_theme" ),
	"id"   => $prefix . "link_color_copyright",
	"std"  => "#242424",
	"type" => "color",
	);

$of_options[] = array( 	
	"name" => "Link Hover Color",
	"desc" => __( "Link hover color.", "tcsn_theme" ),
	"id"   => $prefix . "link_hover_copyright",
	"std"  => "#fff",
	"type" => "color",
	);

// General typography and Styling
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "General Typography and Styling",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name" => "Link Color",
	"desc" => "",
	"id"   => $prefix . "link_color",
	"std"  => "#d9b444",
	"type" => "color",
	);

$of_options[] = array( 
	"name" => "Link Hover Color",
	"desc" => "",
	"id"   => $prefix . "link_hover_color",
	"std"  => "#767676",
	"type" => "color",
	);

$of_options[] = array( 
	"name" => "Text highlight color",
	"desc" => "Colored text",
	"id"   => $prefix . "text_color",
	"std"  => "#d9b444",
	"type" => "color",
	);
	
$of_options[] = array( 
	"name" => "Icon Background Color",
	"desc" => "",
	"id"   => $prefix . "icon_bg",
	"std"  => "#d9b444",
	"type" => "color",
	);

$of_options[] = array( 
	"name" => "Blockquote Border and Text Color",
	"desc" => "Blockquote border and text color",
	"id"   => $prefix . "blockquote_color",
	"std"  => "#d9b444",
	"type" => "color",
	);

$of_options[] = array( 
	"name" => "Tag Background Color",
	"desc" => "Tag background color",
	"id"   => $prefix . "tag_bg_color",
	"std"  => "#d9b444",
	"type" => "color",
	);

$of_options[] = array( 
	"name" => "Pricing table",
	"desc" => "Price and focused table slug color",
	"id"   => $prefix . "pricing_color",
	"std"  => "#d9b444",
	"type" => "color",
	);
	
$of_options[] = array( 
	"name" => "Text Shadow",
	"desc" => __( "Check to enable text shadow", "tcsn_theme" ),
	"id"   => $prefix . "show_text_shadow",
	"std"  => 1,
	"type" => "checkbox",
	); 
	
$of_options[] = array( 
	"name" => "Button",
	"desc" => __( "Set button font family.", "tcsn_theme" ),
	"id"   =>  $prefix . "font_button",
	"std"  => array(
		'face'  => 'Raleway',
		'style' => 'normal', 
		),
	"type" => "typography",
	);
						
/**
 * Body Options
 *
 */
$of_options[] = array( 
	"name" => "Body",
	"type" => "heading",
	);

$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Body Background",
	"type" => "info",
	);
					
$of_options[] = array( 
	"name" => "Background Color",
	"desc" => __( "Body background color.", "tcsn_theme" ),
	"id"   => $prefix . "bg_color_body",
	"std"  => "#f2f2f2",
	"type" => "color",
	);

$of_options[] = array( 
	"name" => "Background Image",
	"desc" => __( "Check to enable background pattern.", "tcsn_theme" ),
	"id"   => $prefix . "show_pattern_body",
	"std"  => 0,
	"type" => "checkbox",
	); 
		
$of_options[] = array( 	
	"name"    => "",
	"desc" => __( "Select a background pattern. <br> To add more patterns just upload your pattern here : Theme folder > img > patterns > pat-body", "tcsn_theme" ),
	"id"      => $prefix . "pattern_body",
	"std" 	  => "",
	"type" 	  => "tiles",
	"options" => $body_bg_images,
	);
						
$of_options[] = array( 
	"name"    => "Background Repeat",
	"desc"    => "",
	"id"      => $prefix . "pattern_repeat_body",
	"std"     => "repeat",
	"type"    => "select",
	"options" => array(
		'repeat'    => 'repeat', 
		'repeat-x'  => 'repeat-x', 
		'repeat-y'  => 'repeat-y', 
		'no-repeat' => 'no-repeat',
		),
	);  
					
$of_options[] = array( 
	"name"    => "Background Attachment",			
	"desc"    => "",
	"id"      => $prefix . "attachment_body",
	"std"     => "scroll",
	"type"    => "select",
	"options" => array( 
		'scroll' => 'scroll', 
		'fixed'  => 'fixed', 
		),
	);  

/**
 * Header Options
 *
 */
$of_options[] = array( 
	"name" => "Header",
	"type" => "heading",
	);

// Header layout
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Select a Header Layout",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name"    => "",
	"desc"    => "",
	"id"      => $prefix. "layout_header",
	"std"     => "",
	"type"    => "images",
	"options" => array(
		"v1" => get_template_directory_uri() . "/includes/img/header1.jpg",
		"v2" => get_template_directory_uri() . "/includes/img/header2.jpg",
		"v3" => get_template_directory_uri() . "/includes/img/header3.jpg",
		),
	);

// Header Background
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Header Background",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name" => "Background Color",
	"desc" => __( "Background color.", "tcsn_theme" ),
	"id"   => $prefix . "bg_color_header",
	"std"  => "#000",
	"type" => "color",
	);

$of_options[] = array( 
	"name" => "Background Image",
	"desc" => __( "Check to enable background pattern.", "tcsn_theme" ),
	"id"   => $prefix . "show_pattern_header",
	"std"  => 1,
	"type" => "checkbox",
	); 
		
$of_options[] = array( 	
	"name"    => "",
	"desc" => __( "Select a background pattern. <br> To add more patterns just upload your pattern here : Theme folder > img > patterns", "tcsn_theme" ),
	"id"      => $prefix . "pattern_header",
	"std" 	  => $bg_images_url . "pat1.jpg",
	"type" 	  => "tiles",
	"options" => $bg_images,
	);
	
$of_options[] = array( 
	"name"    => "Background Repeat",
	"desc"    => "",
	"id"      => $prefix . "pattern_repeat_header",
	"std"     => "repeat",
	"type"    => "select",
	"options" => array( 
		'repeat'    => 'repeat', 
		'repeat-x'  => 'repeat-x', 
		'repeat-y'  => 'repeat-y', 
		'no-repeat' => 'no-repeat', 
		),
	); 		

// Top bar Background
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Top Bar Background",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name" => "Background Color",
	"desc" => __( "Background color.", "tcsn_theme" ),
	"id"   => $prefix . "bg_color_topbar",
	"std"  => "#0e0e0e",
	"type" => "color",
	);

// Logo
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Logo",
	"type" => "info",
	);
		
$of_options[] = array( 
	"name"    => "Select Logo Type",
	"desc"    => __( "If Image Logo : Upload logo image using field below. <br/><br/> If text logo : Provide text using field below.", "tcsn_theme" ),
	"id"      => $prefix . "logo_type",
	"std"     => $prefix . "show_text_logo",
	"type"    => "images",
	"options" => array(
		$prefix . "show_image_logo" => get_template_directory_uri() . "/includes/img/image-logo.png",
		$prefix . "show_text_logo"  => get_template_directory_uri() . "/includes/img/text-logo.png",
		),
	);
	
$of_options[] = array( 
	"name" => "For Image Logo",
	"desc" => __( "Upload logo.", "tcsn_theme" ),
	"id"   => $prefix . "image_logo",
	"std"  => "",
	"type" => "upload",
	);

$of_options[] = array( 
	"name" => "For Text Logo",
	"desc" => __( "Enter text for logo and set font.", "tcsn_theme" ),
	"id"   => $prefix . "text_logo",
	"std"  => "Mylogo",
	"type" => "text",
	);  

$of_options[] = array( 
	"name" => "",
	"desc" => __( "Set font. ( Defaults : 32px, Arial, normal, #d9b444 )", "tcsn_theme" ),
	"id"   => $prefix . "font_logo",
	"std"  => array( 
		'size'  => '32px', 
		'face'  => 'Arial', 
		'style' => 'normal', 
		'color' => '#d9b444',
		),
	"type" => "typography",
	);

$of_options[] = array( 
	"name" => "",
	"desc" => __( "<<----- Logo hover color. If text logo, it will change color on hover. <br/> Keep it same as logo text color or change as per liking.", "tcsn_theme" ),
	"id"   => $prefix . "hover_logo",
	"std"  => "#d9b444",
	"type" => "color",
	);

$of_options[] = array( 
	"name" => "Logo Top Margin",
	"desc" => __( "Logo top margin ( in 'px' ).", "tcsn_theme" ),
	"id"   => $prefix . "top_margin_logo",
	"std"  => "0px",
	"type" => "text",
	);  

// Social icons	
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Social Icons",
	"type" => "info",
	);
			
$of_options[] = array( 
	"name" => "",
	"desc" => __( "Check to enable widget area for <br/> 'Social Icons' in header. <br/><br/> Please visit the widgets settings page to configure 'Social Network' widget.", "tcsn_theme" ),
	"id"   => $prefix . "show_social_network",
	"std"  => 1,
	"type" => "checkbox",
	);

// Phone number	
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Phone Nunber",
	"type" => "info",
	);

$of_options[] = array( 
	"name" => "",
	"desc" => __( "Check to enable phone number.", "tcsn_theme" ),
	"id"   => $prefix . "show_phone_number",
	"std"  => 1,
	"type" => "checkbox",
	);
	
$of_options[] = array( 
	"name" => "",
	"desc" => __( "Enter phone number.", "tcsn_theme" ),
	"id"   => $prefix . "phone_number",
	"std"  => "+(99) 123 345 5678",
	"type" => "text",
	);  

$of_options[] = array( 
	"name" => "",
	"desc" => __( "Set font. ( Defaults : 14px, Raleway, bold, #727272 )", "tcsn_theme" ),
	"id"   => $prefix . "font_phone",
	"std"  => array( 
		'size'  => '14px',
		'face'  => 'Raleway',
		'style' => 'bold',
		'color' => '#727272', 
		),
	"type" => "typography",
	);

// Tagline 
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Top bar / Tagline",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name" => "",
	"desc" => __( "Check to enable tagline in topbar.", "tcsn_theme" ),
	"id"   => $prefix . "show_tagline",
	"std"  => 1,
	"type" => "checkbox",
	);

$of_options[] = array( 
	"name" => "",
	"desc" => __( "Enter tagline.", "tcsn_theme" ),
	"id"   => $prefix . "tagline",
	"std"  => "This is a tagline",
	"type" => "text",
	); 

$of_options[] = array( 
	"name" => "",
	"desc" => __( "Set font. ( Defaults : 14px, Raleway, bold, #727272 )", "tcsn_theme" ),
	"id"   => $prefix . "font_tagline",
	"std"  => array( 
		'size'  => '14px',
		'face'  => 'Raleway',
		'style' => 'bold',
		'color' => '#727272', 
		),
	"type" => "typography",
	);

// Menu 
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Menu / Navigation",
	"type" => "info",
	);

$of_options[] = array( 
	"name" => "",
	"desc" => __("Set font. ( Defaults: 12px, Raleway, bold, #a7a7a7 )", "tcsn_theme"),
	"id"   => $prefix . "font_menu",
	"std"  => array( 
		'size'  => '12px',
		'face'  => 'Raleway',
		'style' => 'bold',
		'color' => '#a7a7a7', 
		),
	"type" => "typography",
	);


$of_options[] = array( 
	"name" => "Menu : Link Hover Background Color",
	"desc" => __("Hover background color.", "tcsn_theme"),
	"id"   => $prefix . "bg_color_hover_menu",
	"std"  => "#484848",
	"type" => "color",
	);

$of_options[] = array( 
	"name" => "Dropdown : Background Color",
	"desc" => __("Dropdown background color.", "tcsn_theme"),
	"id"   => $prefix . "bg_color_dropdown_menu",
	"std"  => "#484848",
	"type" => "color",
	);
		
$of_options[] = array( 
	"name" => "Dropdown : Link Hover Color",
	"desc" => __("Dropdown link hover color.", "tcsn_theme"),
	"id"   => $prefix . "link_hover_dropdown",
	"std"  => "#fff",
	"type" => "color",
	);	

$of_options[] = array( 
	"name" => "Colored Link in Menu",
	"desc" => __("Colored link in menu", "tcsn_theme"),
	"id"   => $prefix . "menu_link_color",
	"std"  => "#d9b444",
	"type" => "color",
	);	

/**
 * Page Header Options
 *
 */
$of_options[] = array( 
	"name" => "Page Header",
	"type" => "heading",
	);

$of_options[] = array( 
	"name" => "Page Header On / Off",
	"desc" => __( "Check to enable page header", "tcsn_theme" ),
	"id"   => $prefix . "show_page_header",
	"std"  => 1,
	"type" => "checkbox",
	); 
	
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Page Header Background",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name" =>  "Background Color",
	"desc" => __( "Background color.", "tcsn_theme" ),
	"id"   => $prefix . "bg_color_header_btm",
	"std"  => "#e3e3e3",
	"type" => "color",
	);

$of_options[] = array( 
	"name" => "Background Image",
	"desc" => __( "Check to enable background pattern.", "tcsn_theme" ),
	"id"   => $prefix . "show_pattern_header_btm",
	"std"  => 0,
	"type" => "checkbox",
	); 
		
$of_options[] = array( 	
	"name"    => "",
	"desc" => __( "Select a background pattern. <br> To add more patterns just upload your pattern here : Theme folder > img > patterns > pat-body", "tcsn_theme" ),
	"id"      => $prefix . "pattern_header_btm",
	"std" 	  => "",
	"type" 	  => "tiles",
	"options" => $body_bg_images,
	);
	
$of_options[] = array( 
	"name"    => "Background Repeat",
	"desc"    => "",
	"id"      => $prefix . "pattern_repeat_header_btm",
	"std"     => "repeat",
	"type"    => "select",
	"options" => array( 
		'repeat'    => 'repeat', 
		'repeat-x'  => 'repeat-x', 
		'repeat-y'  => 'repeat-y', 
		'no-repeat' => 'no-repeat', 
		),
	); 		

$of_options[] = array( 	
	"name" => "Border Bottom Color",
	"desc" => "Border bottom color.",
	"id"   => $prefix . "border_bottom_headerbtm",
	"std"  => "#fff",
	"type" => "color",
	);					

$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Breadcrumb or Search",
	"type" => "info",
	);

$of_options[] = array( 	
	"name" 		=> "",
	"desc" 		=> "",
	"id" 		=> $prefix . "show_breadcrumb_search",
	"std" 		=> "breadcrumb",
	"type" 		=> "radio",
	"options"   => array( 
		'breadcrumb' => 'Breadcrumb', 
		'search'     => 'Search', 
		'none'       => 'None', 
		),
	); 		
				
$of_options[] = array( 	
	"name" => "Breadcrumb Active link color",
	"desc" => "Breadcrumb active link color.",
	"id"   => $prefix . "color_active_breadcrumb",
	"std"  => "#999",
	"type" => "color",
	);
	
$of_options[] = array( 
	"name" => "Breadcrumb Top Margin",
	"desc" => __("Breadcrumb top margin ( in 'px' ).", "tcsn_theme"),
	"id"   => $prefix . "top_margin_breadcrumb",
	"std"  => "0px",
	"type" => "text",
	); 


/**
 * Slider Options
 *
 */		
$of_options[] = array( 
	"name" => "Slider",
	"type" => "heading",
	);	

$of_options[] = array( 
	"name" => "Background Image",
	"desc" => __( "Check to enable background pattern.", "tcsn_theme" ),
	"id"   => $prefix . "show_pattern_slider_bg",
	"std"  => 1,
	"type" => "checkbox",
	); 

$of_options[] = array( 	
	"name"    => "Slider Background Image",
	"desc" => __( "Select a background image for slider.  <br> To add your custom image upload your background image here : Theme folder > img > slider-bg", "tcsn_theme" ),
	"id"      => $prefix . "pattern_slider_bg",
	"std" 	  => $slider_bg_images_url . "slider-background1.jpg",
	"type" 	  => "tiles",
	"options" => $slider_bg_images,
	);

$of_options[] = array( 	
	"name" => "Slider Background Color",
	"desc" => "Slider background color.",
	"id"   => $prefix . "color_slider_bg",
	"std"  => "",
	"type" => "color",
	);	
	
/**
 * Footer Options
 *
 */		
$of_options[] = array( 
	"name" => "Footer",
	"type" => "heading",
	);

$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Number of Footer Columns",
	"type" => "info",
	);
	
$of_options[] = array(
	"name"    => "",
	"desc"    => __( "Select number of columns.", "tcsn_theme" ),
	"id"      => $prefix . "columns_footer",
	"std"     => "3",
	"type"    => "images",
	"options" => array(
		"1" => get_template_directory_uri() . "/includes/img/col1.png",
		"2" => get_template_directory_uri() . "/includes/img/col2.png",
		"3" => get_template_directory_uri() . "/includes/img/col3.png",
		"4" => get_template_directory_uri() . "/includes/img/col4.png",
		),
	);

$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Footer Background",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name" =>  "Background Color",
	"desc" => __( "Background color.", "tcsn_theme" ),
	"id"   => $prefix . "bg_color_footer",
	"std"  => "#000",
	"type" => "color",
	);

$of_options[] = array( 
	"name" => "Background Image",
	"desc" => __( "Check to enable background pattern.", "tcsn_theme" ),
	"id"   => $prefix . "show_pattern_footer",
	"std"  => 1,
	"type" => "checkbox",
	); 
	
$of_options[] = array( 	
	"name"    => "",
	"desc"    => __( "Select a background pattern. <br> To add more patterns just upload your pattern here : Theme folder > img > patterns", "tcsn_theme" ),
	"id"      => $prefix . "pattern_footer",
	"std" 	  => $bg_images_url . "pat1.jpg",
	"type" 	  => "tiles",
	"options" => $bg_images,
	);

$of_options[] = array( 
	"name"    => "Background Repeat",
	"desc"    => "",
	"id"      => $prefix . "pattern_repeat_footer",
	"std" 	  => "repeat",
	"type"    => "select",
	"options" => array(
		'repeat'    => 'repeat', 
		'repeat-x'  => 'repeat-x', 
		'repeat-y'  => 'repeat-y', 
		'no-repeat' => 'no-repeat',
		),
	); 	
	
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Social Icons & Twitter Feed setup",
	"type" => "info",
	);
		
$of_options[] = array( 
	"name" => "",
	"desc" => __( "Check to enable row for Twiiter feed and Social icons above main footer columns.", "tcsn_theme" ),
	"id"   => $prefix . "show_social_row",
	"std"  => 1,
	"type" => "checkbox",
	); 

$of_options[] = array( 
	"name" => "Background Color for Twitter Box",
	"desc" => __( "Background color.", "tcsn_theme" ),
	"id"   => $prefix . "bg_color_twitter_box",
	"std"  => "#282828",
	"type" => "color",
	);

$of_options[] = array( 
	"name" => "Border Color for Twitter Box",
	"desc" => __( "Border color.", "tcsn_theme" ),
	"id"   => $prefix . "border_color_twitter_box",
	"std"  => "#161616",
	"type" => "color",
	);

$of_options[] = array( 
	"name" => "Twitter Feed",
	"desc" => __( "<----- Twitter username with link to the left side of twitter feed box. <br/><br/> Default : &lt;a href='#' target='_blank'&gt;Grepfrut&lt;/a&gt <br/><br/> Please visit the widgets settings page to configure 'Twitter Feed Widget'.", "tcsn_theme" ),
	"id"   => $prefix . "twitter_username",
	"std"  => "<a href='https://twitter.com/tanshcreative' target='_blank'>Grepfrut</a>",
	"type" => "textarea",
	); 

$of_options[] = array( 
	"name" => "Footer Social Icons",
	"desc" => __( "Check to enable widget area for 'Social Icons' in footer.  <br/><br/> If disabled, will display only twitter feed. <br/><br/> Please visit the widgets settings page to configure 'Social Network' widget for footer.", "tcsn_theme" ),
	"id"   => $prefix . "show_footer_social",
	"std"  => 1,
	"type" => "checkbox",
	); 

/**
 * Copyright Options
 *
 */	
$of_options[] = array( 
	"name" => "Copyright",
	"type" => "heading",
	);
	
$of_options[] = array( 
	"name" => "Copyright Text",
	"desc" => __( "Enter copyright text (HTML allowed)", "tcsn_theme" ),
	"id"   => $prefix . "copyright",
	"std"  => "&copy; Copyright 2013",
	"type" => "textarea",
	); 
	
$of_options[] = array( 
	"name" => "Check to Enable Menu in Copyright",
	"desc" => __( "Enable secondary menu in copyright", "tcsn_theme" ),
	"id"   => $prefix . "show_secondary_menu",
	"std"  => 1,
	"type" => "checkbox",
	);
	
$of_options[] = array( 
	"name" => "",
	"desc" => "",
	"id"   => "info_heading",
	"std"  => "Copyright Background",
	"type" => "info",
	);
	
$of_options[] = array( 
	"name" => "Background Color",
	"desc" => __( "Background color.", "tcsn_theme" ),
	"id"   => $prefix . "bg_color_copyright",
	"std"  => "#484848",
	"type" => "color",
	);
	
$of_options[] = array( 	
	"name" => "Border Top Color",
	"desc" => __( "Border top color.", "tcsn_theme" ),
	"id"   => $prefix . "border_top_copyright",
	"std"  => "#5b5c5d",
	"type" => "color",
	);

/**
 * Blog Options
 *
 */	
$of_options[] = array( 	
	"name" => "Blog",
	"type" => "heading",
);

$of_options[] = array(
	"name"    => "Blog Layout",
	"desc"    => __( "Select blog layout.", "tcsn_theme" ),
	"id"      => $prefix . "blog_layout",
	"std"     => "with-sidebar",
	"type"    => "select",
	"options" => array(
		'full-width'   => 'Full Width', 
		'with-sidebar' => 'With Sidebar',
		),
	);	

$of_options[] = array(
	"name"    => "Blog Sidebar Position",
	"desc"    => __( "Select blog sidebar position.", "tcsn_theme" ),
	"id"      => $prefix . "blog_sidebar",
	"std"     => "sidebar-right",
	"type"    => "select",
	"options" => array(
		'sidebar-left'  => 'Sidebar Left', 
		'sidebar-right' => 'Sidebar Right',
		),
	);	

$of_options[] = array( 
	"name" => "Blog Title",
	"desc" => __( "Blog page title.", "tcsn_theme" ),
	"id"   => $prefix . "blog_title",
	"std"  => "Blogpost",
	"type" => "text",
	); 

$of_options[] = array( 
	"name" => "",
	"desc" => __( "Check to enable social share box on single post.", "tcsn_theme" ),
	"id"   => $prefix . "post_social_share",
	"std"  => 1,
	"type" => "checkbox",
	); 

$of_options[] = array( 
	"name" => "",
	"desc" => __( "Check to enable facebook in social share box.", "tcsn_theme" ),
	"id"   => $prefix . "post_social_share_facebook",
	"std"  => 1,
	"type" => "checkbox",
	);

$of_options[] = array( 
	"name" => "",
	"desc" => __( "Check to enable twitter in social share box.", "tcsn_theme" ),
	"id"   => $prefix . "post_social_share_twitter",
	"std"  => 1,
	"type" => "checkbox",
	);
	
$of_options[] = array( 
	"name" => "",
	"desc" => __( "Check to enable googleplus in social share box.", "tcsn_theme" ),
	"id"   => $prefix . "post_social_share_googleplus",
	"std"  => 1,
	"type" => "checkbox",
	);
	
$of_options[] = array( 
	"name" => "",
	"desc" => __( "Check to enable linkedin in social share box.", "tcsn_theme" ),
	"id"   => $prefix . "post_social_share_linkedin",
	"std"  => 1,
	"type" => "checkbox",
	);
	
$of_options[] = array( 
	"name" => "",
	"desc" => __( "Check to enable pinterest in social share box.", "tcsn_theme" ),
	"id"   => $prefix . "post_social_share_pinterest",
	"std"  => 1,
	"type" => "checkbox",
	);
	
$of_options[] = array( 
	"name" => "",
	"desc" => __( "Check to enable mail in social share box.", "tcsn_theme" ),
	"id"   => $prefix . "post_social_share_mail",
	"std"  => 1,
	"type" => "checkbox",
	);

/**
 * Portfolio Options
 *
 */	
$of_options[] = array( 	
	"name" => "Portfolio",
	"type" => "heading",
);

$of_options[] = array( 
	"name" => "Portfolio items per page",
	"desc" => __( "Specify the number of portfolio items to display per page.", "tcsn_theme" ),
	"id"   => $prefix . "portfolio_items_per_page",
	"std"  => "9",
	"type" => "text",
	);
	
$of_options[] = array( 
	"name" => "Enable Portfolio Filter",
	"desc" => __( "Check to enable portfolio filter.", "tcsn_theme" ),
	"id"   => $prefix . "portfolio_filter",
	"std"  => 1,
	"type" => "checkbox",
); 
	
$of_options[] = array( 
	"name" => "Enable Heading to Portfolio Item",
	"desc" => __( "Check to enable heading of portfolio item.", "tcsn_theme" ),
	"id"   => $prefix . "portfolio_heading",
	"std"  => 1,
	"type" => "checkbox",
); 

$of_options[] = array( 
	"name" => "Enable Excerpt to Portfolio Item",
	"desc" => __( "Check to enable excerpt of portfolio item.", "tcsn_theme" ),
	"id"   => $prefix . "portfolio_excerpt",
	"std"  => 0,
	"type" => "checkbox",
); 

/**
 * Custom CSS
 *
 */	 
$of_options[] = array( 
	"name" => "Custom CSS",
	"type" => "heading",
);
					
$of_options[] = array( 
	"name" => "Custom CSS",
	"desc" => __( "Paste your CSS Code.", "tcsn_theme" ),
	"id"   => $prefix . "custom_css",
	"std"  => "",
	"type" => "textarea",
	); 

/**
 * Backup Options
 *
 */	 							
$of_options[] = array( 	
	"name" => "Backup Options",
	"type" => "heading",
);
				
$of_options[] = array( 	
	"name" => "Backup and Restore Options",
	"desc" => __( "You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.", "tcsn_theme" ),
	"id"   => "of_backup",
	"std"  => "",
	"type" => "backup",
	);
				
$of_options[] = array( 	
	"name" => "Transfer Theme Options Data",
	"desc" => __( "You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click \"Import Options\".", "tcsn_theme" ),
	"id"   => "of_transfer",
	"std"  => "",
	"type" => "transfer",
	);
				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
