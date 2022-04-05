<?php 
/**
 * Check Box Field Class
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */

namespace JEM_Extra_Product_Options\Includes\MetaBoxes;

// Exit if accessed directly
defined('ABSPATH') or die('Sorry!, You do not access the file directly');

class Jem_Cpow_CheckBox {
	
	public $data = array();

	function __construct($data){
	 	$this->data = $data;
	}
	
	/**
	 * Add Check Box Fields
	 *
	 * @return Check Box html
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
    	echo $this->add_fields_html($data);
	}

	/**
	 * Add Check box Fields HTML
	 *
	 * @return Check box html
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
                 $value_list = explode(PHP_EOL, @$data['options']);
                  if (!empty($value_list[0])) {
                    echo "<ul class='check_field_list'>";
                    foreach ($value_list as $vlist) {
                        $vlist = preg_replace('/\s+/', '', $vlist);
                        $labelv = explode(':', $vlist);
                        if (count($labelv) > 1) { ?>
                            <li><label class="container_check">    <!-- styled the default checkboes -->
                                    <?php echo $labelv[1]; ?>
                                    <input name="<?php echo $data['unique_name']; ?>[]" type="checkbox"
                                           value="<?php echo $labelv[0]; ?>" class="jem-input-field <?php echo $data['class']; ?>" id="<?php echo $data['unique_name']; ?>">
                                    <span class="checkmark"></span>
                                </label></li>
                        <?php } else {
                            ?>
                            <li><label class="container_check">
                                    <?php echo $labelv[0]; ?>
                                    <input name="<?php echo $data['unique_name']; ?>[]" type="checkbox"
                                           value="<?php echo sanitize_title($labelv[0]); ?>"
                                           class="jem-input-field <?php echo $data['class']; ?>" id="<?php echo $data['unique_name']; ?>">
                                    <span class="checkmark"></span>
                                </label></li>
                        <?php } ?>
                        <?php
                    }
                    echo "</ul>";
                }
                ?>
            </td>
    	</tr>               
    	<?php 
    	$html = ob_get_contents();
		ob_end_clean();

		// Apply Filters HTML
		return apply_filters('jem_cpow_admin_checkbox_field_html', $html);
	}

}
