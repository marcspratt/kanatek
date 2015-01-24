<?php
/**
 * Template Name: Page - Fullwidth without Page Header
 *
 * The template for displaying full width pages with no page header.
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
?>
<?php get_header(); ?>
<?php global $smof_data; ?>

<section id="content" class="clearfix">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="entry-content">
            <?php the_content(); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'tcsn_theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
          </div>
        </article>
        <?php if( $smof_data['tcsn_page_comments'] == 1 ) { ?>
        <?php comments_template(); ?>
        <?php } ?>
        <?php endwhile; endif; ?>
      </div>
    </div>
  </div>
</section>
<!-- #content -->

<?php get_footer(); ?>
