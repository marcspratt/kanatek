<?php
/**
 * Template Name: Home page
 *
 * The Template for displaying home page
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
 ?>
<?php get_header(); ?>
<?php global $smof_data; ?>

<?php get_template_part( 'includes/templates/sliders/slider' ); ?>
<section id="content" class="clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages', 'tcsn_theme' ) . '</span><div class="next-arrow"></div>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
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
