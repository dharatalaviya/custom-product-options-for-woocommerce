<?php 
/**
 * NumberBox Field Class
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
namespace JEM_Extra_Product_Options\Includes\MetaBoxes;

// Exit if accessed directly
defined('ABSPATH') or die('Sorry!, You do not access the file directly');

class Jem_Cpow_NumberBox {

	public $data = array();

	function __construct($data){
	 	$this->data = $data;
	}
	
	/**
	 * Add Numberbox Fields
	 *
	 * @return Numberbox html
	 * @package Custom Product Options for WooCommerce
		 * @since 1.0.0
	 */

	public function add_fields(){
		$data = $this->data;
        $data['required_label'] = '';
        $data['class'] = '';
        if (@$data['required'] == 'on') {
            $data['required_label'] = '<abbr class="required" title="Required">*</abbr>';
            $data['class'] = ' validate-required ';
            $data['required'] = 'required';
        }
    	echo $this-> add_fields_html($data);
	}

	/**
	 * Add Numberbox Fields HTML
	 *
	 * @return Numberbox html
	 * @package Custom Product Options for WooCommerce
		 * @since 1.0.0
	 */
	public function add_fields_html($data){
		ob_start(); 
	?>
		<tr class="">
        	<td class="label leftside">
        		<label class="label-tag "><?php echo @$data['label']; ?></label> 
        		<?php echo $data['required_label']; ?>
        	</td>
        	<td class="value leftside">
            	<input min="<?php echo @$data['min']; ?>" max="<?php echo @$data['max']; ?>" <?php echo $data['required'] ; ?>
                   type="number" name="jempa_fields[<?php echo $data['unique_name']; ?>]"
                   value="<?php echo @$data['value']; ?>" class="jem-input-field <?php echo $data['class']; ?>" id="<?php echo $data['unique_name']; ?>"></td>
    	</tr>
    	<?php 
    	$html = ob_get_contents();
		ob_end_clean();

		// Apply Filters HTML
		return apply_filters('jem_cpow_admin_numberbox_field_html', $html);
	}

}
