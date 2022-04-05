<?php

namespace JEM_Extra_Product_Options\Admin\Util;

/**
 * Defines a common set of functions that any class responsible for loading
 * stylesheets, JavaScript, or other assets should implement.
 */
interface Assets_Interface {

    public function init_hooks();
    public function jem_cpow_admin_enqueue_scripts();

}
