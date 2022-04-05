<?php
/**
 * Defines the functionality required to callbacks the content Help Page
 * to which this display belongs.
 *
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
 namespace JEM_Extra_Product_Options\Admin\Callbacks;

// Exit if accessed directly
defined( 'ABSPATH' ) or die( 'Sorry!, You do not access the file directly' );


class Jem_Cpow_Admin_Help{

	function callbacks(){
		echo '<h2>Help</h2>';
	}

}