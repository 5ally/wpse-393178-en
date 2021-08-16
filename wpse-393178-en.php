<?php
/**
 * Plugin Name: WPSE 393178 EN
 * Plugin URI: https://wordpress.stackexchange.com/a/393178
 * Description: Setting locale before retrieving gettext translations using <code>switch_to_locale()</code> :)
 * Author: Sally CJ
 * Version: 1.0
 * Text Domain: wpse-393178-en
 * Domain Path: /languages
 */

add_action( 'init', 'wpse_393178_en_load_textdomain' );
function wpse_393178_en_load_textdomain() {
	load_plugin_textdomain( 'wpse-393178-en', false,
		dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

if ( is_admin() ) {
	require_once __DIR__ . '/class-wpse-393178-en-admin.php';
	new WPSE_393178_EN_Admin();
}
