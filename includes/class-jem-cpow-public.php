<?php
/**
 * Public Class - Frontend Main Class
 *
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
 namespace JEM_Extra_Product_Options\Includes;

// Exit if accessed directly
defined( 'ABSPATH' ) or die( 'Sorry!, You do not access the file directly' );


class Jem_Cpow_Public {

	/**
	 * Display fields before add to cart button in product details page
	 *
	 * @return
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	function jem_cpow_woo_before_add_to_cart_button() {

		// Get Field List
		$get_groups = get_field_groups();

		if ( empty( $get_groups ) ) {
			return;
		}

		// Start HTML Template
		jem_cpow_get_template( 'addtocart/jem_spow_fields_group_start_html.php' );

		foreach ( $get_groups as $get_group ) {

			$get_existing = get_post_meta( $get_group, 'jem_fields', true );

			// check fields is not exists
			if ( empty( $get_existing ) ) {
				return;
			}

			// check if fields allow to this products
			if ( $this->show_fields( $get_group ) ) {

				// Display fields
				foreach ( $get_existing as $exist ) {

					self::register_fields_class( $exist, $exist['field_type'] );
				}
			}
		}

		jem_cpow_get_template( 'addtocart/jem_spow_fields_group_end_html.php' );
	}

	public function jem_cpow_validations_fields(){
		
		// Get Field List
		$get_groups = get_field_groups();

		if ( empty( $get_groups ) ) {
			return;
		}
	
		foreach ( $get_groups as $get_group ) {
			$get_existing = get_post_meta( $get_group, 'jem_fields', true );
			// check fields is not exists
			if ( empty( $get_existing ) ) {
				return;
			}

			$validation = array();
			// check if fields allow to this products
			if ( $this->show_fields( $get_group ) ) {

				// Display fields
				foreach ( $get_existing as $exist ) {

					if(isset( $exist['validation_regex'] ) && $exist['validation_regex'] != '' && isset( $exist['required']) && $exist['required'] == 'on'){
						$validation[] = $exist;
					}
					
				}
			}
		}
		return $validation;
	}

	/**
	 * Check fields display or not before add to cart button in product details page
	 *
	 * @return boolean $show
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	function show_fields( $get_group ) {

		global $post;
		$show = false;

		$product_condition = get_post_meta( $get_group, 'productDisplayRule', true );
		$terms_condition   = get_post_meta( $get_group, 'categoryDisplayRule', true );
		$selected_products = get_post_meta( $get_group, 'selected_products', true );
		$selected_terms    = get_post_meta( $get_group, 'selected_terms', true );
		$categories        = get_the_terms( $post->ID, 'product_cat' );
		$term_id           = $categories[0]->term_id;

		// check selected products in field group
		if ( ! empty( $selected_products ) ) {
			// check if condition is include or exclude and show/hide fields according to that
			if ( $product_condition == 'incl' ) {
				if ( in_array( $post->ID, $selected_products ) ) {
					$show = true;
				} else {
					$show = false;
				}
			} else {
				if ( ! in_array( $post->ID, $selected_products ) ) {
					$show = true;
				} else {
					$show = false;
				}
			}
		} else {
			// check selected products in field group
			if ( ! empty( $selected_terms ) ) {
				// check if condition is include or exclude and show/hide fields according to that
				if ( $terms_condition == 'incl' ) {
					if ( in_array( $term_id, $selected_terms ) ) {
						$show = true;
					} else {
						$show = false;
					}
				} else {
					if ( ! in_array( $term_id, $selected_terms ) ) {
						$show = true;
					} else {
						$show = false;
					}
				}
			} else {
				$show = true;
			}
		}

		return $show;
	}

	/**
	 * Store all fields class the classes inside an array
	 *
	 * @return [type]['description']
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public static function get_fields_class() {
		$fields_classes = array(
			'header_field'      => MetaBoxes\Jem_Cpow_Heading::class,
			'para_field'        => MetaBoxes\Jem_Cpow_Paragraph::class,
			'draggable_textbox' => MetaBoxes\Jem_Cpow_TextBox::class,
			'number_field'      => MetaBoxes\Jem_Cpow_NumberBox::class,
			'pass_field'        => MetaBoxes\Jem_Cpow_Password::class,
			'textarea_field'    => MetaBoxes\Jem_Cpow_Textarea::class,
			'email_field'       => MetaBoxes\Jem_Cpow_Email::class,
			'upload_field'      => MetaBoxes\Jem_Cpow_UploadFile::class,
			'check_field'       => MetaBoxes\Jem_Cpow_CheckBox::class,
			'select_field'      => MetaBoxes\Jem_Cpow_Selectbox::class,
			'date_field'        => MetaBoxes\Jem_Cpow_DatePicker::class,
			'radio_field'       => MetaBoxes\Jem_Cpow_RadioButton::class,
			'color_field'       => MetaBoxes\Jem_Cpow_Color::class,

		);

		// Apply filters for add or remove Fields Classes
		return apply_filters( 'jem_cpow_get_fields_classes', $fields_classes );

	}

	/**
	 * Loop through the classes, intaialase them
	 * and call the register() method if it exists
	 *
	 * @return
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public function register_fields_class( $data, $field_type ) {

		// get Fields class
		$fields_classes = self::get_fields_class();
		$field_class    = $fields_classes[ $field_type ];

		// Class iterface
		$class_interface = $this->instantiate_fields_class( $field_class, $data );

		// IF method existes
		if ( method_exists( $class_interface, 'add_fields' ) ) {
			$class_interface->add_fields();
		}
	}

	/**
	 * Instantiate the Class
	 *
	 * @param class $class from the services array
	 * @return class instance new instance of class
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public function instantiate_fields_class( $class, $data ) {
			return new $class( $data );
	}

	/**
	 * Add our custom fields into the cart
	 *
	 * @param $cart_item_data, $product_id, $variation_id, $quantity
	 * @return mixed
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public function jem_add_custom_field_item_data( $cart_item_data, $product_id, $variation_id, $quantity ) {
		global $woocommerce;

		// altering fields to find checkbox
		// TODO at some put these inside the array
		foreach ( $_POST as $key => $data ) {

			// Make sure the key has not been tampered with
			if ( sanitize_text_field( $key ) != $key ) {
				// something unexpected so discard this entry
				continue;
			}

			// Do we have a checkbox?
			if ( strpos( $key, 'check_field' ) !== false ) {

				// Sanitize the data
				$data = sanitize_array( $data );

								$cart_item_data[ $key ] = implode( ', ', $data ); // add it to the cart
				// print_r($dat);
				// die;
			}
		}
		/*---------checbox validation end ---------*/

		// Now check the rest of the fields
		// TODO - put the checkbox in here at some point
		if ( ! empty( $_POST['jempa_fields'] ) ) {

			// Add the custom fields to the cart
			foreach ( $_POST['jempa_fields'] as $key => $data ) {

				// Make sure the key has not been tampered with
				if ( sanitize_text_field( $key ) != $key ) {
					// something unexpected so discard this entry
					continue;
				}

				$cart_item_data[ $key ] = sanitize_array( $data ); // store each field in the cart
			}
		}

		return $cart_item_data;
	}

	/**
	 * Display custom fields in the cart
	 *
	 * @param $name, $cart_item, $cart_item_key
	 * @return customfield data
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public function jem_cart_item_name( $name, $cart_item, $cart_item_key ) {
		// get existing field groups
		$get_field_groups = get_field_groups();

		if ( empty( $get_field_groups ) ) {
			return;
		}

		foreach ( $get_field_groups as $field_group ) {
			$p = 0;
			if ( ! empty( $field_group ) ) {

				// Fetch field group data
				$getfields_data = get_post_meta( $field_group, 'jem_fields', true );        // get saved fields

				// if get fields data exsit or not
				if ( empty( $getfields_data ) ) {
					return;
				}

				foreach ( $getfields_data as $get_field ) {

					// filter values by unique name
					$uniquename = $get_field['unique_name'];

					if ( ! empty( $cart_item[ $uniquename ] ) ) {

						if ( is_array( $cart_item[ $uniquename ] ) ) {

							// check if array if passed in cart data and if is passed convert to comma seperated string
							$nam = implode( ', ', $cart_item[ $uniquename ] );

						} else {
							$nam = $cart_item[ $uniquename ];
							if ( $get_field['field_type'] == 'upload_field' ) {

								// show upload file as a link in cart item data
								$nam = '<a href="' . $cart_item[ $uniquename ] . '">' . basename( $cart_item[ $uniquename ] ) . '</a>';
							}
						}

						// show each value in p tag
						$name .= '<p class="mar-0"><strong>' . $get_field['label'] . '</strong> : ' . $nam . '</p>';
					}
					$p++;
				}
			}
		}

		return $name;
	}

	 /**
	  * Display custom fields in the Checkout and Order
	  *
	  * @param $name, $cart_item_key, $value, $order
	  * @return
	  * @package Custom Product Options for WooCommerce
	  * @since 1.0.0
	  */
	public function jem_add_custom_data_to_order( $item, $cart_item_key, $values, $order ) {
		// get existing field groups
		$get_fields_groups = get_field_groups();

		// get existing field groups
		if ( empty( $get_fields_groups ) ) {
			return;
		}

		foreach ( $get_fields_groups as $get_fields ) {

			$p = 0;
			if ( ! empty( $get_fields ) ) {

				// Get fields data
				$getfields_data = get_post_meta( $get_fields, 'jem_fields', true );

				if ( empty( $getfields_data ) ) {
					return;
				}

				foreach ( $getfields_data as $getfield ) {

					// filter values by unique name
					$unique_name = $getfield['unique_name'];

					if ( ! empty( $values[ $unique_name ] ) ) {

						if ( is_array( $values[ $unique_name ] ) ) {
							// check if array if passed in cart data and if is passed convert to comma seperated string
							$nam = implode( ', ', $values[ $unique_name ] );

						} else {
							$nam = $values[ $unique_name ];
							if ( $getfield['field_type'] == 'upload_field' ) {

								// show upload file as a link in cart item data
								$nam = '<a class="change_admin" href="' . $values[ $unique_name ] . '">' . basename( $values[ $unique_name ] ) . '</a>';
							}
						}

						$item->add_meta_data( __( $getfield['label'], 'jem' ), $nam );

					}
					$p++;
				}
			}
		}
	}

	/**
	 * Upload file
	 *
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public function jem_upload_file() {

		// upload file action
		if ( ! function_exists( 'wp_handle_upload' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		// Get Files
		$uploadedfile = $_FILES['file'];

		$upload_overrides = array( 'test_form' => false );

		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

		if ( $movefile && ! isset( $movefile['error'] ) ) {
			wp_send_json(
				array(
					'success' => true,
					'url'     => $movefile['url'],
				)
			);
		} else {
			wp_send_json(
				array(
					'success' => false,
					'msg'     => $movefile['error'],
				)
			);
		}
		die();
	}

	/**
	 * All WordPress Hooks Run by this method
	 *
	 * @return
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	function init_hooks() {

		// Hooks Call in Woocommerce Before Add to Cart Button
		add_action( 'woocommerce_before_add_to_cart_button', array( $this, 'jem_cpow_woo_before_add_to_cart_button' ), 10 );

		// Hooks add custom item data
		add_filter( 'woocommerce_add_cart_item_data', array( $this, 'jem_add_custom_field_item_data' ), 10, 4 );

		// Hooks Display fields in Cart item
		add_filter( 'woocommerce_cart_item_name', array( $this, 'jem_cart_item_name' ), 10, 3 );

		// display fields data in checkout and order meta
		add_action( 'woocommerce_checkout_create_order_line_item', array( $this, 'jem_add_custom_data_to_order' ), 10, 4 );

		// add ajax action for upload field
		add_action( 'wp_ajax_jem_upload_file', array( $this, 'jem_upload_file' ) );

		// ajax action Non user to upload a file
		add_action( 'wp_ajax_nopriv_jem_upload_file', array( $this, 'jem_upload_file' ) );
	}
}
