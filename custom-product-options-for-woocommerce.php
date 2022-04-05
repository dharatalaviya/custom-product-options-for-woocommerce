<?php
/**
 * Plugin Name: Custom Product Options for WooCommerce
 * Description: The purpose of this plugin is to allow the user to create extra fields that can be used on WooCommerce products.
 * Version: 1.0.0
 * Author: JEM Products
 *
 * Text Domain: jem-cpow
 * Domain Path: /languages
 * 
 * Author URI: https://jem-products.com/
 *
 * @package Custom Product Options for WooCommerce 
 * @category Core
 * @author: JEM Products
 */

// Exit if accessed directly
defined('ABSPATH') or die('Sorry!, You do not access the file directly');



// If this file is accessed directory, then abort.
if (!defined('WPINC')) {
    die;
}

// Include the autoloader so we can dynamically include the rest of the classes.
require_once(trailingslashit(dirname(__FILE__)) . 'Inc/autoloader.php');

/**
 * Basic plugin definitions
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
if( !defined( 'JEM_CPOW_PLUGIN_VERSION' ) ) {
    define( 'JEM_CPOW_PLUGIN_VERSION', '1.0.0' ); //Plugin version number
}
if( !defined( 'JEM_CPOW_DIR' ) ) {
    define( 'JEM_CPOW_DIR', dirname( __FILE__ ) ); // plugin dir
}
if( !defined( 'JEM_CPOW_URL' ) ) {
    define( 'JEM_CPOW_URL', plugin_dir_url( __FILE__ ) ); // plugin url
}
if( !defined( 'JEM_CPOW_LNG_DIR' ) ) {
    define( 'JEM_CPOW_LNG_DIR', JEM_CPOW_DIR.'/languages'); // plugin url
}
if( !defined( 'JEM_CPOW_BASENAME' ) ) {
    define( 'JEM_CPOW_BASENAME', basename( JEM_CPOW_DIR ) ); // base name
}
if( !defined( 'JEM_CPOW_ADMIN' ) ) {
    define( 'JEM_CPOW_ADMIN', JEM_CPOW_DIR . '/admin' ); // plugin admin dir
}
if( !defined( 'JEM_CPOW_ADMIN_URL' ) ) {
    define( 'JEM_CPOW_ADMIN_URL', JEM_CPOW_URL . 'admin' ); // plugin admin dir
}
if( !defined( 'JEM_CPOW_ASSETS_URL' ) ) {
    define( 'JEM_CPOW_ASSETS_URL', JEM_CPOW_URL.'includes/assets/' ); // plugin admin dir
}
if( !defined( 'JEM_CPOW_META_DIR' ) ) {
    define( 'JEM_CPOW_META_DIR', JEM_CPOW_DIR . '/includes/metaboxes' ); // path to meta boxes
}
if( !defined( 'JEM_CPOW_META_URL' ) ) {
    define( 'JEM_CPOW_META_URL', JEM_CPOW_URL . 'includes/metaboxes' ); // path to meta boxes
}
if( !defined( 'JEM_CPOW_META_PREFIX' ) ) {
    define( 'JEM_CPOW_META_PREFIX', '_jem_cpow_' ); // meta box prefix
}

/**
 * Activation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
function jem_activate_plugin(){

    // Flush Rewrite Rules
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'jem_activate_plugin');

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
function jem_deactivate_plugin(){
        
    // Flush Rewrite Rules
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'jem_deactivate_plugin');

/**
 * Load Text Domain
 * 
 * This gets the plugin ready for translation.
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */
function jem_cpow_load_text_domain() {
    
    // Set filter for plugin's languages directory
    $jem_cpow_lang_dir    = JEM_CPOW_LNG_DIR;
    $jem_cpow_lang_dir    = apply_filters( 'jem_spow_languages_directory', $jem_cpow_lang_dir );
    
    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  get_locale(), 'jem-cpow' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'jem-cpow', $locale );
    
    // Setup paths to current locale file
    $mofile_local   = $jem_cpow_lang_dir . $mofile;
    $mofile_global  = JEM_CPOW_LNG_DIR . '/' . JEM_CPOW_BASENAME . '/' . $mofile;
    
    if ( file_exists( $mofile_global ) ) { 

        // Look in global /wp-content/languages/custom-product-options-for-woocommerce folder
        load_textdomain( 'jem-cpow', $mofile_global );

    } elseif ( file_exists( $mofile_local ) ) { 

        // Look in local /wp-content/plugins/custom-product-options-for-woocommerce/languages/ folder
        load_textdomain( 'jem-cpow', $mofile_local );

    } else { 
        
        // Load the default language files
        load_plugin_textdomain( 'jem-cpow', false, $jem_cpow_lang_dir );
    }
}

/**
 * Load Plugin
 * 
 * Handles to load plugin after
 * dependent plugin is loaded
 * successfully
 * 
 * @package Custom Product Options for WooCommerce
 * @since 1.0.0
 */

function jem_plugin_loaded() {

     //check Woocommerce is activated or not
    if( class_exists( 'Woocommerce' ) ) {

        jem_cpow_load_text_domain();

        require_once(JEM_CPOW_DIR.'/class-init.php');

        $Jem_Cpow_Init = new Init();
        $Jem_Cpow_Init->register_services();          

    }//end if to check class Woocommerce is exist or not    
}

//add action to load plugin
add_action( 'plugins_loaded', 'jem_plugin_loaded' );

 