<?php
/**
 * Defines the functionality required to callbacks the content within the Meta Box
 * to which this display belongs.
 *
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
 namespace JEM_Extra_Product_Options\Admin\Callbacks;

// Exit if accessed directly
defined( 'ABSPATH' ) or die( 'Sorry!, You do not access the file directly' );


class Jem_Cpow_MetaBox_Available_Fields_Callbacks {



	// Create Public Variable Availble Fields Metabox
	public $available_fields_list = array();

	/**
	 * Initiializes the class
	 */
	function __construct() {

		// Available Fields List Array Varible;
		$this->available_fieldslist = $this->get_available_fieldslist();

	}

	/**
	 *
	 * Available fields Metabox HTML Callbacks funtions
	 * Display html by template "callbacks/admin-available-fields-html.php"
	 *
	 * @param $post The post on this page
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public function callbacks( $post ) {
		if ( empty( $this->available_fieldslist ) ) {
			return;
		}

		// Available Fields HTML Temaplate
		jem_cpow_admin_get_template(
			'callbacks/admin-available-fields-html.php',
			array( 'available_fieldslist' => $this->available_fieldslist )
		);

	}

	/**
	 *
	 * Available fields list
	 *
	 * @return array $fieldslist
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	function get_available_fieldslist() {

		// Available Fields list
		$available_fieldslist = array(
			'draggable_textbox' => array(
				'title'  => __( 'Text Field', 'jem-cpow' ),
				'slug'   => 'draggable_textbox',
				'icon'   => 'fa-text-width',
				'fields' => array(
					array(
						'label'       => __( 'Field Unique Name', 'jem-cpow' ),
						'field_name'  => 'unique_name',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Field Label', 'jem-cpow' ),
						'field_name'  => 'label',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Placeholder', 'jem-cpow' ),
						'field_name'  => 'placeholder',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Placeholder Text', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'CSS Classes', 'jem-cpow' ),
						'field_name'  => 'class',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Validation Regular expression', 'jem-cpow' ),
						'field_name'  => 'validation_regex',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Validation Regular expression(regex)', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Error Validation', 'jem-cpow' ),
						'field_name'  => 'error_msg',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter error message', 'jem-cpow' ),
					),

				),
			),
			'number_field'      => array(
				'title'  => __( 'Number Field', 'jem-cpow' ),
				'slug'   => 'number_field',
				'icon'   => 'fa-hashtag',
				'fields' => array(
					array(
						'label'       => __( 'Field Unique Name', 'jem-cpow' ),
						'field_name'  => 'unique_name',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Field Label', 'jem-cpow' ),
						'field_name'  => 'label',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'CSS Classes', 'jem-cpow' ),
						'field_name'  => 'class',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Default Value', 'jem-cpow' ),
						'field_name'  => 'value',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter the default Value', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Minimum Value', 'jem-cpow' ),
						'field_name'  => 'min',
						'type'        => 'number',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Minimum Value', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Maximum Value', 'jem-cpow' ),
						'field_name'  => 'max',
						'type'        => 'number',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Maximum Value', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Validation Regular expression', 'jem-cpow' ),
						'field_name'  => 'validation_regex',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Validation Regular expression(regex)', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Error Validation', 'jem-cpow' ),
						'field_name'  => 'error_msg',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter error message', 'jem-cpow' ),
					),
				),
			),
			'pass_field'        => array(
				'title'  => __( 'Password Field', 'jem-cpow' ),
				'slug'   => 'pass_field',
				'icon'   => 'fa-key',
				'fields' => array(
					array(
						'label'       => __( 'Field Unique Name', 'jem-cpow' ),
						'field_name'  => 'unique_name',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Field Label', 'jem-cpow' ),
						'field_name'  => 'label',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Placeholder', 'jem-cpow' ),
						'field_name'  => 'placeholder',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Placeholder Text', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'CSS Classes', 'jem-cpow' ),
						'field_name'  => 'class',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Validation Regular expression', 'jem-cpow' ),
						'field_name'  => 'validation_regex',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Validation Regular expression(regex)', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Error Validation', 'jem-cpow' ),
						'field_name'  => 'error_msg',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter error message', 'jem-cpow' ),
					),
				),
			),
			'email_field'       => array(
				'title'  => __( 'Email Field', 'jem-cpow' ),
				'slug'   => 'email_field',
				'icon'   => 'fa-envelope',
				'fields' => array(
					array(
						'label'       => __( 'Field Unique Name', 'jem-cpow' ),
						'field_name'  => 'unique_name',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Field Label', 'jem-cpow' ),
						'field_name'  => 'label',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Field Placeholder', 'jem-cpow' ),
						'field_name'  => 'placeholder',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Field Placeholder', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'CSS Classes', 'jem-cpow' ),
						'field_name'  => 'class',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Validation Regular expression', 'jem-cpow' ),
						'field_name'  => 'validation_regex',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Validation Regular expression(regex)', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Error Validation', 'jem-cpow' ),
						'field_name'  => 'error_msg',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter error message', 'jem-cpow' ),
					),
				),
			),
			'textarea_field'    => array(
				'title'  => __( 'Textarea', 'jem-cpow' ),
				'slug'   => 'textarea_field',
				'icon'   => 'fa-terminal',
				'fields' => array(
					array(
						'label'       => __( 'Field Unique Name', 'jem-cpow' ),
						'field_name'  => 'unique_name',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Field Label', 'jem-cpow' ),
						'field_name'  => 'label',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Placeholder', 'jem-cpow' ),
						'field_name'  => 'placeholder',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Placeholder Text', 'jem-cpow' ),
					),
					array(
						'label'       => 'CSS Classes',
						'field_name'  => 'class',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
					),
					array(
						'label'       => 'Default Value',
						'field_name'  => 'value',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter the default Value', 'jem-cpow' ),
					),
					array(
						'label'       => 'Max Length',
						'field_name'  => 'length',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter the Max number of Characters', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Validation Regular expression', 'jem-cpow' ),
						'field_name'  => 'validation_regex',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Validation Regular expression(regex)', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Error Validation', 'jem-cpow' ),
						'field_name'  => 'error_msg',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter error message', 'jem-cpow' ),
					),
				),
			),
			'upload_field'      => array(
				'title'  => __( 'File Uploads', 'jem-cpow' ),
				'slug'   => 'upload_field',
				'icon'   => 'fa-file',
				'fields' => array(
					array(
						'label'       => __( 'Field Unique Name', 'jem-cpow' ),
						'field_name'  => 'unique_name',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Field Label', 'jem-cpow' ),
						'field_name'  => 'label',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'CSS Classes', 'jem-cpow' ),
						'field_name'  => 'class',
						'type'        => 'text',
						'classes'     => 'col-sm-12 col-xs-12 form-group',
						'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
					),
				),
			),
			'check_field'       => array(
				'title'  => __( 'Checkbox Field', 'jem-cpow' ),
				'slug'   => 'check_field',
				'icon'   => 'fa-check-square',
				'fields' => array(
					array(
						'label'       => __( 'Field Unique Name', 'jem-cpow' ),
						'field_name'  => 'unique_name',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Unique Name will be automatically generated', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Field Label', 'jem-cpow' ),
						'field_name'  => 'label',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'CSS Classes', 'jem-cpow' ),
						'field_name'  => 'class',
						'type'        => 'text',
						'classes'     => 'col-sm-12 col-xs-12 form-group',
						'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Options', 'jem-cpow' ),
						'field_name'  => 'options',
						'type'        => 'textarea',
						'classes'     => 'col-sm-12 col-xs-12 form-group',
						'placeholder' => __( 'value : Label (new option on new line)', 'jem-cpow' ),
					),
				),
			),
			'select_field'      => array(
				'title'  => __( 'Dropdown Field', 'jem-cpow' ),
				'slug'   => 'select_field',
				'icon'   => 'fa-caret-square-o-down',
				'fields' => array(
					array(
						'label'       => __( 'Field Unique Name', 'jem-cpow' ),
						'field_name'  => 'unique_name',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Field Label', 'jem-cpow' ),
						'field_name'  => 'label',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Placeholder', 'jem-cpow' ),
						'field_name'  => 'placeholder',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Placeholder Text', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'CSS Classes', 'jem-cpow' ),
						'field_name'  => 'class',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Options', 'jem-cpow' ),
						'field_name'  => 'options',
						'type'        => 'textarea',
						'classes'     => 'col-sm-12 col-xs-12 form-group',
						'placeholder' => __( 'value : Label (each value in each line)', 'jem-cpow' ),
					),
				),
			),
			'radio_field'       => array(
				'title'  => __( 'Radio Buttons', 'jem-cpow' ),
				'slug'   => 'radio_field',
				'icon'   => 'fa-dot-circle-o',
				'fields' => array(
					array(
						'label'       => __( 'Field Unique Name', 'jem-cpow' ),
						'field_name'  => 'unique_name',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Field Label', 'jem-cpow' ),
						'field_name'  => 'label',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'CSS Classes', 'jem-cpow' ),
						'field_name'  => 'class',
						'type'        => 'text',
						'classes'     => 'col-sm-12 col-xs-12 form-group',
						'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'List of options', 'jem-cpow' ),
						'field_name'  => 'value',
						'type'        => 'options_list',
						'classes'     => 'col-sm-12 col-xs-12 form-group',
						'placeholder' => __( 'value : Label (new option seperated by line)', 'jem-cpow' ),
					),
				),
			),
			'date_field'        => array(
				'title'  => __( 'Date Picker', 'jem-cpow' ),
				'slug'   => 'date_field',
				'icon'   => 'fa-calendar',
				'fields' => array(
					array(
						'label'       => __( 'Field Unique Name', 'jem-cpow' ),
						'field_name'  => 'unique_name',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Field Label', 'jem-cpow' ),
						'field_name'  => 'label',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Placeholder', 'jem-cpow' ),
						'field_name'  => 'placeholder',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Placeholder Text', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'CSS Classes', 'jem-cpow' ),
						'field_name'  => 'class',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
					),
				),
			),
			'color_field'       => array(
				'title'  => __( 'Color Picker', 'jem-cpow' ),
				'slug'   => 'color_field',
				'icon'   => 'fa-paint-brush',
				'fields' => array(
					array(
						'label'       => __( 'Field Unique Name', 'jem-cpow' ),
						'field_name'  => 'unique_name',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Field Label', 'jem-cpow' ),
						'field_name'  => 'label',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Placeholder', 'jem-cpow' ),
						'field_name'  => 'placeholder',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Placeholder Text', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'CSS Classes', 'jem-cpow' ),
						'field_name'  => 'class',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
					),
				),
			),
			'para_field'        => array(
				'title'  => __( 'Paragraph Field', 'jem-cpow' ),
				'slug'   => 'para_field',
				'icon'   => 'fa-paragraph',
				'fields' => array(
					array(
						'label'       => __( 'Field Unique Name', 'jem-cpow' ),
						'field_name'  => 'unique_name',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Field Label', 'jem-cpow' ),
						'field_name'  => 'label',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Placeholder', 'jem-cpow' ),
						'field_name'  => 'placeholder',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Placeholder Text', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'CSS Classes' ),
						'field_name'  => 'class',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Content', 'jem-cpow' ),
						'field_name'  => 'value',
						'type'        => 'wp_editor',
						'classes'     => 'col-sm-12 col-xs-12 form-group',
						'placeholder' => '',
					),
				),
			),
			'header_field'      => array(
				'title'  => __( 'Header Field', 'jem-cpow' ),
				'slug'   => 'header_field',
				'icon'   => 'fa-header',
				'fields' => array(
					array(
						'label'       => __( 'Field Unique Name', 'jem-cpow' ),
						'field_name'  => 'unique_name',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'CSS Classes', 'jem-cpow' ),
						'field_name'  => 'class',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Heading Tag', 'jem-cpow' ),
						'field_name'  => 'tag',
						'type'        => 'header_field',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Select Heading Tag', 'jem-cpow' ),
					),
					array(
						'label'       => __( 'Heading', 'jem-cpow' ),
						'field_name'  => 'value',
						'type'        => 'text',
						'classes'     => 'col-sm-6 col-xs-12 form-group',
						'placeholder' => __( 'Enter Heading Text', 'jem-cpow' ),
					),
				),
			),
		);

		// Apply Filters for Available Fieldlist
		return apply_filters( 'Jem_Cpow_MetaBox_Available_Fieldslist', $available_fieldslist );
	}
}
