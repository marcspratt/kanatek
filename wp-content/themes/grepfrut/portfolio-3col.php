<?php
/**
 * Template Name: Portfolio - 3 Column
 *
 * The Template for displaying 3 column portfolio
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
          <?php if ( $show_icon == 1 ) { ?>
          <img src="<?php echo $icon_url; ?>" width="40" height="40" alt="icon" class="icon-bg">
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
        <?php if( $smof_data['tcsn_portfolio_filter'] == 1 ) { ?>
        <?php
						$terms = get_terms("tcsn_portfoliotags");
						$count = count($terms);
						echo '<ul class="filter_nav clearfix">';
						echo '<li><a class="active" href="#" data-filter="*">All</a></li>';
							if ($count > 0) {
    							foreach ($terms as $term) {
        							$termname = strtolower($term->name);
        							$termname = str_replace(' ', '-', $termname);
        							echo '<li><a href="#" title="" data-filter=".' . $termname . '">' . $term->name . '</a></li>';
    							}
							}
						echo "</ul>"; ?>
        <?php } ?>
      </div>
      <!-- portfolio filter ends-->
      
      <?php 
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$loop = new WP_Query( array(
				'post_type'      => 'tcsn_portfolio',
				'posts_per_page' => ( $smof_data['tcsn_portfolio_items_per_page'] ?  $smof_data['tcsn_portfolio_items_per_page'] : 9),
				'paged' => $paged,
				'order' => 'DESC',   // DESC or ASC 
				'orderby' => 'date',
				) );
			?>
      <div id="items" class="filter-content">
        <?php if ($loop): while ($loop->have_posts()): $loop->the_post(); ?>
        <?php
					$terms = get_the_terms($post->ID, 'tcsn_portfoliotags');
					if ($terms && !is_wp_error($terms)):
						$links = array();
					foreach ($terms as $term) {
						$links[] = $term->name;
					}
					$links = str_replace(' ', '-', $links);
					$tax   = join(" ", $links);
					else:
					$tax = ''; ?>
        <?php endif; ?>
        <div class="col-md-4 col-sm-4 col-xs-12 isotope-item <?php echo strtolower($tax); ?> all">
          <?php 
						$lightbox_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); 
						$portfolio_type = rwmb_meta('rw_portfolio_type', 'type=select');
						$video_url = rwmb_meta('rw_video_url', 'type=text');
						$external_link= rwmb_meta('rw_external_link', 'type=checkbox'); 
						$link_url = rwmb_meta('rw_link_url', 'type=text'); 
						$zoom_title = rwmb_meta('rw_zoom_title', 'type=text'); 
					 ?>
          <?php 
					 	switch ($portfolio_type) {
						case 'Image': ?>
          <div class="folio-thumb"> <a href="<?php echo $lightbox_image_url[0];?>" rel="prettyPhoto[gallery]" class="icon-zoom-img" title="<?php echo $zoom_title; ?>"></a>
            <?php if ( $external_link == 1 ) { ?>
            <a href="<?php echo $link_url; ?>" class="icon-link-img"></a>
            <?php } else { ?>
            <a href="<?php the_permalink(); ?>" class="icon-link-img"></a>
            <?php } ?>
            <?php the_post_thumbnail(); ?>
          </div>
          <?php break; // end image ?>
          <?php case 'Video': ?>
          <div class="folio-thumb"> <a href="<?php echo $video_url; ?>" rel="prettyPhoto[gallery]" class="icon-zoom-img" title="<?php echo $zoom_title; ?>"></a>
            <?php if ( $external_link == 1 ) { ?>
            <a href="<?php echo $link_url; ?>" class="icon-link-img"></a>
            <?php } else { ?>
            <a href="<?php the_permalink(); ?>" class="icon-link-img"></a>
            <?php } ?>
            <?php the_post_thumbnail(); ?>
          </div>
          <?php break; // end video ?>
          <?php default: ?>
          <div class="folio-thumb"> <a href="<?php echo $lightbox_image_url[0];?>" rel="prettyPhoto[gallery]" class="icon-zoom-img" title="<?php echo $zoom_title; ?>"></a>
            <?php if ( $external_link == 1 ) { ?>
            <a href="<?php echo $link_url; ?>" class="icon-link-img"></a>
            <?php } else { ?>
            <a href="<?php the_permalink(); ?>" class="icon-link-img"></a>
            <?php } ?>
            <?php the_post_thumbnail(); ?>
          </div>
          <?php } //end switch ?>
          <?php if( $smof_data['tcsn_portfolio_heading'] == 1 ) { ?>
          <h5 class="folio-title"><a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
            </a></h5>
          <?php } ?>
          <?php if( $smof_data['tcsn_portfolio_excerpt'] == 1 ) { ?>
          <div class="folio-excerpt clearfix">
            <?php the_excerpt(); ?>
          </div>
          <?php } ?>
          <div class="clearfix"></div>
        </div>
        <?php endwhile;?>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 clearfix">
        <?php tcsn_pagination($loop->max_num_pages, $range = 2); ?>
      </div>
    </div>
  </div>
</section>
<!-- #content -->

<?php get_footer(); ?>
