<?php
/**
 * The template for displaying posts in the Aside post format.
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1 class="post-title entry-title no-display"></h1>
    <div class="post-meta">
        <?php if ( is_single() ) : ?>
        <?php tcsn_post_meta(); ?>
        <?php else : ?>
        <?php tcsn_post_date(); ?>
        <?php endif; ?>
        <?php if ( comments_open() && ! is_single() && ! is_page() ) : ?>
        <span>
        <span class="text-sep">/</span>
        <?php comments_popup_link( '<span class="leave-comment">' . __( 'No Comments', 'tcsn_theme' ) . '</span>', __( 'One comment', 'tcsn_theme' ), __( '% comments', 'tcsn_theme' ) ); ?>
        </span>
        <?php endif; ?>
    </div>
    <div class="post-content">
        <?php the_content(); ?>
    </div>
    <div class="post-author">
        <?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
        <?php get_template_part( '/includes/templates/post-formats/author-bio' ); ?>
        <?php endif; ?>
    </div>
    <div class="post-footer"></div>
</article>
<!-- #post --> 
