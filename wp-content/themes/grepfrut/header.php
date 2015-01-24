<?php
/**
 * The Header for theme.
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="keywords" content="business, marketing, corporate, app, software, marketing"/>
<?php global $smof_data; ?>    
<?php if(isset($smof_data['tcsn_layout_responsive'])) {
		if( $smof_data['tcsn_layout_responsive'] == 1 ) { ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<?php } } ?>
<title>
<?php
if ( is_page() ) {
	wp_title( '-', true, 'right' );
} elseif ( is_search() ) {
	echo 'Search for &quot;'.esc_html($s).'&quot; - ';
} elseif ( !( is_404() ) && ( is_single() ) || ( is_page() ) ) {
	wp_title(''); echo ' - ';
} elseif ( is_404() ) {
	echo 'Not Found - ';
} elseif ( is_category() ) {
	echo 'Category : '; wp_title(''); echo ' - ';
} elseif ( is_archive() ) {
	wp_title(''); echo ' Archive - ';
} bloginfo('name');
?>
</title>
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
<?php if(isset($smof_data['tcsn_favicon']) != "" ) { ?>
<link rel="shortcut icon" href="<?php echo $smof_data['tcsn_favicon']; ?>">
<?php } ?>
<?php if(isset($smof_data['tcsn_favicon_iphone']) != "" ) { ?>
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $smof_data['tcsn_favicon_iphone']; ?>">
<?php } ?>
<?php if(isset($smof_data['tcsn_favicon_iphone_retina']) != "" ) { ?>
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $smof_data['tcsn_favicon_iphone_retina']; ?>">
<?php } ?>
<?php if( $smof_data['tcsn_favicon_ipad'] != "" ) { ?>
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $smof_data['tcsn_favicon_ipad']; ?>">
<?php } ?>
<?php if(isset($smof_data['tcsn_favicon_ipad_retina']) != "" ) { ?>
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $smof_data['tcsn_favicon_ipad_retina']; ?>">
<?php } ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<section id="header-wrapper" class="clearfix">
    <?php
			if( $smof_data['tcsn_layout_header'] ) {
				if( is_page( 'header-2' ) ) {
					get_template_part( 'includes/templates/headers/header-v2' );
				} elseif( is_page( 'header-3' ) ) {
					get_template_part( 'includes/templates/headers/header-v3' );
				} else {
					get_template_part( 'includes/templates/headers/header-'.$smof_data['tcsn_layout_header'] );
				}
			} else {
				if( is_page( 'header-2' ) ) {
					get_template_part( 'includes/templates/headers/header-v2' );
				} elseif( is_page( 'header-3' ) ) {
					get_template_part( 'includes/templates/headers/header-v3' );
				} else {
					get_template_part( 'includes/templates/headers/header-v1' );
				}
			}
			?>
</section>
<!-- #header-wrapper --> 
