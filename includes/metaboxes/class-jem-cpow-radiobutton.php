<?php 
/**
 * Radio ButtonField Class
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */

namespace JEM_Extra_Product_Options\Includes\MetaBoxes;

// Exit if accessed directly
defined('ABSPATH') or die('Sorry!, You do not access the file directly');

class Jem_Cpow_RadioButton {

    public $data = array();

	function __construct($data){
	 	$this->data = $data;
	}
	
	/**
	 * Add Radio Fields
	 *
	 * @return Radio Button html
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
	 * Add Radio Button Fields HTML
	 *
	 * @return Radio Button html
	 * @package Custom Product Options for WooCommerce
		 * @since 1.0.0
	 */
	public function add_fields_html($data){
		ob_start(); 
	?>
		<tr class="">
        <td class="label leftside">
            <label class="label-tag ">
                <?php echo $data['label']; ?>
            </label>
            <?php echo  $data['required_label']; ?>
        </td>
        <td class="value leftside">
            <?php
            $value_list = explode(PHP_EOL, @$data['value']);
            if (!empty($value_list[0])) {
                echo "<ul class='check_field_list'>";
                foreach ($value_list as $vlist) {
                    $labelv = explode(' : ', $vlist);
                    if (count($labelv) > 1) {
                        //	print_r($labelv);
                        ?>
                        <li><label class="container_radio">
                                <?php echo $labelv[1]; ?>
                                <input name="jempa_fields[<?php echo $data['unique_name']; ?>]" type="radio"
                                       value="<?php echo $labelv[0]; ?>" class="jem-input-field <?php echo @$data['class']; ?>" id="<?php echo $data['unique_name']; ?>">
                                <span class="checkmark"></span>
                            </label></li>
                        <?php
                    } else {
                        ?>
                        <li>
                            <label class="container_radio">
                                <?php echo $labelv[0]; ?>
                                <input name="jempa_fields[<?php echo $data['unique_name']; ?>]" type="radio"
                                       value="<?php echo sanitize_title($labelv[0]); ?>"
                                       class="jem-input-field <?php echo $data['class']; ?>>" id="<?php echo $data['unique_name']; ?>">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <?php
                    }
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
		return apply_filters('jem_cpow_admin_radio_button_field_html', $html);
	}

}
