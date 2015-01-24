<?php
/**
 * Template for displaying content for archive.
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 2.0.3
 */
?>
<?php 
if ( have_posts() ) : 
	while ( have_posts() ) : the_post(); 
  		get_template_part( '/includes/templates/post-formats/content', get_post_format() ); 
 	endwhile; 
 	tcsn_paging_nav(); 
else : 
	get_template_part( '/includes/templates/post-formats/content', 'none' ); 
endif; 