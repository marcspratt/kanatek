<?php
/**
 * The Header variation 2
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
?>
<?php global $smof_data; ?>

<div id="header-v2" class="clearfix">
  <div id="header">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12 logo">
          <?php get_template_part( 'includes/templates/headers/logo' ); ?>
        </div>
        <!-- .logo -->
        
        <div class="col-md-8 col-sm-8 col-xs-12 clearfix">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 clearfix">
              <div class="call-number">
                <?php if(isset($smof_data['tcsn_show_phone_number'])) { if( $smof_data['tcsn_show_phone_number'] == 1 ) { ?>
                <?php echo $smof_data['tcsn_phone_number']; ?>
                <?php } } ?>
              </div>
              <?php if(isset($smof_data['tcsn_show_social_network'])) { if( $smof_data['tcsn_show_social_network'] == 1 ) { ?>
              <div class="header-wiget-area">
                <?php if ( is_active_sidebar( 'widget-header-social' ) ) : ?>
                <?php dynamic_sidebar( 'widget-header-social' ); ?>
                <?php else : ?>
                <div class="widget-alert">
                  <p>
                    <?php _e( 'To add social icons go to appearance > widgets', 'tcsn_theme' ); ?>
                  </p>
                  <p>
                    <?php _e( 'OR Disable through options panel.', 'tcsn_theme' ); ?>
                  </p>
                </div>
                <?php endif; ?>
              </div>
              <?php } } ?>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 clearfix">
              <?php get_template_part( 'includes/templates/headers/main-menu' ); ?>
            </div>
            <!-- #menu --> 
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- #header --> 
</div>
<!-- #header variation --> 