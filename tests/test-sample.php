<?php
/**
 * Test case for the PHPUnit Demo Plugin
 */
class PhpUnitDemoPluginTest extends WP_UnitTestCase {

    public function setUp() {
            parent::setUp();  

    }    

    public function tearDown() {
            parent::tearDown();  

    }    

    /**
     * Test add_user_meta for new user with author role
     */
    function test_nds_custom_meta_add() {
            $factory_user_id = $this->factory->user->create( array('role' => 'author') );
            $get_user_meta = get_user_meta($factory_user_id, 'preferred_browser', true );
            
            //an empty string will be returned as the user was not an editor
            $this->assertEquals($get_user_meta, '');
    }
        
}