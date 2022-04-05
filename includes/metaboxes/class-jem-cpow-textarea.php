<?php 
/**
 * Textarea Field Class
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */

namespace JEM_Extra_Product_Options\Includes\MetaBoxes;

// Exit if accessed directly
defined('ABSPATH') or die('Sorry!, You do not access the file directly');

class Jem_Cpow_Textarea {

	public $data = array();
	
	function __construct($data){
	 	$this->data = $data;
	}
	
	/**
	 * Add Textarea Fields
	 *
	 * @return Textarea html
	 * @package Custom Product Options for WooCommerce
		 * @since 1.0.0
	 */

	public function add_fields(){
		$data = $this->data;
        $data['required_label'] = '';
        $data['class'] = '';
        if ($data['required'] == 'on') {
            $data['required_label'] = '<abbr class="required" title="Required">*</abbr>';
            $data['class'] = ' validate-required ';
            $data['required'] = 'required';
        }
    	echo $this-> add_fields_html($data);
	}

	/**
	 * Add Textbox Fields HTML
	 *
	 * @return Textbox html
	 * @package Custom Product Options for WooCommerce
		 * @since 1.0.0
	 */
	public function add_fields_html($data){
		ob_start(); 
	?>
		<tr class="">
        	<td class="label leftside">
        		<label class="label-tag "><?php echo @$data['label']; ?></label> 
        		<?php echo @$data['required_label']; ?>
        	</td>
        <td class="value leftside">
            <textarea  <?php echo $data['required']; ?> name="jempa_fields[<?php echo $data['unique_name']; ?>]"class="jem-input-field <?php echo $data['class']; ?>" placeholder="<?php echo $data['placeholder']; ?>" id="<?php echo $data['unique_name']; ?>"></textarea>
        </td>
    	</tr>
    	<?php 
    	$html = ob_get_contents();
		ob_end_clean();

		// Apply Filters HTML
		return apply_filters('jem_cpow_admin_textarea_field_html', $html);
	}

}
