<?php
/**
 * Handle Custom Post Type: Field Group
 *
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
 namespace JEM_Extra_Product_Options\Admin;

// Exit if accessed directly
defined( 'ABSPATH' ) or die( 'Sorry!, You do not access the file directly' );


class Jem_Cpow_Field_Group_Custom_Post {


	/**
	 * Registers custom post with WordPress.
	 *
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public function register_jempa_field_group_post() {

		// TODO - need to internationalize these
		$labels = array(
			'name'               => 'Field Group',
			'singular_name'      => 'Group type',
			'parent_item_colon'  => 'Parent Slider Directory',
			'all_items'          => 'All New Group',
			'view_item'          => 'View Group',
			'add_new_item'       => 'Add New Group',
			'add_new'            => 'Add New',
			'edit_item'          => 'Edit Group',
			'update_item'        => 'Update Group',
			'search_items'       => 'Search Group',
			'not_found'          => 'Not Found',
			'not_found_in_trash' => 'Not found in Trash',
		);

		$args_slider = array(
			'labels'              => $labels,
			'supports'            => array( 'title' ),
			'rewrite'             => array( 'slug' => 'jempa_field_group' ),
			'show_in_menu'        => false,
			'show_in_admin_bar'   => true,
			'can_export'          => true,
			'public'              => false,
			'publicly_queryable'  => false,
			'show_ui'             => true,
			'exclude_from_search' => true,
			'show_in_nav_menus'   => false,
			'has_archive'         => false,
		);

		// Apply filters
		$args_slider = apply_filters( 'jem_cpow_jempa_field_group_post_args', $args_slider );

		// Register Post Type
		register_post_type( 'jempa_field_group', $args_slider );

		// Flush Rewrite Rules
		flush_rewrite_rules();
	}

	function init_hooks() {

		// Register Jempa Fields Post Type
		add_action( 'init', array( $this, 'register_jempa_field_group_post' ), 10 );

	}
}
