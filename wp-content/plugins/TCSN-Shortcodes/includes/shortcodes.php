<?php
/*------------------------------------------------------------
 * Table of Contents
 *
 * 1.  Button
 * 2.  Icons
 * 3.  Lists
 * 4.  Text color
 * 5.  Dropcap
 * 6.  Highlight
 * 7.  Heading styles
 * 8.  Feature styles
 * 9.  Person
 * 10. Image with text on overlay
 * 11. Box
 * 12. Spacer / Gap
 * 13. Divider
 * 14. Block quote
 * 15. Tooltip
 * 16. Carousel
 * 17. Image with Lightbox
 * 18. Table
 * 19. Pricing Table
 * 
 *------------------------------------------------------------*/

/*------------------------------------------------------------
 * Remove extra P tags
 *
 *------------------------------------------------------------*/
add_filter("the_content", "tcsn_shortcode_format");
 
function tcsn_shortcode_format($content) {
 
// array of custom shortcodes requiring the fix
$block = join("|",array( "button","icon","font_icon","list","list_item","list_checkmark","list_arrow","list_ace","list_unstyled","list_heading","list_inline","list_separator","text_color","dropcap","highlight","glyphicon_heading","icon_font_heading","icon_heading","feature_big_icon","feature_big_glyphicon","feature_big_icon_font","feature_small_icon","feature_small_glyphicon","feature_small_icon_font","person","overlay_image","box","spacer","divider","blockquote","tooltip","carousel-wrapper","carousel-item","image-item","table","tbody","thead","tr","th","td","pricing","pricing_column","table_head","table_content","pricing_features","pricing_list_item" ) );
// opening tag
$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
// closing tag
$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
 
return $rep;
 
}

/*------------------------------------------------------------
 * add_shortcodes
 *
 * @since 1.0
 * 
 *------------------------------------------------------------*/
 function tcsn_register_shortcodes() {
	add_shortcode( 'button', 'tcsn_button_sc' );
	add_shortcode( 'icon', 'tcsn_icon_sc' );
	add_shortcode( 'font_icon', 'tcsn_font_icon_sc' );
	add_shortcode( 'list', 'tcsn_list_sc' );
	add_shortcode( 'list_item', 'tcsn_list_item_sc' );
	add_shortcode( 'list_checkmark', 'tcsn_checkmark_list_sc' );
	add_shortcode( 'list_arrow', 'tcsn_arrow_list_sc' );
	add_shortcode( 'list_ace', 'tcsn_ace_list_sc' );
	add_shortcode( 'list_unstyled', 'tcsn_unstyled_list_sc' );
	add_shortcode( 'list_heading', 'tcsn_heading_list_sc' );
	add_shortcode( 'list_inline', 'tcsn_inline_list_sc' );
	add_shortcode( 'list_separator', 'tcsn_separator_list_sc' );
	add_shortcode( 'text_color', 'tcsn_text_color_sc' );
	add_shortcode( 'dropcap', 'tcsn_dropcap_sc' );
	add_shortcode( 'highlight', 'tcsn_text_highlight_sc' );
	add_shortcode( 'glyphicon_heading', 'tcsn_glyphicon_heading_sc' );
	add_shortcode( 'icon_font_heading', 'tcsn_icon_font_heading_sc' );
	add_shortcode( 'icon_heading', 'tcsn_icon_heading_sc' );
	add_shortcode( 'feature_big_icon', 'tcsn_feature_big_icon_sc' );
	add_shortcode( 'feature_big_glyphicon', 'tcsn_feature_big_glyphicon_sc' );
	add_shortcode( 'feature_big_icon_font', 'tcsn_feature_big_icon_font_sc' );
	add_shortcode( 'feature_small_icon', 'tcsn_feature_small_icon_sc' );
	add_shortcode( 'feature_small_glyphicon', 'tcsn_feature_small_glyphicon_sc' );
	add_shortcode( 'feature_small_icon_font', 'tcsn_feature_small_icon_font_sc' );
	add_shortcode( 'person', 'tcsn_team_person_sc' );
	add_shortcode( 'overlay_image', 'tcsn_image_overlay_sc' );
	add_shortcode( 'box', 'tcsn_box_sc' );
	add_shortcode( 'spacer', 'tcsn_spacer_sc' );
	add_shortcode( 'divider', 'tcsn_divider_sc' );
	add_shortcode( 'blockquote', 'tcsn_blockquote_sc' );
	add_shortcode( 'tooltip', 'tcsn_tooltip_sc' );
	add_shortcode( 'carousel-wrapper', 'tcsn_carousel_wrapper_sc' );
	add_shortcode( 'carousel-item', 'tcsn_carousel_item_sc' );
    add_shortcode( 'image-item', 'tcsn_image_item_sc' );
	add_shortcode( 'table', 'tcsn_table_sc' );
	add_shortcode( 'tbody', 'tcsn_table_body_sc' );
	add_shortcode( 'thead', 'tcsn_table_head_sc' );
	add_shortcode( 'tr', 'tcsn_table_tr_sc' );
	add_shortcode( 'th', 'tcsn_table_th_sc' );
	add_shortcode( 'td', 'tcsn_table_td_sc' );
	add_shortcode( 'pricing', 'tcsn_pricing_sc' );
	add_shortcode( 'pricing_column', 'tcsn_pricing_column_sc' );
	add_shortcode( 'table_head', 'tcsn_pricing_thead_sc' );
	add_shortcode( 'table_content', 'tcsn_pricing_tcontent_sc' );
	add_shortcode( 'pricing_features', 'tcsn_pricing_list_sc' );
	add_shortcode( 'pricing_list_item', 'tcsn_pricing_list_item_sc' );
}
add_action('init', 'tcsn_register_shortcodes');

/*------------------------------------------------------------
 * 1. Button
 *
 * @since 1.0
 *
 * Example below:
 *
// [button class="" target="" url=""]Link text here[/button]
 * 
 *------------------------------------------------------------*/
function tcsn_button_sc( $atts, $content=null ) {
	extract ( shortcode_atts( array(
		'class'  => '', 
		'color'  => '',
		'target' => '', 
		'url'    => '', 
	), $atts ) );
	return '<a class="' . $class . $color . '" target="' . $target . '" href="' . $url . '">' . do_shortcode( $content ) . '</a>';
}

/*------------------------------------------------------------
 * 2. Icons
 *
 * @since 1.0
 *
 * Examples below:
 *
// [icon type="star" color="" size=""]
// [icon type="star" color="red" size="3em"]
// [icon type="star" color="#69F" size="20px"]
 *
 *------------------------------------------------------------*/
// glyphicons are for backward compatibiliy only
function tcsn_icon_sc( $atts, $content ) {
	extract( shortcode_atts( array(
		'type'  => 'star', 
        'color' => 'black', 
		'size' => '',
    ), $atts ) );
    return '<span class="glyphicon glyphicon-' . $type . '" style="color:' . $color . '; font-size: ' . $size . ';"></span>';
}

// font icons
function tcsn_font_icon_sc( $atts, $content ) {
	extract( shortcode_atts( array(
		'type'  => 'star', 
        'color' => 'black', 
		'size' => '',
    ), $atts ) );
    return '<span class="icon-' . $type . '" style="color:' . $color . '; font-size: ' . $size . ';"></span>';
}


/*------------------------------------------------------------
 * 3. Lists
 *
 * @since 1.0
 *
 * Examples below:
 *
// [list][list_item]List item one[/list_item][list_item]List item two[/list_item][/list]
// [list_checkmark][list_item]List item one[/list_item][list_item]List item two[/list_item][/list_checkmark]
// [list_arrow][list_item]List item one[/list_item][list_item]List item two[/list_item][/list_arrow]
// [list_ace][list_item]List item one[/list_item][list_item]List item two[/list_item][/list_ace]
// [list_unstyled][list_item]List item one[/list_item][list_item]List item two[/list_item][/list_unstyled]
// [list_heading][list_item]List item one[/list_item][list_item]List item two[/list_item][/list_heading]
// [list_inline][list_item]List item one[/list_item][list_item]List item two[/list_item][/list_inline]
 *
 *------------------------------------------------------------*/
// ul
function tcsn_list_sc( $atts, $content = null ) {
   return '<ul>' . do_shortcode( $content ) . '</ul>';
}
// li
function tcsn_list_item_sc( $atts, $content = null ) {
   return '<li>' . do_shortcode( $content ) . '</li>';
}

// Checkmark list
function tcsn_checkmark_list_sc( $atts, $content = null ) {
   return '<ul class="list-checkmark">' . do_shortcode( $content ) . '</ul>';
}

// Arrow list
function tcsn_arrow_list_sc( $atts, $content = null ) {
   return '<ul class="list-arrow">' . do_shortcode( $content ) . '</ul>';
}

// Ace list
function tcsn_ace_list_sc( $atts, $content = null ) {
   return '<ul class="list-ace">' . do_shortcode( $content ) . '</ul>';
}

// Unstyled list
function tcsn_unstyled_list_sc( $atts, $content = null ) {
   return '<ul class="list-unstyled">' . do_shortcode( $content ) . '</ul>';
}

// List with heading to every li
function tcsn_heading_list_sc( $atts, $content = null ) {
    return '<ul class="list-unstyled">' . do_shortcode( $content ) . '</ul>';
}

// Inline list
function tcsn_inline_list_sc( $atts, $content = null ) {
   return '<ul class="list-inline">' . do_shortcode( $content ) . '</ul>';
}

// Separator list
function tcsn_separator_list_sc( $atts, $content = null ) {
   return '<ul class="list-separator">' . do_shortcode( $content ) . '</ul>';
}

/*------------------------------------------------------------
 * 4. Text color
 *
 * @since 1.0
 *
 * Examples below: 
 *
// [text_color color="blue"]Content here[/text_color] 
 *
 *------------------------------------------------------------*/
function tcsn_text_color_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'color' => '', 
    ), $atts ) );
	
	if( $color != '' ) {

	$return_start = ' style="';
	$return_end = '"';

	if( $color != ''  ) {
		$return_color = 'color:' . $color . ';';
	}
	else{
		$return_color = '';
	}
}
else {
	$return_start = '';
	$return_end = '';
	$return_color = '';
}
	return '<span class="color"' . $return_start . '' . $return_color . '' . $return_end . '>' . do_shortcode( $content ) . '</span>';
}

/*------------------------------------------------------------
 * 5. Dropcap
 *
 * @since 1.0
 *
 * Examples below: 
 *
// [dropcap size="" color=""]T[/dropcap]
 *
 *------------------------------------------------------------*/
function tcsn_dropcap_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'size'  => '', 
		'color' => '', 
    ), $atts ) );
	
if( $size != '' ||  $color != '' ) {

	$return_start = ' style="';
	$return_end = '"';

	if( $size != '' ) {
		$return_size = 'font-size:' . $size . ';';
	}
	else {
		$return_size = '';
	}

	if( $color != ''  ) {
		$return_color = 'color:' . $color . ';';
	}
	else{
		$return_color = '';
	}
}
else {
	$return_start = '';
	$return_end = '';
	$return_size = '';
	$return_color = '';
}
return '<span class="dropcap"' . $return_start . '' . $return_size . '' . $return_color . '' . $return_end . '>' . do_shortcode( $content ) . '</span>';
}  
  
/*------------------------------------------------------------
 * 6. Highlight
 *
 * @since 1.0
 *
 * Examples below: 
 *
// [highlight bgcolor="green" color="#fff"]Content here[/highlight] 
 *
 *------------------------------------------------------------*/
function tcsn_text_highlight_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'bgcolor' => '', 
		'color'   => '', 
    ), $atts ) );
	
	if( $bgcolor != '' ||  $color != '' ) {

	$return_start = ' style="';
	$return_end = '"';

	if( $bgcolor != '' ) {
		$return_bgcolor = 'background-color:' . $bgcolor . ';';
	}
	else {
		$return_bgcolor = '';
	}
	if( $color != ''  ) {
		$return_color = 'color:' . $color . ';';
	}
	else{
		$return_color = '';
	}
}
else {
	$return_start = '';
	$return_end = '';
	$return_bgcolor = '';
	$return_color = '';
}
	return '<span class="highlight"' . $return_start . '' . $return_bgcolor . '' . $return_color . '' . $return_end . '>' . do_shortcode( $content ) . '</span>';
}

/*------------------------------------------------------------
 * 7. Heading styles
 *
 * @since 1.0
 *
 * Examples below: 
 *
// [icon_heading icon_url=""]Heading here[/icon_heading]
// [glyphicon_heading icon_type="bookmark" icon_color=""]Heading here[/glyphicon_heading]
 *
 *------------------------------------------------------------*/
// Heading with icon - bootstrap font icon / for backward compatibility only
function tcsn_glyphicon_heading_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'icon_type'  => 'bookmark', 
		'icon_color' => '', 
    ), $atts ) );

 return '<h4 class="heading-icon clearfix"><span class="heading-icon-wrapper"><span class="glyphicon glyphicon-' . $icon_type . '" style="color: ' . $icon_color . ';"></span></span>' . do_shortcode( $content ) . '</h4>';
}

// Heading with icon font
function tcsn_icon_font_heading_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'icon_type'  => 'bookmark', 
		'icon_color' => '', 
    ), $atts ) );

 return '<h4 class="heading-icon clearfix"><span class="heading-icon-wrapper"><i class="icon-' . $icon_type . '" style="color: ' . $icon_color . ';"></i></span>' . do_shortcode( $content ) . '</h4>';
}

// Heading with icon - icon through url
function tcsn_icon_heading_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'icon_url'  => '', 
    ), $atts ) );

 return '<h4 class="heading-icon clearfix"><img src="' . $icon_url . '" width="40" height="40" alt="icon" class="icon-bg">' . do_shortcode( $content ) . '</h4>';
}

/*------------------------------------------------------------
 * 8. Feature styles
 *
 * @since 1.0
 *
 * Examples below: 
 *
// [feature_big_icon icon_url="" heading="Heading here"]Content here[/feature_big_icon]
// [feature_small_icon icon_url="" heading="Heading here"]Content here[/feature_small_icon]
// [feature_big_glyphicon icon_type="bookmark" icon_color="#000" heading="Heading here"]Content here[/feature_big_glyphicon]
// [feature_small_glyphicon icon_type="bookmark" icon_color="#000" heading="Heading here"]Content here[/feature_small_glyphicon]
 *
 *------------------------------------------------------------*/
// Features with big center icon
function tcsn_feature_big_icon_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'icon_url' => '', 
		'heading'  => '', 
    ), $atts ) );

 return '<div class="feature-big-icon"><img src="' . $icon_url . '" width="120" height="120" alt="icon" class="icon-big-bg"><h2>' . $heading . '</h2>' . do_shortcode( $content ) . '</div>';
}

// Features with big center glyphicon / for backward compatibility only
function tcsn_feature_big_glyphicon_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'icon_type' => '', 
		'icon_color' => '', 
		'heading'    => '', 
    ), $atts ) );

 return '<div class="feature-big-icon"><div class="icon-big-bg"><i class="glyphicon glyphicon-' . $icon_type . '" style="color: ' . $icon_color . ';"></i></div><h2>' . $heading . '</h2>' . do_shortcode( $content ) . '</div>';
}

// Features with big center icon font
function tcsn_feature_big_icon_font_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'icon_type' => '', 
		'icon_color' => '', 
		'heading'    => '', 
    ), $atts ) );

 return '<div class="feature-big-icon"><div class="icon-big-bg"><i class="icon-' . $icon_type . '" style="color: ' . $icon_color . ';"></i></div><h2>' . $heading . '</h2>' . do_shortcode( $content ) . '</div>';
}
            
// Features with small icon
function tcsn_feature_small_icon_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'icon_url' => '', 
		'heading'  => '', 
    ), $atts ) );

 return '<div class="feature-small-icon"><h5><img src="' . $icon_url . '" alt="icon" class="icon-small">' . $heading . '</h5>' . do_shortcode( $content ) . '</div>';
}  
                          
// Features with small glyphicon / for backward compatibility only
function tcsn_feature_small_glyphicon_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'icon_type'  => '', 
		'icon_color' => '', 
		'heading'    => '', 
    ), $atts ) );

 return '<div class="feature-small-icon"><h5><i class="glyphicon glyphicon-' . $icon_type . '" style="color: ' . $icon_color . ';"></i>' . $heading . '</h5>' . do_shortcode( $content ) . '</div>';
}  	 

// Features with small icon font 
function tcsn_feature_small_icon_font_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'icon_type'  => '', 
		'icon_color' => '', 
		'heading'    => '', 
    ), $atts ) );

 return '<div class="feature-small-icon"><h5><i class="small-icon icon-' . $icon_type . '" style="color: ' . $icon_color . ';"></i>' . $heading . '</h5>' . do_shortcode( $content ) . '</div>';
}  	 
 
/*------------------------------------------------------------
 * 9. Person
 *
 * @since 1.0
 *
 * Examples below: 
 *
// [person src="" name="" post="" twitter="" facebook="" skype="" mail="" link=""]Content here[/person]
 *
 *------------------------------------------------------------*/
function tcsn_team_person_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'src'      => '', 
		'name'     => '', 
		'post'     => '', 
		'twitter'  => '',
      	'facebook' => '',
      	'skype'    => '',
      	'mail'     => '',
		'link'     => '',
		'linkedin' => '',
    ), $atts ) );
	
	if( $src == '' ) {
    	$return_img = '';
    } 
	else{
    	$return_img = '<img src="' . $src . '" alt="member">';
    }

	if( $twitter != '' || $facebook != '' || $skype != '' || $linkedin != '' || $mail != '' || $link != '' ){
		$return_start = '<ul class="team-social clearfix">';
		$return_end = '</ul>';
			  
		if( $twitter != '' ) {
		  $return_twitter = '<li><a href="' .$twitter. '" target="_blank" class="twitter-icon" title="twitter"></a></li>';
		} 
		else{
		  $return_twitter = ''; 
		}
		
		if( $facebook != '' ) {
		  $return_facebook = '<li><a href="' .$facebook. '" target="_blank" class="facebook-icon" title="facebook"></a></li>';
		} 
		else{
		  $return_facebook = ''; 
		}
		
		if( $skype != '' ) {
		  $return_skype = '<li><a href="' .$skype. '" target="_blank" class="skype-icon" title="skype"></a></li>';
		} 
		else{
		  $return_skype = ''; 
		}
		
		if( $linkedin != '' ) {
		  $return_linkedin = '<li><a href="' .$linkedin. '" target="_blank" class="linkedin-icon" title="linkedin"></a></li>';
		} 
		else{
		  $return_linkedin = ''; 
		}
		
		if( $mail != '' ) {
		  $return_mail = '<li><a href="mailto:' . $mail . '" target="_blank" class="mail-icon" title="mail"></a></li>';
		} 
		else{
		  $return_mail = ''; 
		}
		
		if( $link != '' ) {
		  $return_link = '<li><a href="' . $link . '" target="_blank" class="link-icon" title="link"></a></li>';
		} 
		else{
		  $return_link = ''; 
		}
	}  
	else {
		$return_start = '';
		$return_twitter = ''; 
		$return_facebook = ''; 
		$return_skype = ''; 
		$return_linkedin = ''; 
		$return_mail = ''; 
		$return_link = ''; 
		$return_end = '';
	}    
	return '<div class="team">' . $return_img . '<h5>' . $name . '<span>' . $post . '</span></h5>' . do_shortcode( $content ) . '' . $return_start . '' . $return_twitter . '' . $return_facebook . '' . $return_skype . '' . $return_linkedin . '' . $return_mail . '' . $return_link . '' . $return_end . '</div>';
}

/*------------------------------------------------------------
 * 10. Image with text on overlay
 *
 * @since 1.0
 *
 * Examples below: 
 *
// [overlay_image src=""]Content here[/overlay_image]
 *
 *------------------------------------------------------------*/
function tcsn_image_overlay_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'src' => '', 
		'heading'  => '', 
    ), $atts ) );
	return '<div class="relativeto"><img src="' . $src . '" alt="image"><div class="about-overlay"><div class="overlay-inner">' . do_shortcode( $content ) . '</div></div></div>';
}  

/*------------------------------------------------------------
 * 11. Box
 *
 * @since 1.0
 *
 * Example below: 
 * 
// [box style="dark"]Content here[/box]
// [box style="light"]Content here[/box]
 * 
 *------------------------------------------------------------*/
function tcsn_box_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'style'       => '', // light, dark
    ), $atts ) );
	return '<div class="box-' . $style . '">' . do_shortcode( $content ) . '</div>';
}

/*------------------------------------------------------------
 * 12. Vertical Spacer / Gap
 *
 * @since 1.0
 *
 * Example below: 
 * 
// [spacer height="in px"]
 * 
 *------------------------------------------------------------*/
function tcsn_spacer_sc( $atts, $content ) {
	extract ( shortcode_atts( array(
		'height'       => '', // in px
    ), $atts ) );

	return '<div class="spacer" style="height: ' . $height . ';"></div>';
}

/*------------------------------------------------------------
 * 13. Divider
 *
 * @since 1.0
 *
 * Example below: 
 * 
// [divider]
 * 
 *------------------------------------------------------------*/
function tcsn_divider_sc( $atts, $content ) {
	extract ( shortcode_atts( array(
		'style'       => '', 
    ), $atts ) );
	
	return '<div class="divider divider-' . $style . '"></div>';
}

/*------------------------------------------------------------
 * 14. Blockquote
 *
 * @since 1.0
 *
 * Examples below:
 *
// [blockquote align=""]Content here[/blockquote]
// [blockquote align="pull-right"]Content here[/blockquote]
 *
 *------------------------------------------------------------*/
function tcsn_blockquote_sc( $atts,  $content = null ) {
	extract( shortcode_atts( array(
    	'align' => '', 
    ), $atts ) );
	if( $align != ''  ) {
		$return_align = ' class="' . $align . '"';
	}
	else{
		$return_align = '';
	}
    return '<blockquote' . $return_align . '>' . do_shortcode( $content ) . '</blockquote>';
}

/*------------------------------------------------------------
 * 15. Tooltip
 *
 * @since 1.0
 *
 * Examples below: TODO - placement not working yet, check while upgarding to bootstrap 3
 *
// [tooltip url="" title="Content inside tooltip" placement="top"]Link text[/tooltip]
 *
 *------------------------------------------------------------*/
function tcsn_tooltip_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'url'       => '', 
		'title'     => '', 
        'placement' => 'top', // top, bottom, left, right
    ), $atts ) );
	
	if( $url != ''  ) {
		$return_url = 'href="' . $url . '" ';
	}
	else{
		$return_url = '';
	}
    return '<a ' . $return_url . 'title="' . $title . '" data-placement="' . $placement . '" data-toggle="tooltip" target="_blank">' . do_shortcode( $content ) . '</a>';
}

/*------------------------------------------------------------
 * 16. Carousel
 *
 * @since 1.0
 *
 * Example below: 
 * 
// [carousel-wrapper][/carousel-wrapper]
// [carousel-item src="" alt="" large_img_link="" large_img_title="" url=""]
 * 
 *------------------------------------------------------------*/
function tcsn_carousel_wrapper_sc( $atts, $content = null ) {
	return '<div class="es-carousel-wrapper"><div class="es-carousel"><ul class="clearfix">' . do_shortcode( $content ) . '</ul></div></div>';
}

function tcsn_carousel_item_sc( $atts ) {
	extract ( shortcode_atts( array(
		'src'       => '',
		'alt'       => '', 
		'large_img_link'       => '', 
		'large_img_title'       => '', 
		'url' => '',
    ), $atts ) );
	
	return '<li><div class="folio-thumb"><img src="' . $src . '" alt="' . $alt . '"/><a href="' . $large_img_link . '" data-rel="prettyPhoto[gallery]" title="' . $large_img_title . '" class="icon-zoom"></a><a href="' . $url . '" class="icon-link" target="_blank"></a></div></li>';
}

/*------------------------------------------------------------
 * 17. Image with Lightbox
 *
 * @since 1.0
 *
 * Example below: 
 * 
// [image-item src="" alt="" large_img_link="" large_img_title=""]
 * 
 *------------------------------------------------------------*/
function tcsn_image_item_sc( $atts ) {
	extract ( shortcode_atts( array(
		'src'       => '',
		'alt'       => '', 
		'large_img_link'       => '', 
		'large_img_title'       => '', 
    ), $atts ) );
	
	return '<div class="folio-thumb"><img src="' . $src . '" alt="' . $alt . '"/><a href="' . $large_img_link . '" data-rel="prettyPhoto" title="' . $large_img_title . '" class="icon-zoom-only"></a></div>';
}

/*------------------------------------------------------------
 * 18. Table
 *
 * @since 1.0
 *
 * Example below:
 *
// [table strip="striped" border="bordered" compact="" hover="hover"]
//
// [thead]
// [tr]
// [th]Heading one[/th]
// [th]Heading two[/th]
// [/tr]
// [/thead]
//
// [tbody]
// [tr]
// [td]One[/td]
// [td]Two[/td]
// [/tr]
// [tr]
// [td]Three[/td]
// [td]Four[/td]
// [/tr]
// [/tbody]
//
// [/table]
 *
 *------------------------------------------------------------*/
function tcsn_table_sc( $atts,  $content = null ) {
	extract( shortcode_atts( array(
    	'strip'   => '', // null, striped
        'border'  => '', // null, bordered
        'hover'   => '', // null, hover
        'compact' => '' // null, condensed
    ), $atts ) );
    if ( $strip ) {
        $strip = 'table-' . $strip;
    }
    if ( $border ) {
        $border = 'table-' . $border;
    }
    if ( $hover ) {
        $hover = 'table-' . $hover;
    }
    if ( $compact ) {
        $compact  = 'table-' . $compact;
    }
    return '<table class="table ' . $strip . ' ' . $border . ' ' . $hover . ' ' . $compact  . '">' . do_shortcode( $content ) . '</table>';
}

// Table Body
function tcsn_table_body_sc( $atts,  $content = null ) {
	extract ( shortcode_atts( array(
		'class'       => '',  // null, success, error, warning, info
    ), $atts ) );
	if( $class != ''  ) {
		$return_url = ' class="' . $class . '"';
	}
	else{
		$return_url = '';
	}
    return '<tbody' . $return_url . '>' . do_shortcode( $content ) . '</tbody>';
}

// Table Head
function tcsn_table_head_sc( $atts,  $content = null ) {
	extract ( shortcode_atts( array(
		'class'       => '', 
    ), $atts ) );
	if( $class != ''  ) {
		$return_url = ' class="' . $class . '"';
	}
	else{
		$return_url = '';
	}
    return '<thead' . $return_url . '>' . do_shortcode( $content ) . '</thead>';
}

// Table Row
function tcsn_table_tr_sc( $atts,  $content = null ) {
	extract ( shortcode_atts( array(
		'class'       => '',  // null, success, error, warning, info
    ), $atts ) );
	if( $class != ''  ) {
		$return_url = ' class="' . $class . '"';
	}
	else{
		$return_url = '';
	}
    return '<tr' . $return_url . '>' . do_shortcode( $content ) . '</tr>';
}

// Table Head Cell
function tcsn_table_th_sc( $atts,  $content = null ) {
	extract ( shortcode_atts( array(
		'class'       => '', 
    ), $atts ) );
	if( $class != ''  ) {
		$return_url = ' class="' . $class . '"';
	}
	else{
		$return_url = '';
	}
    return '<th' . $return_url . '>' . do_shortcode( $content ) . '</th>';
}

// Table Cell
function tcsn_table_td_sc( $atts,  $content = null ) {
	extract ( shortcode_atts( array(
		'class'       => '', 
    ), $atts ) );
	if( $class != ''  ) {
		$return_url = ' class="' . $class . '"';
	}
	else{
		$return_url = '';
	}
    return '<td' . $return_url . '>' . do_shortcode( $content ) . '</td>';
}

/*------------------------------------------------------------
 * 19. Pricing Table
 *
 * @since 1.0
 *
 * For backward compatibilty
 * Only "pricing_features","pricing_list_item" are used in latest versions.
 *------------------------------------------------------------*/
// pricing
function tcsn_pricing_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'columns'    => '', // three, four
	), $atts ) );
	return '<div class="pricing ' . $columns . '-col clearfix">' . do_shortcode( $content ) . '</div>';
}
// pricing column
function tcsn_pricing_column_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'style'    => '', // first, last, focused
	), $atts ) );

	return '<div class="price-column ' . $style . '">' . do_shortcode( $content ) . '</div>';
}
// Pricing table head
function tcsn_pricing_thead_sc( $atts, $content ) {
	extract ( shortcode_atts( array(
		'style'    => '', // first, last, focused
		'heading'    => '',
		'currency'    => '',
		'price'    => '',
		'cents'    => '',
		'slug' => '',
	), $atts ) );
	
	if( $slug != ''  ) {
		$return_slug = '<p class="table-slug">' . $slug . '</p>';
	}
	else{
		$return_slug = '';
	}
	return '<div class="table-th">' . $return_slug . '<h4>' . $heading . '</h4><sup>' . $currency . '</sup>' . $price . '<sup>' . $cents . '</sup></div><div class="clearfix"></div>';
}
// Pricing table content
function tcsn_pricing_tcontent_sc( $atts, $content ) {
	return '<div class="table-content clearfix">' . do_shortcode( $content ) . '</div>';
}
// Pricing table feature list
function tcsn_pricing_list_sc( $atts, $content ) {
	return '<ul>' . do_shortcode( $content ) . '</ul>';
}

function tcsn_pricing_list_item_sc( $atts, $content ) {
	return '<li>' . do_shortcode( $content ) . '</li>';
}