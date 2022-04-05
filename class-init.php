<?php 
/**
* Initalation Class 
* 
* @package Custom Product Options for WooCommerce
* @since 1.0.0
*/

// Exit if accessed directly
defined('ABSPATH') or die('Sorry!, You do not access the file directly');

use JEM_Extra_Product_Options\Admin;
use JEM_Extra_Product_Options\Includes;
use JEM_Extra_Product_Options\Admin\Util;

final class Init {

	/**
	 * Store all the classes inside an array
	 *
	 * @return [type]['description']
	 * @package Custom Product Options for WooCommerce
		 * @since 1.0.0
	 */

	public static function get_services(){
		return [
			Admin\Jem_Cpow_Admin::class, // Admin Main Class
			Includes\Jem_Cpow_Public::class, // Front end main class
			Includes\Jem_Cpow_Enqueue_Scripts::class, // Front end CSS/JS Script Class
			Admin\Util\Jem_Cpow_Admin_CSS_Loader::class, //Admin Load the CSS/JS Script Class
			Admin\Jem_Cpow_Field_Group_Custom_Post::class // JemCreateCustomPostType Class
		];
	}

	/**
	 * Loop through the classes, intaialase them
	 * and call the register() method if it exists
	 *
	 * @return 
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */

	public function register_services(){

		// Register Classes
		foreach(self::get_services() as $class){
			$services = self::instantiate($class);
			if(method_exists($services, 'init_hooks')){
				$services->init_hooks();
			}
		}

		// include other functins files
		self::includefiles();
	}

	/**
	 * Instantiate the Class
	 * @param class $class from the services array
	 * @return class instance new instance of class
	 * @package Custom Product Options for WooCommerce
		 * @since 1.0.0
	 */
	public static function instantiate($class){
		return new $class();
	}

	/**
	 * Include functions files list
	 * @param 
	 * @return Array functions file path
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public static function get_includesfiles(){
		return [
			JEM_CPOW_DIR . '/includes/functions.php', // front end functions file
			JEM_CPOW_DIR . '/includes/template-functions.php', // front end template file
			JEM_CPOW_ADMIN . '/admin-template-functions.php' // admin template file
		];
	}

	/**
	 * Include functions files 
	 * @param 
	 * @return 
	 * @package Custom Product Options for WooCommerce
	 * @since 1.0.0
	 */
	public function includefiles(){
		
		// Check files exist or not
		if(empty(self::get_includesfiles())) return;

		// include files
		foreach(self::get_includesfiles() as $file){
			if(file_exists($file)){
				require_once $file;
			}	
		}
	}

}
