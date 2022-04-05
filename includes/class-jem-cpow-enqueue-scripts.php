<?php
/**
 * Enqueue Scripts Class - Frontend Main Class
 *
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
 namespace JEM_Extra_Product_Options\Includes;

 use JEM_Extra_Product_Options\Includes;

// Exit if accessed directly
defined( 'ABSPATH' ) or die( 'Sorry!, You do not access the file directly' );


class Jem_Cpow_Enqueue_Scripts extends Jem_Cpow_Public{


	 /**
	  * Scripts and Style Register and Enqueue
	  *
	  * @return
	  * @package Custom Product Options for WooCommerce
	  * @since 1.0.0
	  */
	public function jem_frontend_enqueue_scripts() {
		// Register Froont End Page
		wp_register_style( 'jem-cpow-woo-style', JEM_CPOW_ASSETS_URL . 'css/jem-style.css', '', '1.0.0', 'all' );
		wp_enqueue_style( 'jem-cpow-woo-style' );

		// Date Picker
		wp_enqueue_script( 'jquery-ui-datepicker' );

		// Register Jquery theme
		wp_register_style( 'jem-e2b-admin-ui-css', JEM_CPOW_ASSETS_URL . 'css/jquery-ui.css', '', '1.0.0', 'all' );
		wp_enqueue_style( 'jem-e2b-admin-ui-css' );

		// Register Color Picker theme
		wp_register_script( 'jem-color-picker', JEM_CPOW_ASSETS_URL . 'js/jscolor.js', array( 'jquery' ), '1.0.0', false );
		wp_enqueue_script( 'jem-color-picker' );        // required for color field

		// Register Ajax Script
		wp_register_script( 'jem-ajax', JEM_CPOW_ASSETS_URL . 'js/jem-ajax.js', array( 'jquery' ), '1.0.0', false );
		wp_enqueue_script( 'jem-ajax' );                // add custom js in frontend

		wp_localize_script( 'jem-ajax', 'jem', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

		// Validation JS (validatejs.org)
		wp_register_script( 'jem-validation-min', JEM_CPOW_ASSETS_URL . 'js/jquery.validate.min.js', array( 'jquery' ), '1.0.0', false );
		wp_enqueue_script( 'jem-validation-min' );        // required for validate field

		// JEM CPOW Validation JS 
		wp_register_script( 'jem-cpow-cutsom-validation', JEM_CPOW_ASSETS_URL . 'js/jem-cpow-validation.js', array( 'jquery', 'jem-validation-min' ), '1.0.0', false );
		wp_enqueue_script( 'jem-cpow-cutsom-validation' );        // required for validatation field

		$validations_fields = self::jem_cpow_validations_fields();
		wp_localize_script( 'jem-cpow-cutsom-validation', 'jem', array('cutsomValidationFields' => $validations_fields) );

	}



	/**
	 * All WordPress Hooks Run by this method
	 *
	 * @return
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public function init_hooks() {

		// Register and enqueue scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'jem_frontend_enqueue_scripts' ) );

	}

}
