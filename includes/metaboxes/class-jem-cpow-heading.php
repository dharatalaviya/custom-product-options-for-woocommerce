<?php 
/**
 * Heading Field Class 
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */

namespace JEM_Extra_Product_Options\Includes\MetaBoxes;

// Exit if accessed directly
defined('ABSPATH') or die('Sorry!, You do not access the file directly');

class Jem_Cpow_Heading {

	public $data = array();

	function __construct($data){
	 	$this->data = $data;
	}
	
	/**
	 * Add Heading Fields
	 *
	 * @return ParaField html
	 * @package Custom Product Options for WooCommerce
		 * @since 1.0.0
	 */

	public function add_fields(){
    	echo $this->add_fields_html($this->data);
	}

	/**
	 * Add Heading Fields
	 *
	 * @return Heading html
	 * @package Custom Product Options for WooCommerce
		 * @since 1.0.0
	 */
	public function add_fields_html($data){
		ob_start(); 
	?>
		  <tr class="">
            <td class="label leftside" colspan="2">
                <div class="jem-field-heading">
                    <<?php  echo $data['tag']; ?> class="jem-heading<?php echo ($data['class'])?" ".$data['class']:''; ?>"><?php echo $data['value']; ?></<?php echo $data['tag']; ?>>
                </div>
            </td>
         </tr>
    	<?php 
    	$html = ob_get_contents();
		ob_end_clean();

		// Apply Filters HTML
		return apply_filters('jem_cpow_admin_heading_field_html', $html);
	}

}
