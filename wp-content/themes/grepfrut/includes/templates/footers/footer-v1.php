<?php
/**
 * The Footer variation 1
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
?>
<?php global $smof_data; ?>

<div class="col-md-2 col-sm-2 col-xs-12">
    <div class="footer-wiget-area clearfix">
        <?php if ( is_active_sidebar( 'widget-footer-social' ) ) : ?>
        <?php dynamic_sidebar( 'widget-footer-social' ); ?>
        <?php else : ?>
        <div class="widget-alert">
            <p>
                <?php _e( 'No widget! Activate footer Social Network Widget.', 'tcsn_theme' ); ?>
            </p>
            <p>
                <?php _e( 'OR Place logo through text widget.', 'tcsn_theme' ); ?>
            </p>
            <p>
                <?php _e( 'OR Disable through options panel.', 'tcsn_theme' ); ?>
            </p>
        </div>
        <?php endif; ?>
    </div>
</div>
<div class="col-md-2 col-sm-2 col-xs-12 text-center"> Follow on Twitter
    <?php if( $smof_data['tcsn_twitter_username'] != "" ) { ?>
    <h5><?php echo $smof_data['tcsn_twitter_username']; ?></h5>
    <?php } ?>
</div>
<div class="col-md-8 col-sm-8 col-xs-12">
    <div class="twitter-box">
        <?php if ( is_active_sidebar( 'widget-twitter-feed' ) ) : ?>
        <?php dynamic_sidebar( 'widget-twitter-feed' ); ?>
        <?php else : ?>
        <div class="widget-alert">
            <p>
                <?php _e("Twitter feed Widget not activated yet!","tcsn_theme"); ?>
            </p>
        </div>
        <?php endif; ?>
    </div>
</div>
