<?php 
/**
 * Color Field Class
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */

namespace JEM_Extra_Product_Options\Includes\MetaBoxes;

// Exit if accessed directly
defined('ABSPATH') or die('Sorry!, You do not access the file directly');

class Jem_Cpow_Color {

	public $data = array();
	
	function __construct($data){
	 	$this->data = $data;
	}
	
	/**
	 * Add Color Fields
	 *
	 * @return Textbox html
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
    	echo $this->add_fields_html($data);
	}

	/**
	 * Add Color Fields HTML
	 *
	 * @return Color html
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
            <input type="text" id="cpick" name="jempa_fields[<?php echo $data['unique_name']; ?>]" value="<?php echo @$data['value']; ?>" class="jscolor {required:<?php echo $data['required'] ?>,hash:true} jem-input-field <?php echo $data['class']; ?>" placeholder="<?php echo $data['placeholder']; ?>" <?php echo $data['required']; ?> id="<?php echo $data['unique_name']; ?>">
        </td>
    	</tr>
    	<?php 
    	$html = ob_get_contents();
		ob_end_clean();

		// Apply Filters HTML
		return apply_filters('jem_cpow_admin_color_field_html', $html);
	}

}
