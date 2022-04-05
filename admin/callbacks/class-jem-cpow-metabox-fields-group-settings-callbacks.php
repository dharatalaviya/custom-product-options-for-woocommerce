<?php
/**
 * Defines the functionality required to callback the content of Group Settings Meta Box
 * to which this display belongs.
 *
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
 namespace JEM_Extra_Product_Options\Admin\Callbacks;

// Exit if accessed directly
defined( 'ABSPATH' ) or die( 'Sorry!, You do not access the file directly' );

/**
 * Field group settings page
 * Defines the functionality required to render the content within the Meta Box
 * to which this display belongs.
 *
 * When the render method is called, the contents of the string it includes
 * or the file it includes to render within the meta box.
 */
class Jem_Cpow_MetaBox_Fields_Group_Settings_Callbacks {


	// Create Public Variable Group Settings
	public $group_settings;

	/**
	 * Initiializes the class
	 */
	public function __construct() {

		// Group Setting
		$this->group_settings = array();

	}

	/**
	 * Renders a single string in the context of the meta box to which this
	 * Display belongs.
	 *
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public function callbacks( $post ) {

		wp_nonce_field( 'jem_cpt_field_meta', 'cptexamples_meta_box_nonce' );

		// Get Group Settings Data
		$this->group_settings = $this->get_group_settings( $post );

		// Call Html Template File & pass group settings data
		jem_cpow_admin_get_template(
			'callbacks/admin-group-settings-html.php',
			array( 'group_settings' => $this->group_settings )
		);
	}

	/**
	 * Get data of group settings
	 *
	 * @return Array $group_settings
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	function get_group_settings( $post ) {
		$group_settings = array();
		$group_settings['tabs'] = array(
			array(
				'title'		=> __( 'Group Settings', 'jem-spow' ),
				'id'  		=> 'group_settings',
				'active'	=> true,
			),
			array(
				'title'		=> __( 'Display Settings', 'jem-cpow' ),
				'id'		=> 'display_settings',
				'active'	=> false,
			),
			array(
				'title'		=> __( 'Display Logic', 'jem-cpow' ),
				'id'		=> 'display_logic',
				'active'	=> false
			)
		);
		$group_settings['textTitle']           = get_post_meta( $post->ID, 'cpt_first_meta_field', true );
		$group_settings['textClass']           = get_post_meta( $post->ID, 'cpt_class_meta_field', true );
		$group_settings['selected_terms']      = get_post_meta( $post->ID, 'selected_terms', true );
		$group_settings['selected_products']   = get_post_meta( $post->ID, 'selected_products', true );
		$group_settings['productDisplayRule']  = get_post_meta( $post->ID, 'productDisplayRule', true );
		$group_settings['categoryDisplayRule'] = get_post_meta( $post->ID, 'categoryDisplayRule', true );
		$group_settings['selected_terms']      = ! empty( $group_settings['selected_terms'] ) ? $group_settings['selected_terms'] : array();
		$group_settings['selected_products']   = ! empty( $group_settings['selected_products'] ) ? $group_settings['selected_products'] : array();

		// Products Arguments
		$products_args = array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'posts_per_page' => -1, // all posts
		);
		$group_settings['jem_display_logic_group'] = get_post_meta( $post->ID, 'jem_display_logic_group', true);
		
		$savedFields  = get_post_meta( $post->ID, 'jem_fields', true );
		$group_settings['fieldslist'] = (!empty($savedFields)) ? $savedFields : [];
		$group_settings['jem_display_enabled'] = get_post_meta($post->ID, 'jem_display_enabled', true);

		// Get Products List
		$group_settings['products'] = wc_get_products( $products_args );

		// Get Products Categories
		$group_settings['products_Categories'] = get_terms( 'product_cat', array( 'hide_empty' => false ) );

		// Apply Filters in Group Settings
		return apply_filters( 'jem_cpow_get_metabox_fields_group_settings', $group_settings );
	}

}
