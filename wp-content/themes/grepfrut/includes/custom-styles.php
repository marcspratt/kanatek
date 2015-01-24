<?php 
/**
 * Custom styles through options panel
 *
 */
function tcsn_custom_styles() {
	global $smof_data;

	wp_enqueue_style(
		'tcsn-custom-style',
		get_template_directory_uri() . '/css/custom_script.css'
	);

	// Variables
	// Body
	if(isset($smof_data['tcsn_font_body']['face'])) { $tcsn_body_face  = $smof_data['tcsn_font_body']['face']; }
	if(isset($smof_data['tcsn_font_body']['size'])) { $tcsn_body_size  = $smof_data['tcsn_font_body']['size']; }
	if(isset($smof_data['tcsn_font_body']['style'])) { $tcsn_body_style = $smof_data['tcsn_font_body']['style']; }
	if(isset($smof_data['tcsn_font_body']['color'])) { $tcsn_body_color = $smof_data['tcsn_font_body']['color']; }
	
	// Headings
	if(isset($smof_data['tcsn_font_h1']['face'])) { $tcsn_h1_face  = $smof_data['tcsn_font_h1']['face']; }
	if(isset($smof_data['tcsn_font_h1']['size'])) { $tcsn_h1_size  = $smof_data['tcsn_font_h1']['size']; }
	if(isset($smof_data['tcsn_font_h1']['style'])) { $tcsn_h1_style = $smof_data['tcsn_font_h1']['style']; }
	if(isset($smof_data['tcsn_font_h1']['color'])) { $tcsn_h1_color = $smof_data['tcsn_font_h1']['color']; }
	
	if(isset($smof_data['tcsn_font_h2']['face'])) { $tcsn_h2_face  = $smof_data['tcsn_font_h2']['face']; }
	if(isset($smof_data['tcsn_font_h2']['size'])) { $tcsn_h2_size  = $smof_data['tcsn_font_h2']['size']; }
	if(isset($smof_data['tcsn_font_h2']['style'])) { $tcsn_h2_style = $smof_data['tcsn_font_h2']['style']; }
	if(isset($smof_data['tcsn_font_h2']['color'])) { $tcsn_h2_color = $smof_data['tcsn_font_h2']['color']; }
	
	if(isset($smof_data['tcsn_font_h3']['face'])) { $tcsn_h3_face  = $smof_data['tcsn_font_h3']['face']; }
	if(isset($smof_data['tcsn_font_h3']['size'])) { $tcsn_h3_size  = $smof_data['tcsn_font_h3']['size']; }
	if(isset($smof_data['tcsn_font_h3']['style'])) { $tcsn_h3_style = $smof_data['tcsn_font_h3']['style']; }
	if(isset($smof_data['tcsn_font_h3']['color'])) { $tcsn_h3_color = $smof_data['tcsn_font_h3']['color']; }
	
	if(isset($smof_data['tcsn_font_h4']['face'])) { $tcsn_h4_face  = $smof_data['tcsn_font_h4']['face']; }
	if(isset($smof_data['tcsn_font_h4']['size'])) { $tcsn_h4_size  = $smof_data['tcsn_font_h4']['size']; }
	if(isset($smof_data['tcsn_font_h4']['style'])) { $tcsn_h4_style = $smof_data['tcsn_font_h4']['style']; }
	if(isset($smof_data['tcsn_font_h4']['color'])) { $tcsn_h4_color = $smof_data['tcsn_font_h4']['color']; }
	
	if(isset($smof_data['tcsn_font_h5']['face'])) { $tcsn_h5_face  = $smof_data['tcsn_font_h5']['face']; }
	if(isset($smof_data['tcsn_font_h5']['size'])) { $tcsn_h5_size  = $smof_data['tcsn_font_h5']['size']; }
	if(isset($smof_data['tcsn_font_h5']['style'])) { $tcsn_h5_style = $smof_data['tcsn_font_h5']['style']; }
	if(isset($smof_data['tcsn_font_h5']['color'])) { $tcsn_h5_color = $smof_data['tcsn_font_h5']['color']; }
	
	if(isset($smof_data['tcsn_font_h6']['face'])) { $tcsn_h6_face  = $smof_data['tcsn_font_h6']['face']; }
	if(isset($smof_data['tcsn_font_h6']['size'])) { $tcsn_h6_size  = $smof_data['tcsn_font_h6']['size']; }
	if(isset($smof_data['tcsn_font_h6']['style'])) { $tcsn_h6_style = $smof_data['tcsn_font_h6']['style']; }
	if(isset($smof_data['tcsn_font_h6']['color'])) { $tcsn_h6_color = $smof_data['tcsn_font_h6']['color']; }
	
	// Header & Top bar
	if(isset($smof_data['tcsn_font_logo']['face'])) { $tcsn_logo_face  = $smof_data['tcsn_font_logo']['face']; }
	if(isset($smof_data['tcsn_font_logo']['size'])) { $tcsn_logo_size  = $smof_data['tcsn_font_logo']['size']; }
	if(isset($smof_data['tcsn_font_logo']['style'])) { $tcsn_logo_style = $smof_data['tcsn_font_logo']['style']; }
	if(isset($smof_data['tcsn_font_logo']['color'])) { $tcsn_logo_color = $smof_data['tcsn_font_logo']['color']; }
	$tcsn_hover_logo = '';
	if(isset($smof_data['tcsn_hover_logo'])) { $tcsn_hover_logo  = $smof_data['tcsn_hover_logo']; }
	$tcsn_top_margin_logo = '';
	if(isset($smof_data['tcsn_top_margin_logo'])) { $tcsn_top_margin_logo = $smof_data['tcsn_top_margin_logo']; }

	if(isset($smof_data['tcsn_font_phone']['face'])) { $tcsn_phone_face  = $smof_data['tcsn_font_phone']['face']; }
	if(isset($smof_data['tcsn_font_phone']['size'])) { $tcsn_phone_size  = $smof_data['tcsn_font_phone']['size']; }
	if(isset($smof_data['tcsn_font_phone']['style'])) { $tcsn_phone_style = $smof_data['tcsn_font_phone']['style']; }
	if(isset($smof_data['tcsn_font_phone']['color'])) { $tcsn_phone_color = $smof_data['tcsn_font_phone']['color']; }

	if(isset($smof_data['tcsn_font_tagline']['face'])) { $tcsn_tagline_face  = $smof_data['tcsn_font_tagline']['face']; }
	if(isset($smof_data['tcsn_font_tagline']['size'])) { $tcsn_tagline_size  = $smof_data['tcsn_font_tagline']['size']; }
	if(isset($smof_data['tcsn_font_tagline']['style'])) { $tcsn_tagline_style = $smof_data['tcsn_font_tagline']['style']; }
	if(isset($smof_data['tcsn_font_tagline']['color'])) { $tcsn_tagline_color = $smof_data['tcsn_font_tagline']['color']; }

	if(isset($smof_data['tcsn_font_menu']['face'])) { $tcsn_menu_face  = $smof_data['tcsn_font_menu']['face']; }
	if(isset($smof_data['tcsn_font_menu']['size'])) { $tcsn_menu_size  = $smof_data['tcsn_font_menu']['size']; }
	if(isset($smof_data['tcsn_font_menu']['style'])) { $tcsn_menu_style = $smof_data['tcsn_font_menu']['style']; }
	if(isset($smof_data['tcsn_font_menu']['color'])) { $tcsn_menu_color = $smof_data['tcsn_font_menu']['color']; }
	$tcsn_menu_link_color = '';
	if(isset($smof_data['tcsn_menu_link_color'])) { $tcsn_menu_link_color = $smof_data['tcsn_menu_link_color']; }
	 $tcsn_bg_color_hover_menu = '';
	if(isset($smof_data['tcsn_bg_color_hover_menu'])) { $tcsn_bg_color_hover_menu = $smof_data['tcsn_bg_color_hover_menu']; }
	$tcsn_bg_color_dropdown_menu = '';
	if(isset($smof_data['tcsn_bg_color_dropdown_menu'])) { $tcsn_bg_color_dropdown_menu = $smof_data['tcsn_bg_color_dropdown_menu']; } 
	$tcsn_link_hover_dropdown = '';
	if(isset($smof_data['tcsn_link_hover_dropdown'])) { $tcsn_link_hover_dropdown = $smof_data['tcsn_link_hover_dropdown']; }
	$tcsn_bg_color_topbar = ''; 
	if(isset($smof_data['tcsn_bg_color_topbar'])) { $tcsn_bg_color_topbar = $smof_data['tcsn_bg_color_topbar']; } 
	
	// Header bottom
	if(isset($smof_data['tcsn_font_header_btm']['face'])) { $tcsn_header_btm_face = $smof_data['tcsn_font_header_btm']['face']; }
	if(isset($smof_data['tcsn_font_header_btm']['size'])) { $tcsn_header_btm_size = $smof_data['tcsn_font_header_btm']['size']; }
	if(isset($smof_data['tcsn_font_header_btm']['style'])) { $tcsn_header_btm_style = $smof_data['tcsn_font_header_btm']['style']; }
	if(isset($smof_data['tcsn_font_header_btm']['color'])) { $tcsn_header_btm_color = $smof_data['tcsn_font_header_btm']['color']; }
	$tcsn_top_margin_breadcrumb = '';
	if(isset($smof_data['tcsn_top_margin_breadcrumb'])) { $tcsn_top_margin_breadcrumb = $smof_data['tcsn_top_margin_breadcrumb']; }
	$tcsn_link_color_header_btm = '';
	if(isset($smof_data['tcsn_link_color_header_btm'])) { $tcsn_link_color_header_btm = $smof_data['tcsn_link_color_header_btm']; }
	$tcsn_link_hover_header_btm = '';
	if(isset($smof_data['tcsn_link_hover_header_btm'])) { $tcsn_link_hover_header_btm = $smof_data['tcsn_link_hover_header_btm']; }
	$tcsn_color_active_breadcrumb = '';
	if(isset($smof_data['tcsn_color_active_breadcrumb'])) { $tcsn_color_active_breadcrumb = $smof_data['tcsn_color_active_breadcrumb']; }
	$tcsn_border_bottom_headerbtm = '';
	if(isset($smof_data['tcsn_border_bottom_headerbtm'])) { $tcsn_border_bottom_headerbtm = $smof_data['tcsn_border_bottom_headerbtm']; }
	if(isset($smof_data['tcsn_font_title']['face'])) { $tcsn_title_face  = $smof_data['tcsn_font_title']['face']; }
	if(isset($smof_data['tcsn_font_title']['size'])) { $tcsn_title_size  = $smof_data['tcsn_font_title']['size']; }
	if(isset($smof_data['tcsn_font_title']['style'])) { $tcsn_title_style = $smof_data['tcsn_font_title']['style']; }
	if(isset($smof_data['tcsn_font_title']['color'])) { $tcsn_title_color = $smof_data['tcsn_font_title']['color']; }
	
	// Footer
	if(isset($smof_data['tcsn_font_footer']['face'])) { $tcsn_footer_face  = $smof_data['tcsn_font_footer']['face']; }
	if(isset($smof_data['tcsn_font_footer']['size'])) { $tcsn_footer_size  = $smof_data['tcsn_font_footer']['size']; }
	if(isset($smof_data['tcsn_font_footer']['style'])) { $tcsn_footer_style = $smof_data['tcsn_font_footer']['style']; }
	if(isset($smof_data['tcsn_font_footer']['color'])) { $tcsn_footer_color = $smof_data['tcsn_font_footer']['color']; }
	$tcsn_color_footer_headings = '';
	if(isset($smof_data['tcsn_color_footer_headings'])) { $tcsn_color_footer_headings = $smof_data['tcsn_color_footer_headings']; }
	$tcsn_color_footer_link = '';
	if(isset($smof_data['tcsn_color_footer_link'])) { $tcsn_color_footer_link = $smof_data['tcsn_color_footer_link']; }
	$tcsn_color_footer_link_hover = '';
	if(isset($smof_data['tcsn_color_footer_link_hover'])) { $tcsn_color_footer_link_hover = $smof_data['tcsn_color_footer_link_hover']; }

	// Copyright
	if(isset($smof_data['tcsn_font_copyright']['face'])) { $tcsn_copyright_face  = $smof_data['tcsn_font_copyright']['face']; }
	if(isset($smof_data['tcsn_font_copyright']['size'])) { $tcsn_copyright_size  = $smof_data['tcsn_font_copyright']['size']; }
	if(isset($smof_data['tcsn_font_copyright']['style'])) { $tcsn_copyright_style = $smof_data['tcsn_font_copyright']['style']; }
	if(isset($smof_data['tcsn_font_copyright']['color'])) { $tcsn_copyright_color = $smof_data['tcsn_font_copyright']['color']; }
	$tcsn_bg_color_copyright = '';
	if(isset($smof_data['tcsn_bg_color_copyright'])) { $tcsn_bg_color_copyright = $smof_data['tcsn_bg_color_copyright']; }
	$tcsn_link_color_copyright = '';
	if(isset($smof_data['tcsn_link_color_copyright'])) { $tcsn_link_color_copyright = $smof_data['tcsn_link_color_copyright']; }
	$tcsn_link_hover_copyright = '';
	if(isset($smof_data['tcsn_link_hover_copyright'])) { $tcsn_link_hover_copyright = $smof_data['tcsn_link_hover_copyright']; }
	$tcsn_border_top_copyright = '';
	if(isset($smof_data['tcsn_border_top_copyright'])) { $tcsn_border_top_copyright = $smof_data['tcsn_border_top_copyright']; }
	
	// General 
	$tcsn_link_color = '';
	if(isset($smof_data['tcsn_link_color'])) { $tcsn_link_color = $smof_data['tcsn_link_color']; }
	$tcsn_link_hover_color = '';
	if(isset($smof_data['tcsn_link_hover_color'])) { $tcsn_link_hover_color = $smof_data['tcsn_link_hover_color']; }
	$tcsn_text_color = '';
	if(isset($smof_data['tcsn_text_color'])) { $tcsn_text_color = $smof_data['tcsn_text_color']; }
	$tcsn_icon_bg = '';
	if(isset($smof_data['tcsn_icon_bg'])) { $tcsn_icon_bg = $smof_data['tcsn_icon_bg']; }
	$tcsn_twitter_box_bg = '';
	if(isset($smof_data['tcsn_bg_color_twitter_box'])) { $tcsn_twitter_box_bg = $smof_data['tcsn_bg_color_twitter_box']; }
	$tcsn_twitter_box_border = '';
	if(isset($smof_data['tcsn_border_color_twitter_box'])) { $tcsn_twitter_box_border = $smof_data['tcsn_border_color_twitter_box']; }
	$tcsn_blockquote_color = '';
	if(isset($smof_data['tcsn_blockquote_color'])) { $tcsn_blockquote_color = $smof_data['tcsn_blockquote_color']; }
	if(isset($smof_data['tcsn_font_button']['face'])) { $tcsn_button_face  = $smof_data['tcsn_font_button']['face']; }
	if(isset($smof_data['tcsn_font_button']['style'])) { $tcsn_button_style = $smof_data['tcsn_font_button']['style']; }
	$tcsn_tag_bg_color = '';
	if(isset($smof_data['tcsn_tag_bg_color'])) { $tcsn_tag_bg_color = $smof_data['tcsn_tag_bg_color']; }
	$tcsn_pricing_color = '';
	if(isset($smof_data['tcsn_pricing_color'])) { $tcsn_pricing_color = $smof_data['tcsn_pricing_color']; }

	// Styles
	$custom_css = "
body { font-family: {$tcsn_body_face}, Arial, Helvetica, sans-serif; font-size: {$tcsn_body_size}; font-weight: {$tcsn_body_style}; color: {$tcsn_body_color}; }
h1 { font-family: {$tcsn_h1_face}, Arial, Helvetica, sans-serif; font-size: {$tcsn_h1_size}; font-weight: {$tcsn_h1_style}; color: {$tcsn_h1_color}; }
h2 { font-family: {$tcsn_h2_face}, Arial, Helvetica, sans-serif; font-size: {$tcsn_h2_size}; font-weight: {$tcsn_h2_style}; color: {$tcsn_h2_color}; }
h3 { font-family: {$tcsn_h3_face}, Arial, Helvetica, sans-serif; font-size: {$tcsn_h3_size}; font-weight: {$tcsn_h3_style}; color: {$tcsn_h3_color}; }
h4, .heading-icon, .post-title, .post-title a  { font-family: {$tcsn_h4_face}, Arial, Helvetica, sans-serif; font-size: {$tcsn_h4_size}; font-weight: {$tcsn_h4_style}; color: {$tcsn_h4_color}; }
h5 { font-family: {$tcsn_h5_face}, Arial, Helvetica, sans-serif; font-size: {$tcsn_h5_size}; font-weight: {$tcsn_h5_style}; color: {$tcsn_h5_color}; }
h6 { font-family: {$tcsn_h6_face}, Arial, Helvetica, sans-serif; font-size: {$tcsn_h6_size}; font-weight: {$tcsn_h6_style}; color: {$tcsn_h6_color}; }
a, a:link { color: {$tcsn_link_color}; }
a:hover { color: {$tcsn_link_hover_color}; }
.inactive-folio-page, .page-links a { background-color: {$tcsn_link_color}; }
.logo a { font-family: {$tcsn_logo_face}, Arial, Helvetica, sans-serif; font-size: {$tcsn_logo_size}; font-weight: {$tcsn_logo_style}; color: {$tcsn_logo_color}; margin-top: {$tcsn_top_margin_logo}; }
.logo a:hover { color: {$tcsn_hover_logo}; }
.call-number { font-family: {$tcsn_phone_face}, Arial, Helvetica, sans-serif; font-size: {$tcsn_phone_size}; font-weight: {$tcsn_phone_style}; color: {$tcsn_phone_color}; }
.tagline { font-family: {$tcsn_tagline_face}, Arial, Helvetica, sans-serif; font-size: {$tcsn_tagline_size}; font-weight: {$tcsn_tagline_style}; color: {$tcsn_tagline_color}; }
.ddsmoothmenu ul li a { font-family: {$tcsn_menu_face}, Arial, Helvetica, sans-serif; font-size: {$tcsn_menu_size}; font-weight: {$tcsn_menu_style}; color: {$tcsn_menu_color}; }
.ddsmoothmenu ul li.current-menu-item a, .ddsmoothmenu ul li a:hover { background: {$tcsn_bg_color_hover_menu}; color : {$tcsn_menu_color} !important; }
.ddsmoothmenu ul li ul { background: {$tcsn_bg_color_dropdown_menu} }
.ddsmoothmenu ul li ul li.current-menu-item a, .ddsmoothmenu ul li ul li a:hover { color: {$tcsn_link_hover_dropdown} !important; }
.menu-link-color a { color: {$tcsn_menu_link_color} !important; }
#top-bar { background-color: {$tcsn_bg_color_topbar} }
#page-header { font-family: {$tcsn_header_btm_face}, Arial, Helvetica, sans-serif; font-size: {$tcsn_header_btm_size}; font-weight: {$tcsn_header_btm_style}; color: {$tcsn_header_btm_color}; border-bottom: 1px solid {$tcsn_border_bottom_headerbtm};  }
#page-header a { color: {$tcsn_link_color_header_btm}; }
#page-header a:hover { color: {$tcsn_link_hover_header_btm}; }
#page-header .heading-icon { font-family: {$tcsn_title_face}, Arial, Helvetica, sans-serif; font-size: {$tcsn_title_size}; font-weight: {$tcsn_title_style}; color: {$tcsn_title_color}; }
.breadcrumbs { margin-top: {$tcsn_top_margin_breadcrumb}; }
.breadcrumbs > .crumb-active { color: {$tcsn_color_active_breadcrumb}; }
#footer { font-family: {$tcsn_footer_face}, Arial, Helvetica, sans-serif; font-size: {$tcsn_footer_size}; font-weight: {$tcsn_footer_style}; color: {$tcsn_footer_color}; }
#footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6 { color: {$tcsn_color_footer_headings}; }
#footer a, #footer a:link   { color: {$tcsn_color_footer_link}; }
#footer a:hover   { color: {$tcsn_color_footer_link_hover}; }
.twitter-box { background: {$tcsn_twitter_box_bg}; border: 1px solid {$tcsn_twitter_box_border}; }
#copyright {  background: {$tcsn_bg_color_copyright}; font-family: {$tcsn_copyright_face}, Arial, Helvetica, sans-serif; font-size: {$tcsn_copyright_size}; font-weight: {$tcsn_copyright_style}; color: {$tcsn_copyright_color}; border-top: 1px solid {$tcsn_border_top_copyright}; }
#copyright a { color: {$tcsn_link_color_copyright}; }
#copyright a:hover { color: {$tcsn_link_hover_copyright}; }
.icon-bg, .feature-big-icon .icon-big-bg { background: {$tcsn_icon_bg}; }
.post-title a { color: {$tcsn_h4_color}; }
blockquote { border-left: 5px solid {$tcsn_blockquote_color}; }
blockquote p, blockquote { color: {$tcsn_blockquote_color}; }
blockquote.pull-right { border-right: 5px solid {$tcsn_blockquote_color}; }
.mybtn, .mybtn-big, .mybtn-small, .mybtn-exsmall { font-family: {$tcsn_button_face}, Arial, Helvetica, sans-serif; font-weight: {$tcsn_button_style}; }
.custom-tagcloud a, .custom-tagcloud a:link { background: {$tcsn_tag_bg_color}; }
.table-th, .table-slug { color: {$tcsn_pricing_color}; }
.color { color: {$tcsn_text_color}; }
	";
	wp_add_inline_style( 'tcsn-custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'tcsn_custom_styles', 80 );

if ( ! function_exists( 'tcsn_css_custom' ) ) {
	function tcsn_css_custom() {
	global $smof_data; 
?>
<style>
body {<?php if(isset($smof_data['tcsn_show_pattern_body'])) {  if ( $smof_data['tcsn_show_pattern_body'] == 1 ) { ?>background-color: <?php echo $smof_data['tcsn_bg_color_body']; ?>; background-image: url( <?php echo $smof_data['tcsn_pattern_body'] ?> ); background-repeat: <?php echo $smof_data['tcsn_pattern_repeat_body']; ?>; background-attachment: <?php echo $smof_data['tcsn_attachment_body']; ?>; <?php } else { ?> background-color: <?php echo $smof_data['tcsn_bg_color_body']; ?>; <?php } } ?>}
#header { <?php if(isset($smof_data['tcsn_show_pattern_header'])) { if( $smof_data['tcsn_show_pattern_header'] == 1 ) { ?>background-color: <?php echo $smof_data['tcsn_bg_color_header']; ?>; background-image: url( <?php echo $smof_data['tcsn_pattern_header'] ?> ); background-repeat: <?php echo $smof_data['tcsn_pattern_repeat_header']; ?>; <?php } else { ?> background-color: <?php echo $smof_data['tcsn_bg_color_header']; ?>; <?php } } ?>}
#page-header {<?php if(isset($smof_data['tcsn_show_pattern_header_btm'])) { if( $smof_data['tcsn_show_pattern_header_btm'] == 1 ) { ?>background-color: <?php echo $smof_data['tcsn_bg_color_header_btm']; ?>; background-image: url( <?php echo $smof_data['tcsn_pattern_header_btm'] ?> ); background-repeat: <?php echo $smof_data['tcsn_pattern_repeat_header_btm']; ?>; <?php } else { ?> background-color: <?php echo $smof_data['tcsn_bg_color_header_btm']; ?>; <?php } } ?>}
#slider-bg { <?php if(isset($smof_data['tcsn_show_pattern_slider_bg'])) { if( $smof_data['tcsn_show_pattern_slider_bg'] == 1 ) { ?>background-color: <?php echo $smof_data['tcsn_color_slider_bg']; ?>; background-image: url( <?php echo $smof_data['tcsn_pattern_slider_bg'] ?> ); <?php } else { ?> background-color: <?php echo $smof_data['tcsn_color_slider_bg']; ?>; <?php } } ?>}
#footer { <?php if(isset($smof_data['tcsn_show_pattern_footer'])) { if( $smof_data['tcsn_show_pattern_footer'] == 1 ) { ?>background-color: <?php echo $smof_data['tcsn_bg_color_footer']; ?>; background-image: url( <?php echo $smof_data['tcsn_pattern_footer'] ?> ); background-repeat: <?php echo $smof_data['tcsn_pattern_repeat_footer']; ?>; <?php } else { ?> background-color: <?php echo $smof_data['tcsn_bg_color_footer']; ?>; <?php } } ?>}
body, #header, #top-bar, .box-dark, .dark-box h1, .dark-box h2, .dark-box h3, .dark-box h4, .dark-box h5, .dark-box h6, #footer, .about-overlay, .js .selectnav, #copyright, #page-header, #footer {<?php if ( $smof_data['tcsn_show_text_shadow'] == 0 ) { ?>text-shadow: none;<?php } ?>}
<?php if(isset($smof_data['tcsn_custom_css'])) { if( $smof_data['tcsn_custom_css'] != '' ) { echo $smof_data['tcsn_custom_css']; } } ?>
</style>
<?php echo "\n".'<link rel="stylesheet" href="'. get_stylesheet_directory_uri() .'/css/custom.css?ver=' . THEME_VERSION . '" media="all" />'."\n";
	}
}
add_action( 'wp_head', 'tcsn_css_custom', 90 );