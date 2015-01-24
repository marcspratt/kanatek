<?php
/**
 * The Template for displaying slider on gallery post
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */
?>
<?php global $smof_data; ?>
<?php $select_gallery_rev_slider = rwmb_meta('rw_select_gallery_rev_slider', 'type=select'); ?>
<?php if ( function_exists('putRevSlider') ) { ?>
<?php putRevSlider($select_gallery_rev_slider); ?>
<?php } ?>
