<?php
/**
 * Plugin Name: Remove WP Engine Bot 404
 * Plugin URI: http://wordpress.org/plugins/remove-wp-engine-404-for-bots/
 * Description: WP Engine has a custom 404 page for bots. This plugin removes that customization.
 * Version: 1.0
 * Author: Jeremy Pry
 * Author URI: http://jeremypry.com/
 * License: GPL2
 */

// Prevent direct access to this file
if ( ! defined( 'ABSPATH' ) ) {
	die( "You can't do anything by accessing this file directly." );
}

// Exit if the WpeCommon class does not exist
if ( ! class_exists( 'WpeCommon', false ) ) {
	return;
}

// Add our hook after plugins have been loaded
add_action( 'plugins_loaded', 'jpry_remove_wpe_404', 20 );

/**
 * Remove the custom 404 that WP Engine serves to Bots
 *
 * @since 1.0
 *
 * @see WpeCommon::wp_hook_init()
 */
function jpry_remove_wpe_404() {

	// Technically we already know that the WpeCommon class exists, but we're checking again just to be safe
	if ( class_exists( 'WpeCommon', false ) ) {

		// Grab the WpeCommon instance
		$wpe_common = WpeCommon::instance();

		// Remove the hook from all possible places
		remove_action( 'bp_init',		array( $wpe_common, 'is_404' ), 99999 );
		remove_action( 'bbp_init',		array( $wpe_common, 'is_404' ), 99999 );
		remove_action( 'template_redirect',	array( $wpe_common, 'is_404' ), 99999 );
	}
}
