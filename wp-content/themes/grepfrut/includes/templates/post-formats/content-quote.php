<?php
/**
 * The template for displaying posts in the Quote post format.
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 <h1 class="post-title entry-title"> <a href="<?php the_permalink(); ?>" rel="bookmark" class="no-display"><?php the_title(); ?></a></h1>
    <div class="post-meta">
        <?php tcsn_post_meta(); ?>
        <?php if ( comments_open() && ! is_single() && ! is_page() ) :?>
        <span>
        <span class="text-sep">/</span>
        <?php comments_popup_link( '<span class="leave-comment">' . __( 'No Comments', 'tcsn_theme' ) . '</span>', __( 'One comment', 'tcsn_theme' ), __( '% comments', 'tcsn_theme' ) ); ?>
        </span>
        <?php endif; ?>
    </div>
    <div class="post-quote">
        <blockquote><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'tcsn_theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
            <?php the_content(); ?>
            </a> <span class="quote-source"><a href="<?php echo get_post_meta($post->ID, '_format_quote_source_url', true); ?>" target="_blank"><?php echo get_post_meta($post->ID, '_format_quote_source_name', true); ?></a></span> </blockquote>
    </div>
    <!--<div class="post-content">
        <?php // if ( is_single() ) : ?>
        <?php // the_content(); ?>
        <?php // else : ?>
        <a href="<?php // the_permalink(); ?>"><?php // the_content(); ?></a>
        <?php // endif; ?>
    </div>-->
    <div class="post-author">
        <?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
        <?php get_template_part( '/includes/templates/post-formats/author-bio' ); ?>
        <?php endif; ?>
    </div>
    <div class="post-footer"></div>
</article>
<!-- #post -->