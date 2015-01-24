<?php
/**
 * The Main Menu
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
?>
<?php 
if( has_nav_menu( 'primary_menu' ) ) {
wp_nav_menu( array( 
	'theme_location'  => 'primary_menu',
	'container'       => 'div',
	'container_class' => 'ddsmoothmenu',
	'container_id'    => 'smoothmenu',
	'menu_id'         => 'nav',
	'depth'           => 0,
	) 
); 
}