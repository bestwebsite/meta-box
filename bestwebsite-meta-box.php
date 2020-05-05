<?php
/**
 * Plugin Name: Bestwebsite Meta Box
 * Plugin URI:  https://github.com/Bestwebsite/meta-box
 * Description: Create custom meta boxes and custom fields in WordPress.
 * Version:     1.0
 * Author:      Bestwebsite
 * Author URI:  https://Bestwebsite.com
 *
 * 
 */

if ( defined( 'ABSPATH' ) && ! defined( 'Bestwebsite_VER' ) ) {
	register_activation_hook( __FILE__, 'Bestwebsite_check_php_version' );

	/**
	 * Display notice for old PHP version.
	 */
	function Bestwebsite_check_php_version() {
		if ( version_compare( phpversion(), '5.3', '<' ) ) {
			die( esc_html__( 'Meta Box requires PHP version 5.3+. Please contact your host to upgrade.', 'meta-box' ) );
		}
	}

	require_once dirname( __FILE__ ) . '/inc/loader.php';
	$Bestwebsite_loader = new Bestwebsite_Loader();
	$Bestwebsite_loader->init();
}
