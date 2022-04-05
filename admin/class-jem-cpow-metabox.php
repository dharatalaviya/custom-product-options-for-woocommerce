<?php
/**
 * Represents a meta box to be displayed within the 'Add New Post' page.
 *
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
 namespace JEM_Extra_Product_Options\Admin;

// Exit if accessed directly
defined( 'ABSPATH' ) or die( 'Sorry!, You do not access the file directly' );



class Jem_Cpow_MetaBox {

	// Create Public Varible $metaboxes
	public $metaboxes = array();


	 /**
	  *
	  * Register Metabox in "JEM Product Options"
	  *
	  * @return
	  * @package Custom Product Options for WooCommerce
	  * @since 1.0.0
	  */
	public function register() {

		if ( empty( $this->metaboxes ) ) {
			return;
		}

		// Add Meta data fields
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ), 10 );

	}

	 /**
	  *
	  * Check Metabox Any Existing in "JEM Product Options"
	  *
	  * @return
	  * @package Custom Product Options for WooCommerce
	  * @since 1.0.0
	  */
	public function addMetaBoxes( array $metaboxes ) {

		if ( empty( $metaboxes ) ) {
			return;
		}

		$this->metaboxes = $metaboxes;

		return $this;
	}

	 /**
	  *
	  * Add Metabox in "JEM Product Options"
	  *
	  * @return
	  * @package Custom Product Options for WooCommerce
	  * @since 1.0.0
	  */
	function add_meta_box() {

		foreach ( $this->metaboxes as $metabox ) {

			add_meta_box(
				$metabox['id'],
				$metabox['title'],
				$metabox['callback'],
				$metabox['screen'],
				$metabox['context'],
				$metabox['priority']
			);
		}
	}
}
