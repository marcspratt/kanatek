<?php
/**
 * File for registering custom post type - Pricing.
 *
 * @author    Tansh
 * @license   GPL-2.0+
 * @copyright 2014 Tansh
 *
 */
 
/**
 * Registers pricing post type
 *
 * @since  1.0.0
 */
add_action( 'init', 'tcsn_register_pricing_posttype' );
function tcsn_register_pricing_posttype() {
	$labels = array(
		'name'               => _x( 'Pricing', 'post type general name', 'tcsn_theme' ),
		'singular_name'      => _x( 'Pricing Column', 'post type singular name', 'tcsn_theme' ),
		'all_items'          => __( 'Pricing Columns', 'tcsn_theme' ),
		'add_new'            => __( 'Add New', 'tcsn-team' ),
		'add_new_item'       => __( 'Add New Pricing Column', 'tcsn_theme' ),
		'edit_item'          => __( 'Edit Pricing Column', 'tcsn_theme' ),
		'new_item'           => __( 'New Pricing Column', 'tcsn_theme' ),
		'view_item'          => __( 'View Pricing Column', 'tcsn_theme' ),
		'search_items'       => __( 'Search Pricing Column', 'tcsn_theme' ),
		'not_found'          => __( 'No Pricing Columns found', 'tcsn_theme' ),
		'not_found_in_trash' => __( 'No Pricing Columns found in Trash', 'tcsn_theme' ),
    );
	$args = array(
		'labels'          => $labels,
	    'public'          => true,  
        'show_ui'         => true,  
        'capability_type' => 'post',  
        'hierarchical'    => false,  
        'can_export'      => true,
        'has_archive'     => false,
		'menu_icon'       => 'dashicons-cart',
        'rewrite'         => array( 'slug' => 'pricing-column' ),
        'supports'        => array( 'title', 'editor', 'thumbnail'  ),
	);
	register_post_type( 'tcsn_pricing', $args );
}

/**
 * Register custom taxonomy for pricing items.
 *
 * @since  1.0.0
 */
add_action( 'init', 'tcsn_register_pricing_taxonomy' );
function tcsn_register_pricing_taxonomy() {
    $labels = array(
        'name'              => _x( 'Pricing Categories', 'taxonomy general name', 'tcsn_theme' ),
        'singular_name'     => _x( 'Pricing Category', 'taxonomy singular name', 'tcsn_theme' ),
        'search_items'      => __( 'Search Pricing Categories', 'tcsn_theme' ),
        'all_items'         => __( 'All Pricing Categories', 'tcsn_theme' ),
		'edit_item'         => __( 'Edit Pricing Category', 'tcsn_theme' ),
		'view_item'         => __( 'View Pricing Category', 'tcsn_theme' ),
        'parent_item'       => __( 'Parent Pricing Category', 'tcsn_theme' ),
        'parent_item_colon' => __( 'Parent Pricing Category:', 'tcsn_theme' ),
        'update_item'       => __( 'Update Pricing Category', 'tcsn_theme' ),
        'add_new_item'      => __( 'Add New Pricing Category', 'tcsn_theme' ),
        'new_item_name'     => __( 'New Pricing Category Name', 'tcsn_theme' ),
    );
    $args = array(
        'hierarchical' => true,
        'labels'       => $labels,
        'show_ui'      => true,
        'rewrite'      => array( 'slug' => 'Pricing-category' ),
    );
    register_taxonomy( 'tcsn_pricingtags', array( 'tcsn_pricing' ), $args );
}