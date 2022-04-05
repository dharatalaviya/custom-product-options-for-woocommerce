<?php 
/**
 * SelectBox Field Class
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */

namespace JEM_Extra_Product_Options\Includes\MetaBoxes;

// Exit if accessed directly
defined('ABSPATH') or die('Sorry!, You do not access the file directly');

class Jem_Cpow_Selectbox {

	public $data = array();
	
	function __construct($data){
	 	$this->data = $data;
	}
	
	/**
	 * Add Selectbox Fields
	 *
	 * @return Selectbox html
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
	 * Add Selectbox Fields HTML
	 *
	 * @return Selectbox html
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
           <?php
            $data['value'] = sanitize_title(@$data['options']);
            $value_list = explode(PHP_EOL, @$data['options']);
            if (!empty($value_list[0])) {
                echo "<select name='jempa_fields[" . $data['unique_name'] . "]' " .$data['required']  . " class='jem-select-field form-control " . $data['class'] . "' id='".$data['unique_name']."'>";
                ?>
                <option value=""><?php echo $data['placeholder']; ?></option>
                <?php
                foreach ($value_list as $vlist) {
                    $labelv = explode(' : ', $vlist);
                    if (count($labelv) > 1) {
                        ?>
                        <option value="<?php echo $labelv[0]; ?>"><?php echo $labelv[1]; ?></option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo sanitize_title($labelv[0]); ?>"><?php echo $labelv[0]; ?></option>
                        <?php
                    }
                }
                echo "</select>";
            }
            ?>
        </td>
    	</tr>
    	<?php 
    	$html = ob_get_contents();
		ob_end_clean();

		// Apply Filters HTML
		return apply_filters('jem_cpow_admin_Selectbox_field_html', $html);
	}

}
