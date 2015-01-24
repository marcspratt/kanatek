<?php
/**
 * The main template file.
 *
 * This is the most generic and required template file.
 * Displays a page when nothing more specific matches a query.
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
        <?php if ( ! is_page() ) : ?>
        <?php if( $smof_data['tcsn_blog_title'] != "" ) { ?>
        <h4 class="heading-icon">
          <?php if( $smof_data['tcsn_show_blog_icon'] == 1 ) { ?>
          <img src="<?php echo get_template_directory_uri() . "/img/icons/heading-icon-listwithimg.png" ?>" width="40" height="40" alt="icon" class="icon-bg">
          <?php } ?>
          <?php echo $smof_data['tcsn_blog_title']; ?></h4>
        <?php } ?>
        <?php else : ?>
        <h4 class="heading-icon clearfix">
          <?php $show_icon = rwmb_meta('rw_show_icon', 'type=checkbox'); ?>
          <?php $icon_url = rwmb_meta('rw_icon_url', 'type=text'); ?>
          <?php if ( $show_icon == 1 ) { ?>
          <img src="<?php echo $icon_url; ?>" width="40" height="40" alt="icon" class="icon-bg">
          <?php } ?>
          <?php echo the_title(); ?></h4>
        <?php endif ?>
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
