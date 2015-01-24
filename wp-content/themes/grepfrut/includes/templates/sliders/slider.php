<?php
/**
 * The Template for displaying slider on home page
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
?>
<?php global $smof_data; ?>
<?php $select_rev_slider = rwmb_meta('rw_select_rev_slider', 'type=select'); ?>
<?php if ( function_exists('putRevSlider') ) { ?>
<div id="slider-bg">
    <div class="container">
        <?php putRevSlider($select_rev_slider); ?>
    </div>
</div>
<!-- #slider-bg -->
<?php } ?>
