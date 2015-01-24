<?php
/**
 * The template for displaying posts in the Gallery post format.
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( is_single() ) : ?>
    
    <h1 class="post-title entry-title">
        <?php the_title(); ?>
    </h1>
    <?php elseif ( is_page() ) : ?>
    <h1 class="post-title entry-title no-display"></h1>
    <?php else : ?>
    <h1 class="post-title entry-title"> <a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title(); ?>
        </a></h1>
    <?php endif; ?>
    <div class="post-meta">
        <?php tcsn_post_meta(); ?>
        <?php if ( comments_open() && ! is_single() && ! is_page() ) : ?>
        <span>
        <span class="text-sep">/</span>
        <?php comments_popup_link( '<span class="leave-comment">' . __( 'No Comments', 'tcsn_theme' ) . '</span>', __( 'One comment', 'tcsn_theme' ), __( '% comments', 'tcsn_theme' ) ); ?>
        </span>
        <?php endif; ?>
    </div>
    <div class="post-gallery">
        <?php get_template_part( 'includes/templates/sliders/slider-gallery' ); ?>
    </div>
    <?php if ( ! is_single() && ! is_page() ) : ?>
    <div class="post-summary">
        <?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>" class="read-more-link">
        <?php  _e('Continue Reading', 'tcsn_theme'); ?>
        &raquo;</a> </div>
    <?php else : ?>
    <div class="post-content">
        <?php the_content(); ?>
    </div>
    <?php endif; ?>
    <div class="post-author">
        <?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
        <?php get_template_part( '/includes/templates/post-formats/author-bio' ); ?>
        <?php endif; ?>
    </div>
    <div class="post-footer"></div>
</article>
<!-- #post -->