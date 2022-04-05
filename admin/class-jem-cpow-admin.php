<?php
/**
 * Admin Main Class
 *
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */


namespace JEM_Extra_Product_Options\Admin;

 // Exit if accessed directly
defined( 'ABSPATH' ) or die( 'Sorry!, You do not access the file directly' );

use JEM_Extra_Product_Options\Admin;
use JEM_Extra_Product_Options\Admin\Callbacks\Jem_Cpow_Admin_Help;
use JEM_Extra_Product_Options\Admin\Callbacks\Jem_Cpow_Admin_Settings;
use JEM_Extra_Product_Options\Admin\Callbacks\Jem_Cpow_MetaBox_Selected_Fields_Callbacks;
use JEM_Extra_Product_Options\Admin\Callbacks\Jem_Cpow_MetaBox_Available_Fields_Callbacks;
use JEM_Extra_Product_Options\Admin\Callbacks\Jem_Cpow_MetaBox_Fields_Group_Settings_Callbacks;

class Jem_Cpow_Admin {


	// Registers MetaBox varible
	public $metaboxes_register;

	// Admin Add Menu Pages
	public $pages_register;
	
	// Available Fields of Meta box
	public $available_fields_callbacks;

	public $fields_group_settings_callbacks;

	public $selected_fields_callbacks;

	public $settings_api;

	public $help;
	
	/**
	 * Initiializes the class
	 *
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	function __construct() {

		// Register MeteBox Class
		$this->metaboxes_register = new Jem_Cpow_MetaBox();

		$this->pages_register = new Jem_Cpow_Menu();

		// Available Fields MetaBox Call Backs
		$this->available_fields_callbacks = new Jem_Cpow_MetaBox_Available_Fields_Callbacks();

		// Settings Fields Fields MetaBox Call Backs
		$this->fields_group_settings_callbacks = new Jem_Cpow_MetaBox_Fields_Group_Settings_Callbacks();

		// Selected Fields Callbacks
		$this->selected_fields_callbacks = new Jem_Cpow_MetaBox_Selected_Fields_Callbacks();

		// Settings API
		$this->settings_api = new Jem_Cpow_Admin_Settings();

		// Help
		$this->help = new Jem_Cpow_Admin_Help();
	
		// Call Metabox method
		$this->add_metaboxes();

		$this->jem_add_pages();
	}

	 /**
	  * Add MetaBox in "jempa_field_group Custom Post Type"
	  *
	  * @return
	  * @package Custom Product Options for WooCommerce
	  * @since 1.0.0
	  */
	function add_metaboxes() {

		// MetaBox Array
		 $metaboxes = array(

			 array(
				 'id'            => 'jempa-available-fields-meta-box',
				 'title'         => __( 'Available Fields', 'jem-cpow' ),
				 'callback'      => array( $this->available_fields_callbacks, 'callbacks' ),
				 'screen'        => 'jempa_field_group',
				 'context'       => 'side',
				 'priority'      => 'low',
				 'callback_args' => array(),
			 ),

			 array(
				 'id'            => 'jjempa-field-group-settings-meta-box',
				 'title'         => __( 'Field Group Settings', 'jem-cpow' ),
				 'callback'      => array( $this->fields_group_settings_callbacks, 'callbacks' ),
				 'screen'        => 'jempa_field_group',
				 'context'       => 'advanced',
				 'priority'      => 'high',
				 'callback_args' => array(),
			 ),

			 array(
				 'id'            => 'jempa-selected-fields-meta-box',
				 'title'         => __( 'Selected Fields', 'jem-cpow' ),
				 'callback'      => array( $this->selected_fields_callbacks, 'callbacks' ),
				 'screen'        => 'jempa_field_group',
				 'context'       => 'advanced',
				 'priority'      => 'high',
				 'callback_args' => array(),
			 ),
		 );

		 // Apply Filters of MetaBox
		 $metaboxes = apply_filters( 'jem_cpow_register_metaboxes', $metaboxes );

		 // Register, Add Metabox in "JEM Product Options" Custom post type
		 $this->metaboxes_register->addMetaBoxes( $metaboxes )->register();

	}

	function jem_add_pages(){

		$pages = array(
			
			array(
				'page_title' => __( 'JEM Product Options', 'jem_cpow' ),
	        	'menu_title' => __('JEM Product Options', 'jem_cpow'),
	        	'capability' => 'manage_options',
	        	'menu_slug'  => 'edit.php?post_type=jempa_field_group',
	        	'function'   => '',
	        	'icon_url'   => '',
	        	'position'   => 50
			),
	    );

	    $pages = apply_filters('jem_cpow_admin_menu_page', $pages);

	    $subpages = array(
	    	array(
	    		'parent_slug'   => 'edit.php?post_type=jempa_field_group',
	    		'page_title'	=> __('Settings', 'jem_cpow'),
	    		'menu_title'	=> __('Settings', 'jem_cpow'),
	    		'capability'	=> 'manage_options',
	    		'menu_slug'		=> 'settings',
	    		'function'		=> array($this->settings_api, 'callbacks'),
	        	'position'   	=> 1
	    	),
	    	array(
	    		'parent_slug'   => 'edit.php?post_type=jempa_field_group',
	    		'page_title'	=> __('Help', 'jem_cpow'),
	    		'menu_title'	=> __('Help', 'jem_cpow'),
	    		'capability'	=> 'manage_options',
	    		'menu_slug'		=> 'help',
	    		'function'		=> array($this->help,'callbacks'),
	        	'position'   	=> 3
	    	)
	    );

		$this->pages_register->add_pages($pages)->add_subpages($subpages)->register();
	}

	/**
	 * Register the submenu
	 *
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public function jem_register_submenu_page() {
		// Create Product options  for Wocommerce
		//add_submenu_page( 'woocommerce', 'JEM Product Options', 'JEM Product Options', 'manage_options', 'edit.php?post_type=jempa_field_group', null );
		

	}


	/**
	 * Save draggable field data into db
	 *
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public function jem_save_fields() {
		$jem_post_id = intval( sanitize_text_field( $_POST['post_id'] ) );

		$fields_data = $this->sanitize_array( $fields_data );
		$fields_data = isset( $_POST['jem_fields'] ) ? (array) $_POST['jem_fields'] : array();

		// Fields Data
		if ( ! empty( $fields_data ) ) {

			$i = 0;
			// create empty array for fields
			$fields_list = array();

			foreach ( $fields_data as $field ) {

				if ( ! empty( $field['unique_name'] ) ) {

					$fields_list[ $i ] = $field;
				} else {

					// generate a random number between 500 and 9999
					$randomNum = rand( 500, 9999 );

					$fields_list[ $i ]['unique_name'] = $jem_post_id . '-' . sanitize_title( $field['field_type'] . '-' . $randomNum );                // if name is empty generate a random string for name
					$field['unique_name']             = $jem_post_id . '-' . sanitize_title( $field['field_type'] . '-' . $randomNum );
					$fields_list[ $i ]                = $field;

				}
				$i++;
			}

			// save posted data
			update_post_meta( $jem_post_id, 'jem_fields', $fields_list );
			   // send success message to ajax action js
			$return = array( 'success' => true );

		} else {
			$return = '';
		}

		// send json response to ajax
		wp_send_json( $return );
		wp_die(); // prevent return 0
	}

	/**
	 * Save Metabox data
	 *
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public function jem_save_meta_box_data( $post_id ) {
		// save field group settings
		if ( isset( $_POST['cpt_first_meta_field'] ) ) {

			$text_meta_field = sanitize_text_field( $_POST['cpt_first_meta_field'] );
			update_post_meta( $post_id, 'cpt_first_meta_field', $text_meta_field );
		}

		if ( isset( $_POST['cpt_class_meta_field'] ) ) {

			$class_meta_field = sanitize_text_field( $_POST['cpt_class_meta_field'] );
			update_post_meta( $post_id, 'cpt_class_meta_field', $class_meta_field );
		}

		if ( isset( $_POST['cpt_first_meta_field1'] ) ) {

			$text_meta_field_text = sanitize_text_field( $_POST['cpt_first_meta_field1'] );
			update_post_meta( $post_id, 'cpt_first_meta_field1', $text_meta_field_text );
		}

		if ( isset( $_POST['cpt_second_meta_field1'] ) ) {

			$class_meta_field_text = sanitize_text_field( $_POST['cpt_second_meta_field1'] );
			update_post_meta( $post_id, 'cpt_second_meta_field1', $class_meta_field_text );
		}
		if ( isset( $_POST['selected_products'] ) ) {

			$selected_products = isset( $_POST['selected_products'] ) ? (array) $_POST['selected_products'] : array();
			$selected_products = $this->sanitize_array( $selected_products );
			update_post_meta( $post_id, 'selected_products', $selected_products );
		} else {
			update_post_meta( $post_id, 'selected_products', '' );
		}
		if ( isset( $_POST['selected_terms'] ) ) {

			$selected_terms = isset( $_POST['selected_terms'] ) ? (array) $_POST['selected_terms'] : array();
			$selected_terms = $this->sanitize_array( $selected_terms );
			update_post_meta( $post_id, 'selected_terms', $selected_terms );
		} else {
			update_post_meta( $post_id, 'selected_terms', '' );
		}
		if ( isset( $_POST['productDisplayRule'] ) ) {
			$productDisplayRule = sanitize_text_field( $_POST['productDisplayRule'] );
			update_post_meta( $post_id, 'productDisplayRule', $productDisplayRule );
		}
		if ( isset( $_POST['categoryDisplayRule'] ) ) {
			$categoryDisplayRule = sanitize_text_field( $_POST['categoryDisplayRule'] );
			update_post_meta( $post_id, 'categoryDisplayRule', $categoryDisplayRule );
		}
		if(isset($_POST['jem_display_enabled'])){
			update_post_meta( $post_id, 'jem_display_enabled','on' );
		}
		else{
			update_post_meta( $post_id, 'jem_display_enabled','off' );
		}
		if(isset($_POST['jem_display_logic_group'])){
			$jem_display_logic_group = isset( $_POST['jem_display_logic_group'] ) ? (array) $_POST['jem_display_logic_group'] : array();
				if(!empty($jem_display_logic_group['fields'])){
					foreach ($jem_display_logic_group['fields'] as $key => $value) {
						if(empty(array_filter($value))) unset($jem_display_logic_group['fields'][$key]);
					}
				}			
			
			$jem_display_logic_group = $this->sanitize_array( $jem_display_logic_group );
			update_post_meta( $post_id, 'jem_display_logic_group', $jem_display_logic_group );
		}

	}

	/**
	 * used to sanitize a multidimensional array
	 *
	 * @param $array
	 * @return mixed
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public function sanitize_array( &$array ) {
		// In the event we don't get an array
		if ( ! is_array( $array ) ) {
			$array = sanitize_textarea_field( $array );
			return $array;
		}

		foreach ( $array as &$value ) {

			if ( ! is_array( $value ) ) {

				// sanitize if value is not an array
				$value = sanitize_textarea_field( $value );

			} else {
				// go inside this function again
				$this->sanitize_array( $value );
			}
		}

		return $array;

	}

	 /**
	  * ADD or remove columns in custom post type
	  *
	  * @param $coulmns
	  * @return array $columns
	  * @package Custom Product Options for WooCommerce
	  * @since 1.0.0
	  */
	function jem_cpow_edit_jempa_field_group_columns( $columns ) {

		unset( $columns['date'] );
		$columns['date'] = __( 'Date' );

		return $columns;
	}


	/**
	 * Display field value columns in custom post type
	 *
	 * @param $coulmns, $post_id
	 * @return
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	function manage_jempa_field_group_columns( $column, $post_id ) {

		switch ( $column ) {
			default:
				echo '—';
				break;
		}
	}

	/**
	 * Call Iinitalation of class
	 *
	 * @param
	 * @return
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	function init_hooks() {

		// Save Meta data fields
		add_action( 'save_post', array( $this, 'jem_save_meta_box_data' ), 20 );

		// Add fields after add to cart button WordPress
		add_action( 'admin_post_jem_save_fields', array( $this, 'jem_save_fields' ), 20 );   // save fields data

		// Ajax Save data fields
		add_action( 'wp_ajax_jem_save_fields', array( $this, 'jem_save_fields' ), 10 );

		// Add Coustom Potst Type Column
		add_filter( 'manage_edit-jempa_field_group_columns', array( $this, 'jem_cpow_edit_jempa_field_group_columns' ), 10, 1 );

		 // Get meta key on  admin Column field
		add_action( 'manage_jempa_field_group_posts_custom_column', array( $this, 'manage_jempa_field_group_columns' ), 10, 2 );
	}
}
