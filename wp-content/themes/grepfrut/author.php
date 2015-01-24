<?php
/**
 * The template for displaying Author Archive pages.
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
        <?php the_post(); ?>
        <h4 class="heading-icon">
          <?php if( $smof_data['tcsn_show_archives_icon'] == 1 ) { ?>
          <img src="<?php echo get_template_directory_uri() . "/img/icons/heading-icon-user.png" ?>" width="40" height="40" alt="icon" class="icon-bg">
          <?php } ?>
          <?php printf( __( 'All posts by %s', 'tcsn_theme' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h4>
        <?php rewind_posts(); ?>
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
