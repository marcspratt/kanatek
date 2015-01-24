<?php
/**
 * The template for displaying portfolio details.
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
?>
<?php get_header(); ?>
<?php global $smof_data; ?>

<?php if( $smof_data['tcsn_show_page_header'] == 1 ) { ?>
<section id="page-header" class="clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h4 class="heading-icon clearfix">
                    <?php $show_icon = rwmb_meta('rw_show_icon', 'type=checkbox'); ?>
                    <?php $icon_url = rwmb_meta('rw_icon_url', 'type=text'); ?>
                    <?php if( $smof_data['tcsn_show_portfolio_icon'] == 1 ) { ?>
                    <img src="<?php echo get_template_directory_uri() . "/img/icons/heading-icon-listwithimg.png" ?>" width="40" height="40" alt="icon" class="icon-bg">
                    <?php } ?>
                    <?php echo the_title(); ?></h4>
            </div>
            <?php get_template_part( 'includes/templates/headers/page-header' ); ?>
        </div>
    </div>
</section>
<!-- #page-header -->
<?php } ?>

<section id="content" class="clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <div class="post-thumb">
                                <?php $portfolio_type = rwmb_meta('rw_portfolio_type', 'type=select');
									  $pf_video_embed = rwmb_meta('rw_pf_video_embed', 'type=textarea');
					 			?>
                                <?php 
					 	switch ($portfolio_type) {
						case 'Image': ?>
                                <div class="folio-thumb">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <?php break; // end image ?>
                                <?php case 'Video': ?>
                                <div class="video-wrapper"> <?php echo $pf_video_embed; ?> </div>
                                <?php break; // end video ?>
                                <?php default: ?>
                                <div class="folio-thumb">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <?php } //end switch ?>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <?php $pf_details = rwmb_meta('rw_pf_details', 'type=textarea'); ?>
                            <?php echo $pf_details; ?> </div>
                    </div>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- #content -->

<?php get_footer(); ?>
