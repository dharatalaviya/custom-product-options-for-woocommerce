<?php
/**
 * Provides a consistent way to enqueue all administrative-related stylsheets.
 */

namespace JEM_Extra_Product_Options\Admin\Util;

/**
 * Provides a consistent way to enqueue all administrative-related stylsheets.
 *
 * Implements the Assets_Interface by defining the init function and the
 * enqueue function.
 *
 * The first is responsible for hooking up the enqueue
 * callback to the proper WordPress hook. The second is responsible for
 * actually registering and enqueueing the file.
 *
 * @implements Assets_Interface
 * @since      0.2.0
 */
class Jem_Cpow_Admin_CSS_Loader implements Assets_Interface {



	 /**
	  * Admin Script and Style Register and Enqueue
	  *
	  * @return
	  * @package Custom Product Options for WooCommerce
	  * @since 1.0.0
	  */
	public function jem_cpow_admin_enqueue_scripts() {
		// Get the current screen!
		$screen = get_current_screen();

		global $post;

		// Only enqueue if we are on our custom post type screen
		// This avoids loading this all over WordPress!!!
		if ( $screen->post_type == 'shop_order' ) {
			// Register Admin Custom Script
			wp_register_script( 'jempa-spow-admin-order-script', JEM_CPOW_ADMIN_URL . '/assets/js/jem-admin-order-custom-script.js', array( 'jquery' ), '1.0.0', false );

			// Enqueue Script;
			wp_enqueue_script( 'jempa-spow-admin-order-script' );
		}
		if ( 'jempa_field_group' === $screen->post_type ) {

				// Register Bootstrap CSS Style
			wp_register_style( 'jempa-cpow-admin-bootstrap-css', JEM_CPOW_ADMIN_URL . '/assets/css/bootstrap.min.css', '', '1.0.0', 'all' );
			// Enqueue Bootstrap CSS
			wp_enqueue_style( 'jempa-cpow-admin-bootstrap-css' );

			// Register Fontawesome CSS
			wp_register_style( 'jempa-cpow-admin-font-awesome', JEM_CPOW_ADMIN_URL . '/assets/css/font-awesome.css', '', '1.0.0', 'all' );
			// Enqueue Font Awrsome Css
			wp_enqueue_style( 'jempa-cpow-admin-font-awesome' );

			// Register Selectbox CSS
			wp_register_style( 'jempa-cpow-admin-select2-style', JEM_CPOW_ADMIN_URL . '/assets/css/select2.min.css', '', '1.0.0', 'all' );
			wp_enqueue_style( 'jempa-cpow-admin-select2-style' );

			// Enqueue Editor JS
			wp_enqueue_editor();

			// Register Selectbox JS
			wp_register_script( 'jempa-spow-admin-scriptselect2_script', JEM_CPOW_ADMIN_URL . '/assets/js/select2.min.js', array( 'jquery' ), '1.0.0', false );
			wp_enqueue_script( 'jempa-spow-admin-scriptselect2_script' );

			// Register Bootstrap & plugin JS
			wp_register_script( 'jempa-spow-admin-boostrap-script', JEM_CPOW_ADMIN_URL . '/assets/js/bootstrap.min.js', array( 'jquery' ), '1.0.0', false );
			wp_enqueue_script( 'jempa-spow-admin-boostrap-script' );

			// Register Custom Script
			wp_register_script( 'jempa-spow-admin-jempa-field-group-scripts', JEM_CPOW_ADMIN_URL . '/assets/js/admin-jempa-field-group-scripts.js', array( 'jquery' ), '1.0.0', false );

			wp_enqueue_script( 'jempa-spow-admin-jempa-field-group-scripts' );

			wp_localize_script( 'jempa-spow-admin-jempa-field-group-scripts', 'fields_conditions', get_fields_conditions() );

			 wp_enqueue_style( 'jquery-ui-datepicker-style' , '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css');

			// Register Base CSS Style
			wp_register_style( 'jempa-cpow-admin-custom-css', JEM_CPOW_ADMIN_URL . '/assets/css/jem-custom-style.css', '', '1.0.0', 'all' );

			wp_register_script( 'jem-color-picker', JEM_CPOW_ASSETS_URL . 'js/jscolor.js', array( 'jquery' ), '1.0.0', false );			
			// Enqueue JS
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-draggable' );
			wp_enqueue_script( 'jquery-ui-droppable' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_style( 'wp-color-picker' ); 
     		wp_enqueue_script( 'wp-color-picker');
			// Enqueue Style
			//wp_enqueue_script( 'jem-color-picker' );
			wp_enqueue_style( 'jempa-cpow-admin-custom-css' );

		
		}
	}

	public function jempa_field_group_xhr() {
		global $post;
		if ( 'jempa_field_group' === $post->post_type ) {            // check for post type
			$post_url = admin_url( 'post.php' ); // In case we're on post-new.php
			// update fields data first and than publish/update post

			// Register Custom Script
			 wp_register_script( 'jempa-spow-admin-jempa-tinyMCE', JEM_CPOW_ADMIN_URL . '/assets/js/admin-jempa-tinyMCE.js', array( 'jquery' ), '1.0.0', false );
			wp_enqueue_script( 'jempa-spow-admin-jempa-tinyMCE' );
		}
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
		add_action( 'admin_enqueue_scripts', array( $this, 'jem_cpow_admin_enqueue_scripts' ) );

		// doesn't need for now
		add_action( 'admin_head-post.php', array( $this, 'jempa_field_group_xhr' ) );                    // save field data before publishing post
		add_action( 'admin_head-post-new.php', array( $this, 'jempa_field_group_xhr' ) );                // ajax actio
	}

}
