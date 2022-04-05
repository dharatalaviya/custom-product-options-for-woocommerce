<?php 

//require_once 'custom-product-options-for-woocommerce.php';
class JEM_Product_OptionsTest extends WP_UnitTestCase
{
    protected $plugin_file;

    //
    // Public methods.
    //

    /**
     * Set up for the tests.
     */
    public function setUp() {

        // You must set the path to your plugin here.
        $this->plugin_file = dirname( dirname( __FILE__ ) ) . '/custom-product-options-for-woocommerce.php';

        // Don't forget to call the parent's setUp(), or the plugin won't get installed.
        parent::setUp();
    }

    /**
     * Test installation and uninstallation.
     */
    public function test_uninstall() {

        /*
         * First test that the plugin installed itself properly.
         */

        // Check that a database table was added.
     //   $this->assertTableExists( $wpdb->prefix . 'myplugin_table' );

        // Check that an option was added to the database.
      //  $this->assertEquals( 'default', get_option( 'myplugin_option' ) );

        /*
         * Now, test that it uninstalls itself properly.
         */

        // You must call this to perform uninstallation.
        $this->uninstall();

        // Check that the table was deleted.
       // $this->assertTableNotExists( $wpdb->prefix . 'myplugin_table' );

        // Check that all options with a prefix was deleted.
        $this->assertNoOptionsWithPrefix( 'jem-product-extras' );

        // Same for usermeta and comment meta.
        $this->assertNoUserMetaWithPrefix( 'jem-product-extras' );
        $this->assertNoCommentMetaWithPrefix( 'jem-product-extras' );
    }
    public function testActivateWithSupport() {
        $this->factory()->user->create( [
            'user_email' => 'admin@admin.com',
            'user_pass'  => 'Rkish123',
            'user_login' => 'hello'
        ] );

        do_action( 'activate_' . static::PLUGIN_BASENAME );

        $user = get_user_by( 'login', 'hello' );
   //     $this->assertEmpty( $user->caps );
        $this->assertEmpty( $user->roles );
    }

 
}