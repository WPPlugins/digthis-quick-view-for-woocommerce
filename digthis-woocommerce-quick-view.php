<?php
/*
Plugin Name: Digthis Quick View For WooCommerce
Description: Adds quick view functionality to easily add Products
Plugin URI: http://#
Author: digamberpradhan
Author URI: https://profiles.wordpress.org/digamberpradhan
Version: 1.0.3
License: http://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );  // prevent direct access

if ( ! defined( 'DQVFW_FILE_PATH' ) ) {
	define( 'DQVFW_FILE_PATH', __FILE__ );
}

if ( ! function_exists( 'is_woocommerce_active' ) ) {
	require_once dirname( DQVFW_FILE_PATH ) . '/includes/woo-functions.php';
}

if ( is_woocommerce_active() ) {
	/* Ajax Handler */
	require_once dirname( DQVFW_FILE_PATH ) . '/includes/ajax.php';

	/*Main Class*/
	require_once dirname( DQVFW_FILE_PATH ) . '/class/digthis-quick-view.php';
}