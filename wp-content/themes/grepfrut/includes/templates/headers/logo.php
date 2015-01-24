<?php
/**
 * The Logo
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 2.0.3
 */
?>
<?php 
global $smof_data;
$site_url = esc_url( home_url( '/' ) );
$logo_text ='';
$logo_image ='';
if(isset($smof_data['tcsn_text_logo'])) {$logo_text = $smof_data['tcsn_text_logo'];}
if(isset($smof_data['tcsn_image_logo'])) {$logo_image = $smof_data['tcsn_image_logo'];}
?>
<?php if( ( $smof_data['tcsn_logo_type'] == "tcsn_show_image_logo" ) ) : ?>
<a href="<?php echo $site_url; ?>" title="<?php echo bloginfo('title'); ?>"><img src="<?php echo $logo_image ?>" alt="<?php echo bloginfo('title'); ?>"></a>
<?php elseif( ( $smof_data['tcsn_logo_type'] == "tcsn_show_text_logo" ) ) : ?>
<a href="<?php echo $site_url; ?>" title="<?php echo bloginfo('title'); ?>"><?php echo $logo_text ?></a>
<?php else : ?>
<img src="<?php echo get_template_directory_uri() . "/img/logo.png" ?>" alt="<?php echo bloginfo('title'); ?>">
<?php endif; ?>