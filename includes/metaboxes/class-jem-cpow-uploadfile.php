<?php 
/**
 * Upload Files Field Class
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */

namespace JEM_Extra_Product_Options\Includes\MetaBoxes;

// Exit if accessed directly
defined('ABSPATH') or die('Sorry!, You do not access the file directly');

class Jem_Cpow_UploadFile {

	public $data = array();
	
	function __construct($data){
	 	$this->data = $data;
	}
	
	/**
	 * Add Upload Files Fields
	 *
	 * @return Upload Files html
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
	 * Add Upload Files Fields HTML
	 *
	 * @return Upload Files html
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
            <input <?php echo @$data['required'] ?> type="file" name="empa_fields[<?php echo $data['unique_name']; ?>][1]" class="upf jem-input-field <?php echo @$data['class']; ?>">
            <input type="hidden" name="jempa_fields[<?php echo $data['unique_name']; ?>]"/>
            <button class="btn btn-primary upload_a_file">Upload</button>
        </td>
    	</tr>
    	<?php 
    	$html = ob_get_contents();
		ob_end_clean();

		// Apply Filters HTML
		return apply_filters('jem_cpow_admin_uploadfile_field_html', $html);
	}

}
