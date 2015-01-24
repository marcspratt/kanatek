<?php
/**
 * The content of header bottom 
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
?>
<?php global $smof_data; ?>
<?php  if(isset($smof_data['tcsn_show_breadcrumb_search'])) { if ( $smof_data['tcsn_show_breadcrumb_search'] == 'breadcrumb' ) : ?>

<div class="col-md-6 col-sm-6 col-xs-12">
    <ul class="breadcrumbs">
        <?php if(function_exists('bcn_display_list'))
    {
        bcn_display_list();
    }?>
    </ul>
</div>
<?php elseif ( $smof_data['tcsn_show_breadcrumb_search'] == 'search' ) : ?>
<div class="col-md-3 col-sm-6 col-xs-12 col-md-offset-3">
    <?php get_search_form(); ?>
</div>
<?php else : // leave blank  ?>
<?php endif ?>
<?php } ?>
