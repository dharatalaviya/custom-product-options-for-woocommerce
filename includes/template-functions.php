<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Templates Functions
 * 
 * Handles to manage templates of plugin
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */

/**
 * Returns the path to the WooCommerce - Custom Product Options for WooCommerce template directory
 *
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
function jem_cpow_get_templates_dir() {
	
	return apply_filters( 'jem_cpow_template_dir', JEM_CPOW_DIR . '/includes/templates/' );
}

/**
 * Get other templates 
 * 
 * (e.g.Custom Product Options for WooCommerce) passing attributes and including the file.
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
function jem_cpow_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {

	$plugin_absolute	= jem_cpow_get_templates_dir();

	if ( ! $template_path ) {
		$template_path = WC()->template_path();
	}

	wc_get_template( $template_name, $args, $template_path, $plugin_absolute );
}
