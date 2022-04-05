<?php
/**
 * Represents admin pages to be displayed within the 'Add New Post' page.
 *
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
 namespace JEM_Extra_Product_Options\Admin;

// Exit if accessed directly
defined( 'ABSPATH' ) or die( 'Sorry!, You do not access the file directly' );



class Jem_Cpow_Menu{

	// Create Public Varible $pages
	public $pages = array();

	// Create Public Varible $subpages
	public $subpages = array();

	 /**
	  *
	  * Register Metabox in "JEM Product Options"
	  *
	  * @return
	  * @package Custom Product Options for WooCommerce
	  * @since 1.0.0
	  */
	public function register() {

		if ( empty( $this->pages ) ) {
			return;
		}

		// Add submenu in WooCommerce Menu
		add_action( 'admin_menu', array( $this, 'add_menu_pages' ), 10 );

	

	}

	 /**
	  *
	  * Check Metabox Any Existing in "JEM Product Options"
	  *
	  * @return
	  * @package Custom Product Options for WooCommerce
	  * @since 1.0.0
	  */
	public function add_pages( array $pages ) {

		if ( empty( $pages ) ) {
			return;
		}

		$this->pages = $pages;

		return $this;
	}

	 /**
	  *
	  * Check Metabox Any Existing in "JEM Product Options"
	  *
	  * @return
	  * @package Custom Product Options for WooCommerce
	  * @since 1.0.0
	  */
	public function add_subpages( array $subpages ) {

		if ( empty( $subpages ) ) {
			return;
		}

		$this->subpages = $subpages;

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
	function add_menu_pages() {
		
		foreach ( $this->pages as $page ) {
			add_menu_page(
				$page['page_title'],
				$page['menu_title'],
				$page['capability'],
				$page['menu_slug'],
				$page['function'],
				$page['icon_url'],
				$page['position']
			);
		}

		foreach ( $this->subpages as $page ) {
			add_submenu_page(
				$page['parent_slug'],
				$page['page_title'],
				$page['menu_title'],
				$page['capability'],
				$page['menu_slug'],
				$page['function'],
				$page['position']
			);
		}
	}
}
