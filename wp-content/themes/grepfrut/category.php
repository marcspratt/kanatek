<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
?>
<?php get_header(); ?>
<?php global $smof_data; ?>
<?php  if(isset($smof_data['tcsn_show_page_header'])) {
	if( $smof_data['tcsn_show_page_header'] == 1 ) { ?>

<section id="page-header" class="clearfix">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <h4 class="heading-icon">
          <?php if( $smof_data['tcsn_show_archives_icon'] == 1 ) { ?>
          <img src="<?php echo get_template_directory_uri() . "/img/icons/heading-icon-blocks.png" ?>" width="40" height="40" alt="icon" class="icon-bg">
          <?php } ?>
          <?php printf( __( 'Category Archives : %s', 'tcsn_theme' ), single_cat_title( '', false ) ); ?></h4>
      </div>
      <?php get_template_part( 'includes/templates/headers/page-header' ); ?>
    </div>
  </div>
</section>
<!-- #page-header -->
<?php } } ?>
<section id="content" class="clearfix">
  <div class="container">
    <div class="row">
      <?php get_template_part( '/includes/templates/post-formats/content', 'main' ); ?>
    </div>
  </div>
</section>
<!-- #content -->

<?php get_footer(); ?>
