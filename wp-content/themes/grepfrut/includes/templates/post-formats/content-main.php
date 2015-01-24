<?php
/**
 * The default template for displaying archive content. 
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
?>
<?php global $smof_data; ?>
<?php if ( $smof_data['tcsn_blog_layout'] == 'full-width' ) : ?>

<div class="col-md-12 col-sm-12">
  <?php get_template_part( '/includes/templates/post-formats/archive', 'content' ); ?>
</div>
<?php elseif ( $smof_data['tcsn_blog_layout'] == 'with-sidebar' ) : ?>
<?php if ( $smof_data['tcsn_blog_sidebar'] == 'sidebar-left' ) { ?>
<?php get_sidebar(); ?>
<?php } ?>
<div class="col-md-8 col-sm-8">
  <?php get_template_part( '/includes/templates/post-formats/archive', 'content' ); ?>
</div>
<?php if ( $smof_data['tcsn_blog_sidebar'] == 'sidebar-right' ) { ?>
<?php get_sidebar(); ?>
<?php } ?>
<?php else : ?>
<div class="col-md-8 col-sm-8">
  <?php get_template_part( '/includes/templates/post-formats/archive', 'content' ); ?>
</div>
<?php get_sidebar(); ?>
<?php endif ?>