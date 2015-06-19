<?php
/**
 *
 * @package   PTE
 * @author    Tom McFarlin <tom@tommcfarlin.com?
 * @license   GPL-2.0+
 * @link      https://github.com/tommcfarlin/page-template-example
 * @copyright 2013 Tom McFarlin
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // end if

require_once( plugin_dir_path( __FILE__ ) . 'class-page-template.php' );
add_action( 'plugins_loaded', array( 'Page_Template_Plugin', 'get_instance' ) );