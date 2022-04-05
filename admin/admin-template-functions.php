<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Admin Templates Functions
 * 
 * Handles to manage templates of plugin
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */

/**
 * Returns the path to the WooCommerce - Custom Product Options for WooCommerce Admin template directory
 *
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
function jem_cpow_admin_get_templates_dir() {
	
	return apply_filters( 'jem_cpow_template_dir', JEM_CPOW_ADMIN . '/templates/' );
}

/**
 * Get other templates 
 * 
 * (e.g.Custom Product Options for WooCommerce) passing attributes and including the file.
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
function jem_cpow_admin_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {

	$plugin_absolute	= jem_cpow_admin_get_templates_dir();

	if ( ! $template_path ) {
		$template_path = WC()->template_path();
	}

	wc_get_template( $template_name, $args, $template_path, $plugin_absolute );
}

function jem_cpow_get_fields($field = array()){
 	$field_html  = '';
 	$class 		 = isset($field['field_class']) ? $field['field_class'] : '';
 	$value 		 = isset($field['value']) ? $field['value'] : '';
 	$placeholder = isset($field["placeholder"])? $field["placeholder"] : '';
 	$name 		 = isset($field['field_name'])? $field['field_name'] : ''; 
 	$data 		 = (isset($field['data']) && $field['data']!=false) ?'data-jem-field-name="'.$field['field_name'].'"': '';
 	$disabled    = (isset($field['disabled']) && $field['disabled'] == true ) ? 'disabled' : '';
 	switch ( $field['type'] ) {
 		case 'text':
 			$field_html = '<input type="text" class="form-control '.$class.'" value="'.$value.'" placeholder="'.$placeholder.'" name="'.$name.'" '.$data." ".$disabled.'>';
 			break;

 		case 'number':
 			$field_html = '<input type="number" class="form-control '.$class.'" value="'.$value.'" placeholder="'.$placeholder.'" name="'.$name.'"'.$data." ".$disabled.'>';
 			break;

 		case 'textarea':		
 			$field_html = '<textarea '.$data." ".$disabled.' class="form-control '.$class.'" placeholder="'.$placeholder.'" >'.$value.'</textarea>';
 			break;

 		case 'options_list':
 			$field_html = '<textarea '.$data." ".$disabled.' class="form-control '.$class.'" placeholder="'. $placeholder.'">'.$value.'</textarea>';
 			break;

 		case 'wp_editor':
 			$field_html = '<textarea id="jemwpeditor" '.$data." ".$disabled.' class="jem-wpeditor form-control '.$class.'" placeholder="'.$placeholder.'">'.$value.'</textarea>';
 			break;

 		case 'header_field':
 			$headings = array('h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'h4' => 'H4', 'h5' => 'H5', 'h6' => 'H6');
			$field_html = '<select class="form-control '.$class.'" '.$data." ".$disabled.'>';
			$field_html .= '<option value="">'.$placeholder.'</option>';
			foreach ($headings as $ar => $heading) { 
				$selected = ($value == $ar)? 'selected="selected"':'';
			$field_html .= '<option '.$selected.' value="'. $ar.'">'.$heading.'</option>';
			}
			$field_html .= '</select>';
 			break;	
 	}   	
 	return $field_html;
}

function get_field_title($field_type){
	$title = '';
	switch ( $field_type ) {
 		case 'draggable_textbox':
 			$title = 'TextBox';
 			break;

 		case 'number_field':
 			$title = 'NubmerBox';
 			break;
 		case 'email_field':
 			$title = 'Emailbox';
 			break;	
 		case 'textarea_field':		
 			$title = 'TextArea';
 			break;
 		case 'upload_field':
 			$title = 'Upload File';
 			break;
 		case 'check_field':
 			$title = 'CheckBox';
 			break;
 		case 'select_field':
 			$title = 'Select Box';
 			break;
 		case 'radio_field':
 			$title = 'RadioBox';
 			break;
 		case 'date_field':
 			$title = 'Date Picker';
 			break;
 		case 'color_field':
 			$title = 'Color Picker';
 			break;
 		case 'para_field':
 			$title = 'Paragraph';					
 			break;
 		case 'header_field':
 			$title = 'Header';
 			break;	
 		case 'pass_field':
 			$title = 'PasswordBox';	
 			break;
 	}
 	return $title;
}

function get_fields_conditions($field_type = '', $value = '', $count = 0, $disabled =''){

	$conditions = array(
		'draggable_textbox' => array(
			'is_equal_to'	=> array(
				'title'			=> __('Is equal to', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String Value',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))	? $disabled : false,
						'data'			=> false,
					)
				)
			),
			'is_not_equal_to' 	=> array(
				'title'			=>	__('Is not equal to', 'jem_cpow'),
				'value_field'	=> 	jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String Value',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),
			'is_empty'			=> array(
				'title'			=>	__('Is Empty', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String Value',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			),	
			'is_not_empty'		=> array(
				'title'			=> __('Is not Empty', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String Value',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			),	
			'is_greater_than'	=> array(
				'title' 		=> __('Is greater than', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String Value',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),	
			'is_less_than'		=> array(
				'title'			=> __('Is less than', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String Value',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),
			'field_contains'	=> array(
				'title'			=> __('Field contains', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String Value',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				),
			),
			'field_does_not_contain' => array(
				'title'			=> __('Field does not contain', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String Value',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				),
			),
			'field_Start_with'	=> array(
				'title'			=> __('Field starts with', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String Value',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),	
		),
		'number_field'	=> array(
			'is_equal_to'	=> array(
				'title'			=> __('Is equal to', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'number',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '0',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),
			'is_not_equal_to' 	=> array(
				'title'			=>	__('Is not equal to', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'number',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '0',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),
			'is_empty'			=> array(
				'title'			=> __('Is Empty', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'number',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '0',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			),	
			'is_not_empty'		=> array(
				'title'			=> __('Is not Empty', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'number',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '0',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),	
			'is_greater_than'	=> array(
				'title' 		=> __('Is greater than', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'number',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '0',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),	
			'is_less_than'		=> array(
				'title'			=> __('Is less than', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'number',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '0',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),
		),
		'email_field'	=>	array(
			'is_equal_to'	=> array(
				'title'			=> __('Is equal to', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Email Address',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),
			'is_not_equal_to' 	=> array(
				'title'			=>	__('Is not equal to', 'jem_cpow'),
				'value_field'	=> 	jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Email Address',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),
			'is_empty'			=> array(
				'title'			=> __('Is Empty', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Email Address',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			),	
			'is_not_empty'		=> array(
				'title'			=> __('Is not Empty', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Email Address',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			),	
			'is_greater_than'	=> array(
				'title' 		=> __('Is greater than', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Email Address',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),	
			'is_less_than'		=> array(
				'title'			=> __('Is less than', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Email Address',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),
			'field_contains'	=> array(
				'title'			=> __('Field contains', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Email Address',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				),
			),
			'field_does_not_contain' => array(
				'title'			=> __('Field does not contain', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
					'type'			=> 'text',
					'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
					'placeholder'	=> 'Enter Email Address',
					'value'			=> $value,
					'field_class'	=> 'jem_display_value',
					'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
					'data'			=> false,
					)
				),
			),
			'field_Start_with'	=> array(
				'title'			=> __('Field starts with', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Email Address',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),	
		),
		'pass_field'	=> array(
			'is_equal_to'	=> array(
				'title'			=> __('Is equal to', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Password String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),
			'is_not_equal_to' 	=> array(
				'title'			=>	__('Is not equal to', 'jem_cpow'),
				'value_field'	=> 	jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Password String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),
			'is_empty'			=> array(
				'title'			=> __('Is Empty', 'jem_cpow'),
				'value_field'	=> 	jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Password String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)	
			),	
			'is_not_empty'		=> array(
				'title'			=> __('Is not Empty', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Password String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			),	
			'is_greater_than'	=> array(
				'title' 		=> __('Is greater than', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Password String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),	
			'is_less_than'		=> array(
				'title'			=> __('Is less than', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Password String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),
			'field_contains'	=> array(
				'title'			=> __('Field contains', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Password String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				),
			),
			'field_does_not_contain' => array(
				'title'			=> __('Field does not contain', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Password String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				),
			),
			'field_Start_with'	=> array(
				'title'			=> __('Field starts with', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter Password String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),	
		),
		'textarea_field' => array(
			'is_equal_to'	=> array(
				'title'			=> __('Is equal to', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),
			'is_not_equal_to' 	=> array(
				'title'			=>	__('Is not equal to', 'jem_cpow'),
				'value_field'	=> 	 jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),
			'is_empty'			=> array(
				'title'			=> __('Is Empty', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			),	
			'is_not_empty'		=> array(
				'title'			=> __('Is not Empty', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			),	
			'is_greater_than'	=> array(
				'title' 		=> __('Is greater than', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),	
			'is_less_than'		=> array(
				'title'			=> __('Is less than', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),
			'field_contains'	=> array(
				'title'			=> __('Field contains', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				),
			),
			'field_does_not_contain' => array(
				'title'			=> __('Field does not contain', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				),
			),
			'field_Start_with'	=> array(
				'title'			=> __('Field starts with', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> 'Enter String',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				)
			),	
		),
		'upload_field' => array(
			'is_empty'			=> array(
				'title'			=> __('Is Empty', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			),	
			'is_not_empty'		=> array(
				'title'			=> __('Is not Empty', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			)
		),
		'check_field'	=> array(
			'is_equal_to'	=> array(
				'title'			=> __('Is equal to', 'jem_cpow'),
				'value_field'	=> 'dropdown'
			),
			'is_not_equal_to' 	=> array(
				'title'			=> __('Is not equal to', 'jem_cpow'),
				'value_field'	=> 	'dropdown'
			),
			'is_empty'			=> array(
				'title'			=> __('Is Empty', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			),	
			'is_not_empty'		=> array(
				'title'			=> __('Is not Empty', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			),
		),
		'radio_field'	=> array(
			'is_equal_to'	=> array(
				'title'			=> __('Is equal to', 'jem_cpow'),
				'value_field'	=> 'dropdown'
			),
			'is_not_equal_to' 	=> array(
				'title'			=>	__('Is not equal to', 'jem_cpow'),
				'value_field'	=> 	'dropdown'
			),
			'is_empty'			=> array(
				'title'			=> __('Is Empty', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			),	
			'is_not_empty'		=> array(
				'title'			=> __('Is not Empty', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			),	
		),
		'select_field'	=> array(
			'is_equal_to'	=> array(
				'title'			=> __('Is equal to', 'jem_cpow'),
				'value_field'	=> 'dropdown'
			),
			'is_not_equal_to' 	=> array(
				'title'			=> __('Is not equal to', 'jem_cpow'),
				'value_field'	=> 	'dropdown'
			),
			'is_empty'			=> array(
				'title'			=> __('Is Empty', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			),	
			'is_not_empty'		=> array(
				'title'			=> __('Is not Empty', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				)
			),	
		),
		'date_field'	=> array(
			'is_equal_to'	=> array(
				'title'			=> __('Is equal to', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value jem_datepicker',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				),
				'add_js'		=> 'datepicker'
			),
			'is_not_equal_to' 	=> array(
				'title'			=>	__('Is not equal to', 'jem_cpow'),
				'value_field'	=> 	 jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value jem_datepicker',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				),
				'add_js'		=> 'datepicker'
			),
			'is_empty'			=> array(
				'title'			=> __('Is Empty', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value jem_datepicker',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				),
				'add_js'		=> 'datepicker'
			),	
			'is_not_empty'		=> array(
				'title'			=> __('Is not Empty', 'jem_cpow'),
				'value_field'	=> jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value jem_datepicker',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				),
				'add_js'		=> 'datepicker'
			),	
			'is_before'			=> array(
				'title'			=> __('Is before', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value jem_datepicker',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				),
				'add_js'		=> 'datepicker'
			),	
			'is_after'		=> array(
				'title'			=> __('Is after', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value jem_datepicker',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				),
				'add_js'		=> 'datepicker'
			),	
		),
		'color_field'	=> array(
			'is_equal_to'	=> array(
				'title'			=> __('Is equal to', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value jem_colorpicker',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				),
				'add_js'		=> 'colorpicker'
			),
			'is_not_equal_to' 	=> array(
				'title'			=>	__('Is not equal to', 'jem_cpow'),
				'value_field'	=> 	 jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value jem_colorpicker',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : false,
						'data'			=> false,
					)
				),
				'add_js'		=> 'colorpicker'
			),
			'is_empty'			=> array(
				'title'			=> __('Is Empty', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value jem_colorpicker',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				),
			),	
			'is_not_empty'		=> array(
				'title'			=> __('Is not Empty', 'jem_cpow'),
				'value_field'	=>  jem_cpow_get_fields( 
					array(
						'type'			=> 'text',
						'field_name'	=> 'jem_display_logic_group[fields]['.$count.'][value]',
						'placeholder'	=> '',
						'value'			=> $value,
						'field_class'	=> 'jem_display_value jem_colorpicker',
						'disabled'		=> (isset($disabled) && ($disabled != ''))? $disabled : true,
						'data'			=> false,
					)
				),
			),	
		),
	);
	if(isset($field_type) && $field_type != '' ){
			return $conditions[$field_type];
	}else{
		return $conditions;
	}
}