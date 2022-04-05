<?php
/**
 * Defines the functionality required to callback the content within the Meta Box
 * to which this display belongs.
 *
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */

namespace JEM_Extra_Product_Options\Admin\Callbacks;

// Exit if accessed directly
defined( 'ABSPATH' ) or die( 'Sorry!, You do not access the file directly' );

class Jem_Cpow_MetaBox_Selected_Fields_Callbacks {


	// Create Public Variable Selected Fields Metabox
	public $selected_fields;

	/**
	 * Initiializes the class
	 */
	public function __construct() {
		 $this->selected_fields = array();
	}

	/**
	 * Callback the selected fields
	 *
	 * @param $post The post on this page
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public function callbacks( $post ) {
		wp_nonce_field( 'jem_cpt_field_meta_second', 'cptexamples_meta_box_nonce' );

		// Call Html Template File
		jem_cpow_admin_get_template(
			'callbacks/admin-selected-fields-html.php',
			array( 'selected_fields' => $this->get_metabox_data( $post ) )
		);

	}

	 /**
	  * Get Selected Fields Data Array
	  *
	  * @param $post The post on this page
	  * @return Array $meta_data
	  * @package Custom Product Options for WooCommerce
	  * @since 1.0.0
	  */
	function get_metabox_data( $post ) {

		$savedFields  = get_post_meta( $post->ID, 'jem_fields', true );
		$metdbox_data = array();
		if ( ! empty( $savedFields ) ) {
			foreach ( $savedFields as $data ) {
				$metdbox_data[ $data['field_type'] ] = $this->get_selectedfields_data( $data );
			}
		}

		return $metdbox_data;
	}

	 /**
	  * Get Selected Single Field Data
	  *
	  * @param $data The meta data on this single field
	  * @return Array $selected_fields
	  * @package Custom Product Options for WooCommerce
	  * @since 1.0.0
	  */
	function get_selectedfields_data( $data ) {
		$selected_fields = array();
		$type            = $data['field_type'];
		$label 			 = isset( $data['label'] ) ? $data['label'] : '';
		switch ( $type ) {

			case 'number_field':
				$selected_fields = array(
					'icon'             => 'fa-hashtag',
					'title'            => __( 'Number Field: <span class="changing_lbl">' . $label . '</span>', 'jem-cpow' ),
					'required'         => isset( $data['required'] ) ? $data['required'] : '',
					'required_checked' => (isset( $data['required'] ) && $data['required'] == 'on')?'checked':'',
					'unique_name'      => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
					'label'            => isset( $data['label'] ) ? $data['label'] : '',
					'placeholder'      => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
					'class'            => isset( $data['class'] ) ? $data['class'] : '',
					'value'            => isset( $data['value'] ) ? $data['value'] : '',
					'max'              => isset( $data['max'] ) ? $data['max'] : '',
					'min'              => isset( $data['min'] ) ? $data['min'] : '',
					'hide_require'     => false,
					'tabs'			   => array(
						array(
							'name'       => __('Basic Settings','jem-cpow'),
							'id'         => 'basic_settings',
							'active'	 => 'true',
							'fields'           => array(
								array(
									'label'       => __( 'Field Unique Name', 'jem-cpow' ),
									'field_name'  => 'unique_name',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
									'value'       => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
									'field_class' => 'jem-field'	
								),
								array(
									'label'       => __( 'Field Label', 'jem-cpow' ),
									'field_name'  => 'label',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group kinput_detect',
									'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
									'value'       => isset( $data['label'] ) ? $data['label'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'CSS Classes', 'jem-cpow' ),
									'field_name'  => 'class',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
									'value'       => isset( $data['class'] ) ? $data['class'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'Default Value', 'jem-cpow' ),
									'field_name'  => 'value',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter the default Value', 'jem-cpow' ),
									'value'       => isset( $data['value'] ) ? $data['value'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'Minimum Value', 'jem-cpow' ),
									'field_name'  => 'min',
									'type'        => 'number',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Minimum Value', 'jem-cpow' ),
									'value'       => isset( $data['min'] ) ? $data['min'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'Maximum Value', 'jem-cpow' ),
									'field_name'  => 'max',
									'type'        => 'number',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Maximum Value', 'jem-cpow' ),
									'value'       => isset( $data['max'] ) ? $data['max'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'Validation', 'jem-cpow' ),
									'field_name'  => 'validation_regex',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Validation(regex)', 'jem-cpow' ),
									'value'       => isset( $data['validation_regex'] ) ? $data['validation_regex'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'Error Validation', 'jem-cpow' ),
									'field_name'  => 'error_msg',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter error message', 'jem-cpow' ),
									'value'       => isset( $data['error_msg'] ) ? $data['error_msg'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'		=> 'Enable Pricing For This Field',
									'field_name'  => 'enabled_pricing',
									'type'        => 'draggable_button',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => '',
									'value'       => 'false',
									'field_class' => 'jem-field'
								),
								array(
									'label'		=> 'Enable Pricing For This Field',
									'field_name'  => 'enabled_pricing',
									'type'        => 'draggable_button',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => '',
									'value'       => 'false',
									'field_class' => 'jem-field'
								),
								array(
									'label'		=> 'Pricing Method',
									'field_name'  => 'pricing_method',
									'type'        => 'dropdown',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => '',
									'options'	  => array(
										'fixed'		=> "Fixed Amount",
										'pecentage' => 'percentage',
										'multiply_by'	=> "Multiply by value"
									),
									'value'       => 'fixed_amount',
									'field_class' => 'jem-field',
								),
								array(
									'label'		=> 'Price',
									'field_name'  => 'price',
									'type'        => 'draggable_button',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => '',
									'value'       => '',
									'field_class' => 'jem-field'
								),
							),
						),	
						array(
							'name'		=> __('Display Logic','jem-cpow'),
							'id'		=> 'conditional_logic',
							'active'	=> 'false',
							'fields' 	=> array(
								array(
									'label'       => __( 'Field Unique Name', 'jem-cpow' ),
									'field_name'  => 'unique_name',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
									'value'       => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
									'field_class' => 'jem-field'	
								),
							)		
						),
					),	
				);
				break;

			case 'draggable_textbox':
				$selected_fields = array(
					'icon'             => 'fa-text-width',
					'title'            => __( 'Text Field: <span class="changing_lbl">'.$label.'</span>', 'jem-cpow' ),
					'required'         => isset( $data['required'] ) ? $data['required'] : '',
					'required_checked' => ( isset( $data['required'] ) && $data['required'] == 'on' ) ? 'checked' : '',
					'unique_name'      => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
					'label'            => isset( $data['label'] ) ? $data['label'] : '',
					'placeholder'      => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
					'class'            => isset( $data['class'] ) ? $data['class'] : '',
					'value'            => isset( $data['value'] ) ? $data['value'] : '',
					'hide_require'     => false,
					'tabs'			   => array(
						array(
							'name'			=> __('Basic Settings','jem-cpow'),
							'id'		   	=> 'basic_settings',
							'active'	 	=> 'true',
							'fields'        => array(
								array(
									'label'       => __( 'Field Unique Name', 'jem-cpow' ),
									'field_name'  => 'unique_name',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
									'value'       => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'Field Label', 'jem-cpow' ),
									'field_name'  => 'label',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group kinput_detect',
									'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
									'value'       => isset( $data['label'] ) ? $data['label'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'Placeholder', 'jem-cpow' ),
									'field_name'  => 'placeholder',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Placeholder Text', 'jem-cpow' ),
									'value'       => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'CSS Classes', 'jem-cpow' ),
									'field_name'  => 'class',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
									'value'       => isset( $data['class'] ) ? $data['class'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'Default Value', 'jem-cpow' ),
									'field_name'  => 'value',
									'type'        => 'text',
									'classes'     => 'col-sm-12 col-xs-12 form-group',
									'placeholder' => __( 'Enter the default Value', 'jem-cpow' ),
									'value'       => isset( $data['value'] ) ? $data['value'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'Validation', 'jem-cpow' ),
									'field_name'  => 'validation_regex',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Validation(regex)', 'jem-cpow' ),
									'value'       => isset( $data['validation_regex'] ) ? $data['validation_regex'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'Error Validation', 'jem-cpow' ),
									'field_name'  => 'error_msg',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter error message', 'jem-cpow' ),
									'value'       => isset( $data['error_msg'] ) ? $data['error_msg'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'		=> 'Enable Pricing For This Field',
									'field_name'  => 'enabled_pricing',
									'type'        => 'draggable_button',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => '',
									'value'       => 'false',
									'field_class' => 'jem-field'
								),
								array(
									'label'		=> 'Pricing Method',
									'field_name'  => 'pricing_method',
									'type'        => 'dropdown',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => '',
									'options'	  => array(
										'fixed'		=> "Fixed Amount",
										'pecentage' => 'percentage',
										'per_char'	=> "Per Character"
									),
									'value'       => 'fixed_amount',
									'field_class' => 'jem-field',
								),
								array(
									'label'		=> 'Price',
									'field_name'  => 'price',
									'type'        => 'draggable_button',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => '',
									'value'       => '',
									'field_class' => 'jem-field'
								),
							),
						),
						array(
							'name'		=> __('Display Logic','jem-cpow'),
							'id'		=> 'conditional_logic',
							'active'	=> 'false',
							'fields' 	=> array(),		
						),					
					),	
				);
				break;

			case 'pass_field':
				$selected_fields = array(
					'icon'             => 'fa-key',
					'title'            => __( 'Password Field: <span class="changing_lbl">' . $label . '</span>', 'jem-cpow' ),
					'unique_name'      => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
					'label'            => isset( $data['label'] ) ? $data['label'] : '',
					'placeholder'      => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
					'class'            => isset( $data['class'] ) ? $data['class'] : '',
					'required'         => isset( $data['required'] ) ? $data['required'] : '',
					'required_checked' => ( isset( $data['required'] ) && $data['required'] == 'on')?'checked':'',
					'hide_require'     => false,
					'tabs'			   =>array(
						array(
							'name'		   	=> __('Basic Settings','jem-cpow'),
							'id'		   	=> 'basic_settings',
							'active'	 	=> 'true',
							'fields'       	=> array(
								array(
									'label'       => __( 'Field Unique Name', 'jem-cpow' ),
									'field_name'  => 'unique_name',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
									'value'       => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'Field Label', 'jem-cpow' ),
									'field_name'  => 'label',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group kinput_detect',
									'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
									'value'       => isset( $data['label'] ) ? $data['label'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'Placeholder', 'jem-cpow' ),
									'field_name'  => 'placeholder',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Placeholder Text', 'jem-cpow' ),
									'value'       => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'CSS Classes', 'jem-cpow' ),
									'field_name'  => 'class',
									'value'       => isset( $data['class'] ) ? $data['class'] : '',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'Validation', 'jem-cpow' ),
									'field_name'  => 'validation_regex',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Validation(regex)', 'jem-cpow' ),
									'value'       => isset( $data['validation_regex'] )?$data['validation_regex']:'',
									'field_class' => 'jem-field'
								),
								array(
									'label'       => __( 'Error Validation', 'jem-cpow' ),
									'field_name'  => 'error_msg',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter error message', 'jem-cpow' ),
									'value'       => isset( $data['error_msg'] ) ? $data['error_msg'] : '',
									'field_class' => 'jem-field',
								),
							),
						),
						array(
							'name'		=> __('Display Logic','jem-cpow'),
							'id'		=> 'conditional_logic',
							'active'	=> 'false',
							'fields' 	=> array(),		
						),
					),					
				);
				break;

			case 'email_field':
				$selected_fields = array(
					'icon'             => 'fa-envelope',
					'title'            => __( 'E-Mail Field: <span class="changing_lbl">' . $label . '</span>', 'jem-cpow' ),
					'unique_name'      => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
					'label'            => isset( $data['label'] ) ? $data['label'] : '',
					'placeholder'      => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
					'class'            => isset( $data['class'] ) ? $data['class'] : '',
					'required'         => isset( $data['required'] ) ? $data['required'] : '',
					'required_checked' => ( isset( $data['required'] ) && $data['required'] == 'on' ) ? 'checked' : '',
					'hide_require'     => false,
					'tabs'			   =>array(
						array(
							'name'		   	=> __('Basic Settings','jem-cpow'),
							'id'		   	=> 'basic_settings',
							'active'	 	=> 'true',
							'fields'       	=> array(
								array(
									'label'       => __( 'Field Unique Name', 'jem-cpow' ),
									'field_name'  => 'unique_name',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY','jem-cpow' ),
									'value'       => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Field Label', 'jem-cpow' ),
									'field_name'  => 'label',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group kinput_detect',
									'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
									'value'       => isset( $data['label'] ) ? $data['label'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Field Placeholder', 'jem-cpow' ),
									'field_name'  => 'placeholder',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group kinput_detect',
									'placeholder' => __( 'Enter Field Placeholder', 'jem-cpow' ),
									'value'       => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'CSS Classes', 'jem-cpow' ),
									'field_name'  => 'class',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
									'value'       => isset( $data['class'] ) ? $data['class'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Validation', 'jem-cpow' ),
									'field_name'  => 'validation_regex',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Validation(regex)', 'jem-cpow' ),
									'value'       => isset( $data['validation_regex'] )?$data['validation_regex']:'',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Error Validation', 'jem-cpow' ),
									'field_name'  => 'error_msg',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter error message', 'jem-cpow' ),
									'value'       => isset( $data['error_msg'] ) ? $data['error_msg'] : '',
									'field_class' => 'jem-field',
								),
							),
						),
						array(
							'name'		=> __('Display Logic','jem-cpow'),
							'id'		=> 'conditional_logic',
							'active'	=> 'false',
							'fields' 	=> array(),		
						),
					),		
				);
				break;

			case 'textarea_field':
				$selected_fields = array(
					'icon'             => 'fa-terminal',
					'title'            => __( 'Textarea Field: <span class="changing_lbl">' . $label . '</span>', 'jem-cpow' ),
					'unique_name'      => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
					'label'            => isset( $data['label'] ) ? $data['label'] : '',
					'placeholder'      => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
					'class'            => isset( $data['class'] ) ? $data['class'] : '',
					'required'         => isset( $data['required'] ) ? $data['required'] : '',
					'required_checked' => ( isset( $data['required'] ) && $data['required'] == 'on' ) ? 'checked' : '',
					'hide_require'     => false,
					'tabs'			   => array(
						array(
							'name'		   	=> __('Basic Settings','jem-cpow'),
							'id'		   	=> 'basic_settings',
							'active'	 	=> 'true',
							'fields'       	=> array(
								array(
									'label'       => __( 'Field Unique Name', 'jem-cpow' ),
									'field_name'  => 'unique_name',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
									'value'       => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Field Label', 'jem-cpow' ),
									'field_name'  => 'label',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group kinput_detect',
									'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
									'value'       => isset( $data['label'] ) ? $data['label'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Placeholder', 'jem-cpow' ),
									'field_name'  => 'placeholder',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Placeholder Text', 'jem-cpow' ),
									'value'       => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'CSS Classes', 'jem-cpow' ),
									'field_name'  => 'class',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
									'value'       => isset( $data['class'] ) ? $data['class'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Validation', 'jem-cpow' ),
									'field_name'  => 'validation_regex',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Validation(regex)', 'jem-cpow' ),
									'value'       => isset( $data['validation_regex'] )?$data['validation_regex']:'',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Error Validation', 'jem-cpow' ),
									'field_name'  => 'error_msg',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter error message', 'jem-cpow' ),
									'value'       => isset( $data['error_msg'] ) ? $data['error_msg'] : '',
									'field_class' => 'jem-field',
								),
							),
						),
						array(
							'name'		=> __('Display Logic','jem-cpow'),
							'id'		=> 'conditional_logic',
							'active'	=> 'false',
							'fields' 	=> array(),		
						),
					),		
				);
				break;

			case 'upload_field':
				$selected_fields = array(
					'icon'             => 'fa-file',
					'title'            => __( 'File Uploads: <span class="changing_lbl">' . $label . '</span>', 'jem-cpow' ),
					'unique_name'      => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
					'label'            => isset( $data['label'] ) ? $data['label'] : '',
					'class'            => isset( $data['class'] ) ? $data['class'] : '',
					'required'         => isset( $data['required'] ) ? $data['required'] : '',
					'required_checked' => ( isset( $data['required'] ) && $data['required'] == 'on' ) ? 'checked' : '',
					'hide_require'     => false,
					'tabs'			   => array(
						array(
							'name'		   	=> __('Basic Settings','jem-cpow'),
							'id'		   	=> 'basic_settings',
							'active'	 	=> 'true',
							'fields'        => array(
								array(
									'label'       => __( 'Field Unique Name', 'jem-cpow' ),
									'field_name'  => 'unique_name',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __('Unique Name for field Letters and Underscore ONLY','jem-cpow'),
									'value'       => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Field Label', 'jem-cpow' ),
									'field_name'  => 'label',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group kinput_detect',
									'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
									'value'       => isset( $data['label'] ) ? $data['label'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'CSS Classes', 'jem-cpow' ),
									'field_name'  => 'class',
									'type'        => 'text',
									'classes'     => 'col-sm-12 col-xs-12 form-group',
									'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
									'value'       => isset( $data['class'] ) ? $data['class'] : '',
									'field_class' => 'jem-field',
								),
							),
						),
						array(
							'name'		=> __('Display Logic','jem-cpow'),
							'id'		=> 'conditional_logic',
							'active'	=> 'false',
							'fields' 	=> array(),		
						),
					),	
				);
				break;

			case 'check_field':
				$selected_fields = array(
					'icon'             => 'fa-check-square',
					'title'            => __( 'Checkbox Field: <span class="changing_lbl">' . $label . '</span>', 'jem-cpow' ),
					'unique_name'      => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
					'label'            => isset( $data['label'] ) ? $data['label'] : '',
					'class'            => isset( $data['class'] ) ? $data['class'] : '',
					'required'         => isset( $data['required'] ) ? $data['required'] : '',
					'required_checked' => ( isset( $data['required'] ) && $data['required'] == 'on' ) ? 'checked' : '',
					'hide_require'     => false,
					'tabs'			   => array(
						array(
							'name'		   	=> __('Basic Settings','jem-cpow'),
							'id'		   	=> 'basic_settings',
							'active'	 	=> 'true',
							'fields'       	=> array(
								array(
									'label'       => __( 'Field Unique Name', 'jem-cpow' ),
									'field_name'  => 'unique_name',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
									'value'       => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Field Label', 'jem-cpow' ),
									'field_name'  => 'label',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group kinput_detect',
									'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
									'value'       => isset( $data['label'] ) ? $data['label'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'CSS Classes', 'jem-cpow' ),
									'field_name'  => 'class',
									'type'        => 'text',
									'classes'     => 'col-sm-12 col-xs-12 form-group',
									'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
									'value'       => isset( $data['class'] ) ? $data['class'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Field Options (Enter new option on new line.)', 'jem-cpow' ),
									'field_name'  => 'options',
									'type'        => 'textarea',
									'classes'     => 'col-sm-12 col-xs-12 form-group',
									'placeholder' => __( 'value : Label (new option on new line)', 'jem-cpow' ),
									'value'       => isset( $data['options'] ) ? $data['options'] : '',
									'field_class' => 'jem-field',
								),
							),
						),
						array(
							'name'		=> __('Display Logic','jem-cpow'),
							'id'		=> 'conditional_logic',
							'active'	=> 'false',
							'fields' 	=> array(),		
						),		
					),
				);
				break;

			case 'select_field':
				$selected_fields = array(
					'icon'             => 'fa-caret-square-o-down',
					'title'            => __( 'Dropdown Field: <span class="changing_lbl">' . $label . '</span>', 'jem-cpow' ),
					'unique_name'      => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
					'label'            => isset( $data['label'] ) ? $data['label'] : '',
					'class'            => isset( $data['class'] ) ? $data['class'] : '',
					'required'         => isset( $data['required'] ) ? $data['required'] : '',
					'value'            => isset( $data['options'] ) ? $data['options'] : '',
					'placeholder'      => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
					'required_checked' => ( isset( $data['required'] ) && $data['required'] == 'on' ) ? 'checked' : '',
					'hide_require'     => false,
					'tabs'			   => array(
						array(
							'name'		   	=> __('Basic Settings','jem-cpow'),
							'id'		   	=> 'basic_settings',
							'active'	 	=> 'true',
							'fields'        => array(
								array(
									'label'       => __( 'Field Unique Name', 'jem-cpow' ),
									'field_name'  => 'unique_name',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
									'value'       => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Field Label', 'jem-cpow' ),
									'field_name'  => 'label',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group kinput_detect',
									'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
									'value'       => isset( $data['label'] ) ? $data['label'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Placeholder', 'jem-cpow' ),
									'field_name'  => 'placeholder',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Placeholder Text', 'jem-cpow' ),
									'value'       => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'CSS Classes', 'jem-cpow' ),
									'field_name'  => 'class',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
									'value'       => isset( $data['class'] ) ? $data['class'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Options', 'jem-cpow' ),
									'field_name'  => 'options',
									'type'        => 'textarea',
									'classes'     => 'col-sm-12 col-xs-12 form-group',
									'placeholder' => __( 'option : Label', 'jem-cpow' ),
									'value'       => isset( $data['value'] ) ? $data['value'] : '',
									'field_class' => 'jem-field',
								),
							),
						),	
						array(
							'name'		=> __('Display Logic','jem-cpow'),
							'id'		=> 'conditional_logic',
							'active'	=> 'false',
							'fields' 	=> array(),		
						),
					)	
				);
				break;

			case 'radio_field':
				$selected_fields = array(
					'icon'             => 'fa-dot-circle-o',
					'title'            => __( 'Radio Buttons: <span class="changing_lbl">' . $label . '</span>', 'jem-cpow' ),
					'unique_name'      => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
					'label'            => isset( $data['label'] ) ? $data['label'] : '',
					'class'            => isset( $data['class'] ) ? $data['class'] : '',
					'required'         => isset( $data['required'] ) ? $data['required'] : '',
					'value'            => isset( $data['value'] ) ? $data['value'] : '',
					'placeholder'      => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
					'required_checked' => ( isset( $data['required'] ) && $data['required'] == 'on' ) ? 'checked' : '',
					'hide_require'     => false,
					'tabs'			   => array(
						array(
							'name'		   	=> __('Basic Settings','jem-cpow'),
							'id'		   	=> 'basic_settings',
							'active'	 	=> 'true',
							'fields'       	=> array(
								array(
									'label'       => __( 'Field Unique Name', 'jem-cpow' ),
									'field_name'  => 'unique_name',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
									'value'       => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Field Label', 'jem-cpow' ),
									'field_name'  => 'label',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group kinput_detect',
									'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
									'value'       => isset( $data['label'] ) ? $data['label'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Placeholder', 'jem-cpow' ),
									'field_name'  => 'placeholder',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Placeholder Text', 'jem-cpow' ),
									'value'       => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'CSS Classes', 'jem-cpow' ),
									'field_name'  => 'class',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
									'value'       => isset( $data['class'] ) ? $data['class'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'List of options', 'jem-cpow' ),
									'field_name'  => 'value',
									'type'        => 'options_list',
									'classes'     => 'col-sm-12 col-xs-12 form-group',
									'placeholder' => __( 'value : Label (new option seperated by line)', 'jem-cpow' ),
									'value'       => isset( $data['value'] ) ? $data['value'] : '',
									'field_class' => 'jem-field',
								),
							),
						),	
						array(
							'name'		=> __('Display Logic','jem-cpow'),
							'id'		=> 'conditional_logic',
							'active'	=> 'false',
							'fields' 	=> array(),		
						),	
					),	
					
				);
				break;

			case 'date_field':
				$selected_fields = array(
					'icon'             => 'fa-calendar',
					'title'            => __( 'Date Picker', 'jem-cpow' ),
					'unique_name'      => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
					'label'            => isset( $data['label'] ) ? $data['label'] : '',
					'class'            => isset( $data['class'] ) ? $data['class'] : '',
					'required'         => isset( $data['required'] ) ? $data['required'] : '',
					'value'            => isset( $data['options'] ) ? $data['options'] : '',
					'placeholder'      => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
					'required_checked' => (isset($data['required']) && $data['required'] == 'on' ) ? 'checked' : '',
					'hide_require'     => false,
					'tabs'			   => array(
						array(
							'name'		   	=> __('Basic Settings','jem-cpow'),
							'id'		   	=> 'basic_settings',
							'active'	 	=> 'true',
							'fields'        => array(
								array(
									'label'       => __( 'Field Unique Name', 'jem-cpow' ),
									'field_name'  => 'unique_name',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
									'value'       => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Field Label', 'jem-cpow' ),
									'field_name'  => 'label',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group kinput_detect',
									'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
									'value'       => isset( $data['label'] ) ? $data['label'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Placeholder', 'jem-cpow' ),
									'field_name'  => 'placeholder',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Placeholder Text', 'jem-cpow' ),
									'value'       => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'CSS Classes', 'jem-cpow' ),
									'field_name'  => 'class',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
									'value'       => isset( $data['class'] ) ? $data['class'] : '',
									'field_class' => 'jem-field',
								),
							),
						),
						array(
							'name'		=> __('Display Logic','jem-cpow'),
							'id'		=> 'conditional_logic',
							'active'	=> 'false',
							'fields' 	=> array(),		
						),		
					),	
					
				);
				break;

			case 'color_field':
				$selected_fields = array(
					'icon'             => 'fa-paint-brush',
					'title'            => __( 'Color Field', 'jem-cpow' ),
					'unique_name'      => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
					'label'            => isset( $data['label'] ) ? $data['label'] : '',
					'class'            => isset( $data['class'] ) ? $data['class'] : '',
					'required'         => isset( $data['required'] ) ? $data['required'] : '',
					'value'            => isset( $data['options'] ) ? $data['options'] : '',
					'placeholder'      => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
					'required_checked' => (isset($data['required']) && $data['required'] == 'on' ) ? 'checked' : '',
					'hide_require'     => false,
					'tabs'			   => array(
						array(
							'name'		   	=> __('Basic Settings','jem-cpow'),
							'id'		   	=> 'basic_settings',
							'active'	 	=> 'true',
							'fields'       	=> array(
								array(
									'label'       => __( 'Field Unique Name', 'jem-cpow' ),
									'field_name'  => 'unique_name',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
									'value'       => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Field Label', 'jem-cpow' ),
									'field_name'  => 'label',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group kinput_detect',
									'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
									'value'       => isset( $data['label'] ) ? $data['label'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Placeholder', 'jem-cpow' ),
									'field_name'  => 'placeholder',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Placeholder Text', 'jem-cpow' ),
									'value'       => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'CSS Classes', 'jem-cpow' ),
									'field_name'  => 'class',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
									'value'       => isset( $data['class'] ) ? $data['class'] : '',
									'field_class' => 'jem-field',
								),
							),
						),	
						array(
							'name'		=> __('Display Logic','jem-cpow'),
							'id'		=> 'conditional_logic',
							'active'	=> 'false',
							'fields' 	=> array(),		
						),	
					),		
				);
				break;

			case 'para_field':
				$selected_fields = array(
					'icon'             => 'fa-paragraph',
					'title'            => __( 'Paragraph Field', 'jem-cpow' ),
					'unique_name'      => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
					'label'            => isset( $data['label'] ) ? $data['label'] : '',
					'class'            => isset( $data['class'] ) ? $data['class'] : '',
					'required'         => isset( $data['required'] ) ? $data['required'] : '',
					'value'            => isset($data['value']) ? $data['value'] : '',
					'placeholder'      => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
					'required_checked' => ( isset( $data['required'] ) && $data['required'] == 'on' ) ? 'checked':'',
					'hide_require'     => false,
					'tabs'			   => array(
						array(
							'name'		   	=> __('Basic Settings','jem-cpow'),
							'id'		   	=> 'basic_settings',
							'active'	 	=> 'true',
							'fields'        => array(
								array(
									'label'       => __( 'Field Unique Name', 'jem-cpow' ),
									'field_name'  => 'unique_name',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
									'value'       => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Field Label', 'jem-cpow' ),
									'field_name'  => 'label',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group kinput_detect',
									'placeholder' => __( 'Enter Field Label', 'jem-cpow' ),
									'value'       => isset( $data['label'] ) ? $data['label'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Placeholder', 'jem-cpow' ),
									'field_name'  => 'placeholder',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Placeholder Text', 'jem-cpow' ),
									'value'       => isset( $data['placeholder'] ) ? $data['placeholder'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'CSS Classes', 'jem-cpow' ),
									'field_name'  => 'class',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
									'value'       => isset( $data['class'] ) ? $data['class'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Content', 'jem-cpow' ),
									'field_name'  => 'value',
									'type'        => 'wp_editor',
									'classes'     => 'col-sm-12 col-xs-12 form-group',
									'placeholder' => __( 'Enter the default Value', 'jem-cpow' ),
									'value'       => isset( $data['value'] ) ? $data['value'] : '',
									'field_class' => 'jem-field',
								),
							),
						),	
						array(
							'name'		=> __('Display Logic','jem-cpow'),
							'id'		=> 'conditional_logic',
							'active'	 	=> 'false',
							'fields' 	=> array()		
						),	
					),
				);
				break;

			case 'header_field':
				$selected_fields = array(
					'icon'             => 'fa-header',
					'title'            => __( 'Header Field', 'jem-cpow' ),
					'unique_name'      => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
					'value'            => isset( $data['value'] ) ? $data['value'] : '',
					'class'            => isset( $data['class'] ) ? $data['class'] : '',
					'heading'          => isset( $data['tag'] ) ? $data['tag'] : '',
					'hide_require'     => true,
					'required_checked' => '',
					'tabs'			   => array(
						array(
							'name'		   	=> __('Basic Settings','jem-cpow'),
							'id'		   	=> 'basic_settings',
							'active'	 	=> 'true',
							'fields'        => array(
								array(
									'label'       => __( 'Field Unique Name', 'jem-cpow' ),
									'field_name'  => 'unique_name',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Unique Name for field Letters and Underscore ONLY', 'jem-cpow' ),
									'value'       => isset( $data['unique_name'] ) ? $data['unique_name'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'CSS Classes', 'jem-cpow' ),
									'field_name'  => 'class',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter class seperated by spaces', 'jem-cpow' ),
									'value'       => isset( $data['class'] ) ? $data['class'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Heading Tag', 'jem-cpow' ),
									'field_name'  => 'tag',
									'type'        => 'header_field',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Select Heading Tag', 'jem-cpow' ),
									'value'       => isset( $data['tag'] ) ? $data['tag'] : '',
									'field_class' => 'jem-field',
								),
								array(
									'label'       => __( 'Heading', 'jem-cpow' ),
									'field_name'  => 'value',
									'type'        => 'text',
									'classes'     => 'col-sm-6 col-xs-12 form-group',
									'placeholder' => __( 'Enter Heading Text', 'jem-cpow' ),
									'value'       => isset( $data['value'] ) ? $data['value'] : '',
									'field_class' => 'jem-field',
								),
							),
						),	
						array(
							'name'		=> __('Display Logic','jem-cpow'),
							'id'		=> 'conditional_logic',
							'active'	=> 'false',
							'fields' 	=> array()		
						),	
					),
					
				);
				break;
		}

		// Apply Filters of Selected single field data
		return apply_filters( 'jem_cpow_admin_get_selected_fields', $selected_fields );
	}
}
