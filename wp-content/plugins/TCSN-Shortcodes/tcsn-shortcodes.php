<?php
/**
 * TCSN Shortcodes
 *
 * @package   TCSN_Shortcodes
 * @author    Tansh
 * @license   GPL-2.0+
 * @copyright 2013 Tansh
 *
 * @wordpress-plugin
 * Plugin Name: TCSN Shortcodes
 * Description: Creates Shortcodes
 * Version:     1.1.0
 * Author:      Tansh
 * Author URI:  http://themeforest.net/user/tansh
 * Text Domain: tcsn-shortcodes
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /lang
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( plugin_dir_path( __FILE__ ) . 'class-tcsn-shortcodes.php' );

TCSN_Shortcodes::get_instance();