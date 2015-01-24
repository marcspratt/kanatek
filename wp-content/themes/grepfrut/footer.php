<?php
/**
 * The Footer for theme.
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
?>
<?php global $smof_data; ?>

<footer id="footer" class="clearfix">
  <div class="container">
    <?php if(isset($smof_data['tcsn_show_social_row'])) {
			if( $smof_data['tcsn_show_social_row'] == 1 ) { ?>
    <div class="row">
      <?php if(isset($smof_data['tcsn_show_footer_social'])) {
		  		if( $smof_data['tcsn_show_footer_social'] == 1 ) {
				get_template_part( 'includes/templates/footers/footer-v1' );
			} else {
				get_template_part( 'includes/templates/footers/footer-v2' );
			} ?>
    </div>
    <?php } } } ?>
    <div class="row">
      <?php
	  		if(isset($smof_data['tcsn_columns_footer'])) {
				$footer_columns = $smof_data['tcsn_columns_footer'];
				switch ($footer_columns) {
				case 1:
					$class = 'col-md-12 col-sm-12 col-xs-12';
					break;
				
				case 2:
					$class = 'col-md-6 col-sm-6 col-xs-12';
					break;
				
				case 3:
					$class = 'col-md-4 col-sm-4 col-xs-12';
					break;
				
				case 4:
					$class = 'col-md-3 col-sm-3 col-xs-12';
					break;
				}
				
				for ($i = 1; $i <= $footer_columns; $i++) {
					echo "<div class='$class'>";
					if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer - column - ' . $i)):
					endif;
					echo "</div>";
				}
			}
			?>
    </div>
  </div>
</footer>
<!-- #footer -->

<section id="copyright" class="clearfix">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 clearfix">
        <p>
          <?php if(isset($smof_data['tcsn_copyright'])) {
						if ( $smof_data['tcsn_copyright'] != "" ) { ?>
          <?php echo $smof_data['tcsn_copyright']; ?>
          <?php } } else { ?>
          &copy; Copyright
          <?php
						echo date("Y");
						echo " ";
						bloginfo('name');
					} ?>
        </p>
        <?php if(isset($smof_data['tcsn_show_secondary_menu'])) {
					if( $smof_data['tcsn_show_secondary_menu'] == 1 ) { ?>
        <?php if( has_nav_menu( 'secondary_menu' ) ) { wp_nav_menu( array( 
					'theme_location'  => 'secondary_menu',
					'container'       => 'div',
					'container_class' => 'copyright-menu',
					'depth'           => -1,
					) ); ?>
        <?php } } } ?>
        <!-- .copyright menu --> 
        
      </div>
    </div>
  </div>
</section>
<!-- #copyright -->
<?php if(isset($smof_data['tcsn_tracking']) != "" ) { echo $smof_data['tcsn_tracking']; } ?>
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<?php wp_footer(); ?>
</body></html>